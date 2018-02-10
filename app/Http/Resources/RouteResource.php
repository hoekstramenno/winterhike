<?php namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class RouteResource extends Resource
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
            'number' => $this->number,
            'post_start' => $this->post_start,
            'post_end' => $this->post_end,
        ];
    }
}
