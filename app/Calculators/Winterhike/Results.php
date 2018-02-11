<?php namespace App\Calculators\Winterhike;

use App\Emergency;
use App\Question;
use App\Post;
use App\Group;
use App\Hint;
use App\Setting;
use Illuminate\Database\Eloquent\Collection;

class Results
{
    protected $posts;
    protected $maxQuestionScore = 20;
    protected $maxTimeScore = 90;
    protected $minimalTimeScoreBad = 10;
    protected $minimalTimeScoreMediocre = 20;
    protected $minimalTimeScoreGood = 30;
    protected $lessPointsByMinutes = 3;



    public function __construct()
    {
        $posts = Post::all();
        $this->orderPosts($posts);
    }

    /**
     * @return mixed
     */
    public function totals()
    {
        $score = [];
        $groups = Group::all();
        $questions = $this->questions();
        $posts = $this->posts();
        $times = $this->times();
        $hints = $this->hints();
        $emergency = $this->emergency();

        $route = $this->route($times, $hints, $emergency);

        foreach ($groups as $group) {
            $result = [
                'group_name' => $group->groupname,
                'name' => $group->name,
                'number' => $group->id,
                'total_score' => $route[$group->id] + $questions[$group->id] + $posts[$group->id]
            ];
            $result['scores'] = [
                'questions' => $questions[$group->id],
                'posts' => $posts[$group->id],
                'times' => $times[$group->id],
                'hints' => $hints[$group->id],
                'emergency' => $emergency[$group->id],
                'total_route' => $route[$group->id]
            ];
            $score[$group->id] = $result;
        }

        usort($score, function ($item1, $item2) {
            return $item2['total_score'] <=> $item1['total_score'];
        });

        return $score;
    }

    /**
     * Calculate the total score for the route
     *
     * @param $times
     * @param $hints
     * @param $emergency
     * @return array
     */
    public function route($times, $hints, $emergency)
    {
        $scores = [];
        foreach ($times as $key => $time) {

            $scores[$key] = $time + $hints[$key] + $emergency[$key];

            $totalEmergencies = $emergency[$key] / Setting::path('emergency_penalty')->value('value');
            $openedEmergencies = 0 - $totalEmergencies;

            if ($openedEmergencies == 0) {
                if ($scores[$key] < $this->minimalTimeScoreBad) {
                    $scores[$key] = $this->minimalTimeScoreGood;
                }
            }

            if ($openedEmergencies == 1) {
                if ($scores[$key] < $this->minimalTimeScoreMediocre) {
                    $scores[$key] = $this->minimalTimeScoreMediocre;
                }
            }

            if ($openedEmergencies > 1) {
                if ($scores[$key] < $this->minimalTimeScoreBad) {
                    $scores[$key] = $this->minimalTimeScoreBad;
                }
            }
        }
        return $scores;
    }

    /**
     * Calculate scores of the answered questions per group
     *
     * @return array
     */
    public function questions()
    {
        $results = [];
        $questionScores = Question::get([
            'group_id',
            'right_answers'
        ]);

        // Calculate points per question
        $totalQuestions     = Setting::path('total_questions')->value('value');
        $maxScore           = $this->maxQuestionScore;
        $pointsPerQuestion = $maxScore / $totalQuestions;


        foreach ($questionScores as $score) {
            $results[$score->group_id] = round($score->right_answers * $pointsPerQuestion);
        }

        return $results;
    }

    /**
     * Calculate scores of posts per group
     *
     * @return array
     */
    public function posts()
    {
        $results = [];
        $groups = Group::with('scores')->get();

        foreach ($groups as $group) {
            $results[$group->id] = 0;
            foreach ($group->scores as $post) {
                $results[$group->id] = $results[$group->id] + $post->score;
            }
        }

        return $results;
    }

    /**
     * Calculate scores of the answered questions
     *
     * @return array
     */
    public function emergency()
    {
        $scores = [];
        $emergency = Emergency::get([
            'group_id',
            'closed'
        ]);

        $totalEmergencies = Setting::path('total_emergencies')->value('value');
        $emergencyPenalty = Setting::path('emergency_penalty')->value('value');

        foreach ($emergency as $emergency) {
            $scores[$emergency->group_id] = ($emergency->closed - $totalEmergencies) * $emergencyPenalty;
        }

        return $scores;
    }

    public function hints()
    {
        $scores = [];
        $hints = Hint::get([
            'group_id',
            'closed'
        ]);

        $totalHints = Setting::path('total_hints')->value('value');
        $hintPenalty = Setting::path('hint_penalty')->value('value');

        foreach ($hints as $hint) {
            $scores[$hint->group_id] = ($hint->closed - $totalHints) * $hintPenalty;
        }

        return $scores;
    }

    /**
     * Calculate time score per group
     *
     * @return array
     */
    public function times()
    {
        $groups = Group::with('times')->get();

        $results = $this->calculateHikeTime($groups);
        $results = $this->calculateTimeScore($results);

        return $results;
    }

    /**
     * Calculate the timescore
     *
     * @param array $results an array with group_id -> totaltime
     * @return array
     */
    private function calculateTimeScore($results)
    {
        asort($results);
        $scores = [];
        $fastestTime = array_values($results)[0];
        foreach ($results as $groupId => $time) {
            $scores[$groupId] = 10;
            $difference = $time - $fastestTime;
            $scores[$groupId] = $this->maxTimeScore - floor(($difference / 60) / $this->lessPointsByMinutes);
        }

        return $scores;
    }

    /**
     * Order posts on post number, save it in a global variable
     *
     * @param Collection $posts
     * @return void
     */
    private function orderPosts(Collection $posts)
    {
        $this->posts = [];
        foreach ($posts as $post) {
            $this->posts[$post->number] = $post->id;
        }
        ksort($this->posts);
    }

    /**
     * Calculate Total Hike time per group
     *
     * @param array $groups an array with the groups
     * @return array [$group_id => time]
     */
    private function calculateHikeTime($groups)
    {
        $results = [];

        $firstPostId = array_values($this->posts)[0];
        $lastPostId = last($this->posts);

        foreach ($groups as $group) {
            $startTime = 0;
            $finishTime = 0;
            $totalPostTime = 0;

            foreach ($group->times as $time) {
                if ($time->post_id == $firstPostId) {
                    $startTime = strtotime($time->departure);
                    continue;
                }
                if ($time->post_id == $lastPostId) {
                    $finishTime = strtotime($time->arrival);
                    continue;
                }

                $totalPostTime = $totalPostTime + (strtotime($time->departure) - strtotime($time->arrival));
            }
            $totalHikeTime = $finishTime - $startTime;
            $results[$group->id] = $totalHikeTime - $totalPostTime;
        }
        return $results;
    }
}