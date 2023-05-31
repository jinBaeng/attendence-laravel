<?php
namespace App\Penalty\Actions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Penalty\Domains\Repositories\ShowPenaltyClearImgRepositoryInterface;



class ShowPenaltyClearImgAction extends Controller{

    protected $showPenaltyImg;

    public function __construct(
        ShowPenaltyClearImgRepositoryInterface $showPenaltyImg,
    ){
        $this->showPenaltyImg = $showPenaltyImg;
    }

    public function __invoke(Request $request ){

        $penaltyImg = $this->showPenaltyImg->show();
        
        return response()->json([
            'penalty' =>$penaltyImg
        ],Response::HTTP_OK);

    }

}