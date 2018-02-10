<?php

namespace App\Http\Resources;

use App\Http\Resources\PermissionResource as PermissionResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class PermissionsResource
 *
 * @author: Menno Hoekstra
 * @created: 07/02/18
 * @version: 1.0
 * @package App\Http\Resources
 */
class PermissionsResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function toArray($request)
    {
        return PermissionResource::collection($this->collection);
    }
}
