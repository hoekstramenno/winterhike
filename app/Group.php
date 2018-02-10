<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Score;
use App\Setting;

class Group extends Model
{
    protected $guarded = [];

    //protected $with = ['times', 'scores', 'emergency', 'hint', 'question'];



    /**
     * Has many times
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function times()
    {
        return $this->hasMany('App\Time')->select(['group_id', 'post_id', 'arrival', 'departure'])->orderBy('post_id');
    }

    /**
     * Has many post scores
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function scores()
    {
        return $this->hasMany('App\Score')->select(['group_id', 'post_id', 'score']);
    }

    /**
     * Has one emergency
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function emergency()
    {
        return $this->hasOne('App\Emergency');
    }

    /**
     * Has one hint
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function hint()
    {
        return $this->hasOne('App\Hint');
    }

    /**
     * Has one question
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function question()
    {
        return $this->hasOne('App\Question');
    }

    /**
     * The score of the questions
     * @return int
     */
    public function questionScore()
    {
        if (is_null($this->question)) {
            return 0;
        }
        return $this->question->calculate();
    }

    /**
     * The penalty of the hints
     * @return int
     */
    public function hintScore()
    {
        if (is_null($this->hint)) {
            return 0;
        }
        return $this->hint->calculate();
    }

    /**
     * The penalty of the emergencies
     * @return int
     */
    public function emergencyScore()
    {
        if (is_null($this->emergency)) {
            return 0;
        }
        return $this->emergency->calculate();
    }

    /**
     * The total score of the posts
     * @return int
     */
    public function postScore()
    {
        $postScore = $this->scores;
        $total = 0;
        if (is_null($this->scores)) {
            return $total;
        }
        foreach ($postScore as $post) {
            $total = $total + $post->score;
        }
        return $total;
    }

    /**
     * The final score for the route
     * @return int
     */
    public function routeScore($totalTimeScore)
    {
        $emergencyScore = $this->emergencyScore();
        $hintScore = $this->hintScore();

        return $totalTimeScore + $emergencyScore + $hintScore;
    }

    /**
     * The final score for this group
     * @return int
     */
    public function totalScore($totalTimeScore)
    {
        $question = $this->questionScore();
        $routeScore = $this->routeScore($totalTimeScore);
        $postScore = $this->postScore();

        return $question + $routeScore + $postScore;
    }
}
