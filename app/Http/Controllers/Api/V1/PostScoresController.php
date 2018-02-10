<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreScoreRequest;
use App\Http\Resources\PostScoreResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use App\Group;
use App\Score;

class PostScoresController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:Admin'])->except(['show', 'store', 'update']);
    }

    /**
     * Show the scores of a post
     * @param Post $post
     * @return PostScoreResource
     */
    public function show(Post $post, Group $group)
    {
        if (Auth::user()->hasAnyRole(['Postbemanning ' . $post->number, 'Admin'])) {
            PostScoreResource::withoutWrapping();

            $postScore = $post->getScore($group->id);

            if ( ! is_null($postScore)) {
                return new PostScoreResource($postScore);
            }

            return new PostScoreResource(Score::make([
                'post_id' => $post->id,
                'group_id' => $group->id,
                'score' => 0
            ]));
        }
    }

    /**
     * Creates a Score Resource
     *
     * @param StoreScoreRequest $request
     * @param Post $post
     * @param Group $group
     * @return PostScoreResource|\Illuminate\Http\JsonResponse
     */
    public function store(StoreScoreRequest $request, Post $post, Group $group)
    {
        if (Auth::user()->hasAnyRole(['Postbemanning ' . $post->number, 'Admin'])) {
            PostScoreResource::withoutWrapping();

            $postScore = $post->getScore($group->id);

            if (is_null($postScore)) {
                $score = $post->addScore([
                    'score' => request('score'),
                    'group_id' => $group->id
                ]);

                return new PostScoreResource($score);
            }

            return response()->json([], 422);
        }
    }

    /**
     * Update a Score Resource
     * @param StoreScoreRequest $request
     * @param Post $post
     * @param Group $group
     * @return PostScoreResource
     */
    public function update(StoreScoreRequest $request, Post $post, Group $group)
    {
        if (Auth::user()->hasAnyRole(['Postbemanning ' . $post->number, 'Admin'])) {
            $postScore = $post->getScore($group->id);

            if (is_null($postScore)) {
                $score = $post->addScore([
                    'score' => request('score'),
                    'group_id' => $group->id
                ]);
            } else {
                $score = $post->updateScore($group->id, request('score'));
            }

            return new PostScoreResource($score);
        }
    }
}
