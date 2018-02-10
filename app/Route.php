<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Group;

class Route extends Model
{
    protected $guarded = [];

    protected $maxRouteScore = 0;


    public static function calculate()
    {
        $routes = Route::all();
        $groups = Group::with('times')->get();
        $maxRouteScore = Setting::path('max_route_score')->value('value');

        $scores = [];

        foreach ($routes as $route) {
            $scores[] = (new Route)->calculateOneRoute($groups, $route, $maxRouteScore);
        }

        return $scores;
    }

    public function calculateOneRoute($groups, $route, $maxRouteScore)
    {
        $times = [];


        $extractPostInBetween = false;

        $difference = $route->post_end - $route->post_start;
        if ($difference > 1) {
            $extractPostInBetween = true;
        }

        foreach ($groups as $group) {
            $startPost = '';
            $endPost = '';

            foreach ($group->times as $time) {

                if ($time->post_id == $route->post_start) {
                    $startPost  = $time;
                }
                if ($time->post_id == $route->post_end) {
                    $endPost  = $time;
                }
            }

            $inBetween = 0;

            $times[$group->id] = [
                'time' => 0
            ];

            if ($startPost !== '' && $endPost !== '') {
                if ($extractPostInBetween) {
                    for ($number = $route->post_start + 1; $number < $route->post_end; $number++) {
                        $betweenPost = $group->times()->where('post_id', $number)->first();
                        $inBetween = $inBetween + (strtotime($betweenPost->departure) - strtotime($betweenPost->arrival));
                    }
                }


                if (isset($endPost->arrival) && isset($startPost->departure)) {
                    $times[$group->id] = [
                        'time' => strtotime($endPost->arrival) - strtotime($startPost->departure) - $inBetween
                    ];
                }
            }
        }

        asort($times);

        $routeScore = $maxRouteScore;

        foreach($times as $groupId => $time) {
            if ($time['time'] == '00:00:00') {
                $times[$groupId]['score'] = 0;
                continue;
            }
            $times[$groupId]['score'] = $routeScore;
            $routeScore--;
        }

        return $times;
    }
    
}


