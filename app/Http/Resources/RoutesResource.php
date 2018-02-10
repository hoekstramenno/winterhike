<?php

namespace App\Http\Resources;

use App\Http\Resources\RouteResource as RouteResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class RoutesResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function toArray($request)
    {
        return RouteResource::collection($this->collection);
    }
}
