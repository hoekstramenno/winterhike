<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hint extends Model
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
     * Calculate the hint score for the group relation
     * @return float
     */
    public function calculate()
    {
        $totalHints            = Setting::path('total_hints')->value('value');
        $hintPenalty           = Setting::path('hint_penalty')->value('value');
        return ($this->closed - $totalHints) * $hintPenalty;
    }
}
