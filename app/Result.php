<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Group;
use App\Route;

class Result extends Model
{
    public function calculate()
    {
        $groups = Group::with(['hint', 'question', 'emergency', 'scores'])->get([
            'id',
            'name',
            'groupname'
        ]);
        $result = [];

        $routes = Route::calculate();

        foreach ($groups as $group) {

            $totalTimeScore = $this->calculateTotalTimeForGroup($routes, $group->id);

            $row = [
                'group' => $group,
                'score' => [
                    'questions' => $group->questionScore(),
                    'posts' => $group->postScore(),
                    'hints' => $group->hintScore(),
                    'time' => $totalTimeScore,
                    'emergency' => $group->emergencyScore(),
                    'route' => $group->routeScore($totalTimeScore),
                    'total' => $group->totalScore($totalTimeScore)
                ],
                'routes' => $this->calculateRouteTime($routes, $group->id)
            ];

            array_push($result, $row);
        }

        usort($result, function ($item1, $item2) {
            return $item2['score']['total'] <=> $item1['score']['total'];
        });

        return $result;
    }

    /**
     * Calculate the time for a group
     * @param $routes
     * @param $groupId
     * @return int
     */
    public function calculateTotalTimeForGroup($routes, $groupId)
    {
        $total = 0;
        foreach ($routes as $route) {
            if (isset($route[$groupId])) {
                $total = $total + $route[$groupId]['score'];
            }

        }

        return $total;
    }

    /**
     * Calculate the time of a Route
     * @param $routes
     * @param $groupId
     * @return array
     */
    public function calculateRouteTime($routes, $groupId)
    {
        $times = [];
        foreach ($routes as $route) {
            if (isset($route[$groupId])) {
                $times[] = [
                    'time' => date('H:i:s', $route[$groupId]['time']),
                    'seconds' => $route[$groupId]['time'],
                    'score' => $route[$groupId]['score']
                ];
            }
        }

        return $times;
    }
}
