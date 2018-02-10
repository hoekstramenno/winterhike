<?php

namespace App\Http\Resources;

use App\Http\Resources\RoleResource as RoleResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class RolesResource
 *
 * @author: Menno Hoekstra
 * @created: 07/02/18
 * @version: 1.0
 * @package App\Http\Resources
 */
class RolesResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function toArray($request)
    {
        return RoleResource::collection($this->collection);
    }
}
