<?php namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

/**
 * Class UserRelationshipResource
 *
 * @author: Menno Hoekstra
 * @created: 08/02/18
 * @version: 1.0
 * @package App\Http\Resources
 */
class UserRelationshipResource extends Resource
{
    /**
     * Transform the resource into an array.
     * @param \Illuminate\Http\Request $request
     * @return RolesResource|array
     */
    public function toArray($request)
    {
        return new RolesResource($this->whenLoaded('roles'));
    }
}
