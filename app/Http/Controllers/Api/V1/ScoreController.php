<?php namespace App\Http\Controllers\Api\V1;

use App\Result;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ScoreController extends Controller
{
    /**
     * @var Result
     */
    protected $result;

    /**
     * ScoreController constructor.
     * @param Result $result
     */
    public function __construct(Result $result)
    {
        $this->result = $result;
    }

    /**
     * @return array
     */
    public function results()
    {
        return $this->result->calculate();
    }
}
