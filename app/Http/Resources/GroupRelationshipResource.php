<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class GroupRelationshipResource extends Resource
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

          'times' => (new TimesResource($this->whenLoaded('times'))),
          'scores' => (new ScoresResource($this->whenLoaded('scores'))),
          'questions' => (new QuestionResource($this->whenLoaded('question'))),
          'emergency' => (new EmergencyResource($this->whenLoaded('emergency'))),
          'hint' => (new HintResource($this->whenLoaded('hint')))

        ];
    }
}
