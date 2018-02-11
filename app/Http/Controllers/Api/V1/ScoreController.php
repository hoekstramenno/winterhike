<?php namespace App\Http\Controllers\Api\V1;

use App\Result;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Calculators\Winterhike\Results as OldResults;

class ScoreController extends Controller
{
    /**
     * @var Result
     */
    protected $result;

    /**
     * @var OldResult
     */
    protected $oldResults;

    /**
     * ScoreController constructor.
     * @param Result $result
     */
    public function __construct(Result $result, OldResults $oldResults)
    {
        $this->result = $result;
        $this->oldResults = $oldResults;
    }

    /**
     * @return array
     */
    public function results()
    {
        return $this->result->calculate();
    }

    /**
     * @return array
     */
    public function oldResults()
    {
        return $this->oldResults->totals();
    }
}
