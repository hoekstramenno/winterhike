<?php

namespace App\Http\Controllers\Api\V1;

use App\Emergency;
use App\Group;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\EmergencyResource;

class EmergencyController extends Controller
{

    /**
     * Show one Emergency for a group
     * @param Group $group
     * @return EmergencyResource
     */
    public function show(Group $group)
    {
        $question = Emergency::where('group_id', $group->id)->first();

        EmergencyResource::withoutWrapping();
        if ( ! is_null($question)) {
            return new EmergencyResource($question);
        }

    }

    /**
     * Update a Emergency for a group
     * @param Group $group
     * @return EmergencyResource
     */
    public function update(Request $request, Group $group)
    {
        $question = Emergency::updateOrCreate([
            'group_id' => $group->id
        ], [
            'closed' => request('closed')
        ]);
        return new EmergencyResource($question);
    }
}
