<?php

namespace App;

use App\Setting;

use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    protected $guarded = [];

    /**
     * Score belongs to Many Groups
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function group()
    {
        return $this->belongsTo('App\Group');
    }
}
