<?php
namespace App\Penalty\Actions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Penalty\Domains\Repositories\ShowPenaltyImgRepositoryInterface;



class ShowPenaltyImgAction extends Controller{

    protected $showPenaltyImg;

    public function __construct(
        ShowPenaltyImgRepositoryInterface $showPenaltyImg,
    ){
        $this->showPenaltyImg = $showPenaltyImg;
    }

    public function __invoke(Request $request ){
        $user = Auth::User();

        $penaltyImg = $this->showPenaltyImg->show($user);
        
        return response()->json([
            'penalty' =>$penaltyImg
        ],Response::HTTP_OK);


        // return $this->showAttendenceAllResponder->response($data);
    }

}