<?php namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

/**
 * Class RoleResource
 *
 * @author: Menno Hoekstra
 * @created: 07/02/18
 * @version: 1.0
 * @package App\Http\Resources
 */
class RoleResource extends Resource
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
            'guard_name' => $this->guard_name,
            'permissions' => new PermissionsResource($this->whenLoaded('permissions'))
        ];
    }
}
