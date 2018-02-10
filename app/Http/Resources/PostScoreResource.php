<?php namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class PostScoreResource extends Resource
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
            'post' => $this->post_id,
            'group' => $this->group_id,
            'score' => $this->score
        ];
    }
}
