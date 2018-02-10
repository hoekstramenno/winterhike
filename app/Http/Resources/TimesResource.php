<?php namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TimesResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function toArray($request)
    {
        return TimeResource::collection($this->collection);
}
}
