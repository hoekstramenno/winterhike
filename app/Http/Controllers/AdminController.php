<?php

namespace App\Http\Controllers;

use App\Post;
use App\Group;
use App\Score;
use App\Time;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        foreach(Post::all() as $post){
//            foreach(Group::all() as $group) {
//                Score::create([
//                    'post_id' => $post->id,
//                    'group_id' => $group->id,
//                    'score' => rand(0,20)
//                ]);
//            }
//        }
//
//                foreach(Group::all() as $group){
//                    $arrival = '2018-02-05 12:00:00';
//                    $end = '2018-02-05 12:00:00';
//                    foreach(Post::all() as $post) {
//
//                        $minutesRoute = rand(40, 120);
//                        $minutesPost = rand(10, 35);
//
//                        $arrival = date('Y-m-d H:i:s', strtotime('+' . $minutesRoute . ' minutes', strtotime($end)));
//                        $end = date('Y-m-d H:i:s', strtotime('+' . $minutesPost . ' minutes', strtotime($arrival)));
//
//                        Time::create([
//                            'post_id' => $post->id,
//                            'group_id' => $group->id,
//                            'arrival' => $arrival,
//                            'departure' => $end
//                        ]);
//                    }
//                }



        return view('admin.home');
    }
}
