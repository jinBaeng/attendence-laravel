<?php
namespace App\Penalty\Actions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Penalty\Domains\Repositories\ShowAllPenaltyRepositoryInterface;



class ShowAllPenaltyAction extends Controller{

    protected $showPenalty;

    public function __construct(
        ShowAllPenaltyRepositoryInterface $showPenalty,
    ){
        $this->showPenalty = $showPenalty;
    }

    public function __invoke(Request $request ){
        $user = Auth::User();

        $penalty = $this->showPenalty->show($user);
        
        return response()->json([
            'penalty' =>$penalty
        ],Response::HTTP_OK);


        // return $this->showAttendenceAllResponder->response($data);
    }

}