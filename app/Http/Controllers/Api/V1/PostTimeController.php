<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Support\Facades\Auth;
use App\Http\Resources\TimeResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use App\Group;
use App\Time;

class PostTimeController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:Admin')->except(['show', 'departure', 'arrival']);
    }

    /**
     * Show the scores of a post
     * @param Post $post
     * @param Group $group
     * @return TimeResource
     */
    public function show(Post $post, Group $group)
    {
        if (Auth::user()->hasAnyRole(['Postbemanning ' . $post->number, 'Admin'])) {
            TimeResource::withoutWrapping();

            $postTime = Time::where('post_id', $post->id)->where('group_id', $group->id)->first();

            if ( ! is_null($postTime)) {
                return new TimeResource($postTime);
            }
        }
    }

    public function departure(Request $request, Post $post, Group $group)
    {
        if (Auth::user()->hasAnyRole(['Postbemanning ' . $post->number, 'Admin'])) {
            $this->createIfNotExists($post, $group);
            $time = $post->updateDeparture($group->id);

            return new TimeResource($time);
        }
    }

    public function arrival(Request $request, Post $post, Group $group)
    {
        if (Auth::user()->hasAnyRole(['Postbemanning ' . $post->number, 'Admin'])) {
            $this->createIfNotExists($post, $group);
            $time = $post->updateArrival($group->id);

            return new TimeResource($time);
        }
    }

    /**
     * @param Post $post
     * @param Group $group
     */
    protected function createIfNotExists(Post $post, Group $group)
    {
        $postTime = $post->getTime($group->id);

        if (is_null($postTime)) {
            $post->addTime([
                'group_id' => $group->id
            ]);
        }
    }
}
