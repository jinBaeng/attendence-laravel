<?php
namespace App\Penalty\Actions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Penalty\Domains\Repositories\ShowLeftAllPenaltyRepositoryInterface;



class ShowLeftAllPenaltyAction extends Controller{

    protected $showPenalty;

    public function __construct(
        ShowLeftAllPenaltyRepositoryInterface $showPenalty,
    ){
        $this->showPenalty = $showPenalty;
    }

    public function __invoke(Request $request ){
        $penalty = $this->showPenalty->show();
        return response()->json([
            'penalty' =>$penalty
        ],Response::HTTP_OK);


        // return $this->showAttendenceAllResponder->response($data);
    }

}