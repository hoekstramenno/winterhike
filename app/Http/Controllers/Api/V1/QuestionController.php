<?php

namespace App\Http\Controllers\Api\V1;

use App\Question;
use App\Group;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\QuestionResource;

class QuestionController extends Controller
{

    /**
     * Show one Question for a group
     * @param Group $group
     * @return QuestionResource
     */
    public function show(Group $group)
    {
        $question = Question::where('group_id', $group->id)->first();

        QuestionResource::withoutWrapping();
        if ( ! is_null($question)) {
            return new QuestionResource($question);
        }

    }

    /**
     * Update a Question for a group
     * @param Group $group
     * @return QuestionResource
     */
    public function update(Request $request, Group $group)
    {
        $question = Question::updateOrCreate([
            'group_id' => $group->id
        ], [
            'right_answers' => request('right_answers')
        ]);
        return new QuestionResource($question);
    }
}
