<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Emergency extends Model
{
    protected $guarded = [];

    /**
     * Belongs to one Group
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function group()
    {
        return $this->belongsTo('App\Group');
    }

    /**
     * Calculate the emergency score for the group relation
     * @return float
     */
    public function calculate()
    {
        $totalEmergencies           = Setting::path('total_emergencies')->value('value');
        $emergencyPenalty           = Setting::path('emergency_penalty')->value('value');

        return ($this->closed - $totalEmergencies) * $emergencyPenalty;
    }
}
