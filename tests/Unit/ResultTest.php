<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Post;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ResultTest extends TestCase
{
    use DatabaseMigrations;



    /**
     * @test
     */
    public function can_calculate_points_for_questions()
    {
        $group = create('App\Group');

        create('App\Question', [
            'group_id' => $group->id,
            'right_answers' => '7'
        ]);

        create('App\Setting', [
            'path' => 'total_questions',
            'value' => 10
        ]);

        create('App\Setting', [
            'path' => 'max_question_score',
            'value' => 70
        ]);

        // 7 right answers * (total / max)
        $this->assertEquals(49, $group->questionScore());
    }

    /**
     * @test
     */
    public function can_calculate_points_for_emergencies()
    {
        $group = create('App\Group');

        create('App\Emergency', [
            'group_id' => $group->id,
            'closed' => '5'
        ]);

        create('App\Setting', [
            'path' => 'total_emergencies',
            'value' => 10
        ]);

        create('App\Setting', [
            'path' => 'emergency_penalty',
            'value' => 10
        ]);

        // 7 right answers * (total / max)
        $this->assertEquals(-50, $group->emergencyScore());
    }

    /**
     * @test
     */
    public function can_calculate_points_for_hints()
    {
        $group = create('App\Group');

        create('App\Hint', [
            'group_id' => $group->id,
            'closed' => '5'
        ]);

        create('App\Setting', [
            'path' => 'total_hints',
            'value' => 10
        ]);

        create('App\Setting', [
            'path' => 'hint_penalty',
            'value' => 5
        ]);

        // 7 right answers * (total / max)
        $this->assertEquals(-25, $group->hintScore());
    }


    /**
     * @test
     */
    public function can_calculated_a_post_score()
    {
        $group = create('App\Group');

        for ($x =0; $x <= 2; $x++) {
            $post = create('App\Post');
            create('App\Score', [
                'group_id' => $group->id,
                'post_id' => $post->id,
                'score' => 10
            ]);
        }

        $this->assertEquals(30, $group->postScore());
    }


}
