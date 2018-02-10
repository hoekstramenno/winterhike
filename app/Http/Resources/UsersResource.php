<?php namespace App\Http\Resources;

use App\Http\Resources\GroupResource as GroupResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class UsersResource
 *
 * @author: Menno Hoekstra
 * @created: 08/02/18
 * @version: 1.0
 * @package App\Http\Resources
 */
class UsersResource extends ResourceCollection
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function toArray($request)
    {
        return UserResource::collection($this->collection);
    }
}
