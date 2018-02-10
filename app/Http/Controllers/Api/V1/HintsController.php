<?php

namespace App\Http\Controllers\Api\V1;

use App\Hint;
use App\Group;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\HintResource;

class HintsController extends Controller
{

    /**
     * Show one Hint for a group
     * @param Group $group
     * @return HintResource
     */
    public function show(Group $group)
    {
        $question = Hint::where('group_id', $group->id)->first();

        HintResource::withoutWrapping();
        if ( ! is_null($question)) {
            return new HintResource($question);
        }

    }

    /**
     * Update a Hint for a group
     * @param Group $group
     * @return HintResource
     */
    public function update(Request $request, Group $group)
    {
        $question = Hint::updateOrCreate([
            'group_id' => $group->id
        ], [
            'closed' => request('closed')
        ]);
        return new HintResource($question);
    }
}
