<?php namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

/**
 * Class UserResource
 *
 * @author: Menno Hoekstra
 * @created: 08/02/18
 * @version: 1.0
 * @package App\Http\Resources
 */
class UserResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'roles' => new UserRelationshipResource($this)
        ];
    }
}
