<?php namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class TimeResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $array = [
            'post' => $this->post_id,
            'arrival' => $this->when(!is_null($this->arrival), date('H:i:s', strtotime($this->arrival))),
            'departure' => $this->when(!is_null($this->departure), date('H:i:s', strtotime($this->departure))),
        ];

        if ($this->departure && $this->arrival) {
            $seconds = strtotime($this->departure) - strtotime($this->arrival);
            $array['seconds'] = $seconds;
            $array['total'] = date('H:i:s', $seconds);
        }

        return $array;
    }
}
