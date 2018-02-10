<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Group;
use App\Setting;


class Question extends Model
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
     * Calculate the question score for the group relation
     * @return float
     */
    public function calculate()
    {
        $totalQuestions     = Setting::path('total_questions')->value('value');
        $maxScore           = Setting::path('max_question_score')->value('value');
        return round($this->right_answers * ($maxScore / $totalQuestions));
    }
}
