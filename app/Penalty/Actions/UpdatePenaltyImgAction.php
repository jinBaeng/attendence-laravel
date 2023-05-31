<?php
namespace App\Penalty\Actions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Penalty\Domains\Repositories\UpdatePenaltyImgRepositoryInterface;



class UpdatePenaltyImgAction extends Controller{

    protected $updatePenaltyImg;

    public function __construct(
        UpdatePenaltyImgRepositoryInterface $updatePenaltyImg,
    ){
        $this->updatePenaltyImg = $updatePenaltyImg;
    }

    public function __invoke(Request $request ){
        $user = Auth::User();

        $originalName = pathinfo($request->file('image')->getClientOriginalName(), PATHINFO_FILENAME);
        $time = time();
        $extension = $request->file('image')->extension();
        $image = $request->image->storeAs('public/images',$originalName.$time.'.'.$extension);
        $image = substr($image,7);

        $clear = $this->updatePenaltyImg->update($request , $user , $image);
        
        return response()->json([
            'penalty' =>$clear
        ],Response::HTTP_OK);


        // return $this->showAttendenceAllResponder->response($data);
    }

}