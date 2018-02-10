<?php namespace App\Http\Resources;

use App\Http\Resources\GroupResource as GroupResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class GroupsResource
 *
 * @author: Menno Hoekstra
 * @created: 08/02/18
 * @version: 1.0
 * @package App\Http\Resources
 */
class GroupsResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function toArray($request)
    {
        return GroupResource::collection($this->collection);
    }
}
