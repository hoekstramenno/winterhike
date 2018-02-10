<?php namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Symfony\Component\Console\Question\Question;

class QuestionsResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function toArray($request)
    {
        return QuestionResource::collection($this->collection);
}
}
