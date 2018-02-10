<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ScoresResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return PostScoreResource
     */

    public function toArray($request)
    {
        return PostScoreResource::collection($this->collection);
    }
}
