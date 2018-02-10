<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];

    /**
     * Table name
     * @var string
     */
    protected $table = 'posts';


    /**
     * Has many times
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function times()
    {
        return $this->hasMany('App\Time', 'post_id', 'id');
    }

    /**
     * A Post has many scores
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function scores()
    {
        return $this->hasMany('App\Score');
    }

    /**
     * Creates a score
     * @param $params
     * @return Model
     */
    public function addScore($params)
    {
        return $this->scores()->create($params);
    }

    /**
     * Update a score
     * @param $groupId
     * @param $score
     * @return Model
     */
    public function updateScore($groupId, $score)
    {
        $this->scores()->where('group_id', $groupId)->update(['score' => $score]);
        return $this->getScore($groupId);
    }

    /**
     * Get the score
     * @param $groupId
     * @return Model|null|static
     */
    public function getScore($groupId)
    {
        return $this->scores()->where('group_id', $groupId)->first();
    }

    /**
     * Get the time
     * @param $groupId
     * @return Model|null|static
     */
    public function getTime($groupId)
    {
        return $this->times()->where('group_id', $groupId)->first();
    }

    /**
     * Creates a score
     * @param $params
     * @return Model
     */
    public function addTime($params)
    {
        return $this->times()->create($params);
    }

    /**
     * Update a the arrival
     * @param $groupId
     * @return Model
     */
    public function updateArrival($groupId)
    {
        $this->times()->where('group_id', $groupId)->update([
            'arrival' => date('Y-m-d H:i:s')
        ]);
        return $this->getTime($groupId);
    }

    /**
     * Update a the arrival
     * @param $groupId
     * @return Model
     */
    public function updateDeparture($groupId)
    {
        $this->times()->where('group_id', $groupId)->update([
            'departure' => date('Y-m-d H:i:s')
        ]);
        return $this->getTime($groupId);
    }
}
