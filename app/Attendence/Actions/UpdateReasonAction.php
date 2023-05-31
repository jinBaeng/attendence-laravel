<?php
namespace App\Attendence\Actions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Attendence\Domains\Repositories\UpdateReasonRepositoryInterface;
use App\Attendence\Domains\Repositories\CheckAttendenceUserRepositoryInterface;
use App\Common\Responders\RequestResponder;
use App\Common\Responders\CheckUserResponder;
use App\Common\Responders\RequestValidResponder;



class UpdateReasonAction extends Controller{

    protected $updateReason;
    protected $requestResponder;
    protected $checkUser;
    protected $validResponder;
    protected $checkUserResponder;


    public function __construct(
        UpdateReasonRepositoryInterface $updateReason,
        RequestResponder $requestResponder,
        CheckAttendenceUserRepositoryInterface $checkUser,
        RequestValidResponder $validResponder,
        CheckUserResponder $checkUserResponder

    ){
        $this->updateReason = $updateReason;
        $this->requestResponder = $requestResponder;
        $this->checkUser = $checkUser;
        $this->validResponder = $validResponder;
        $this->checkUserResponder = $checkUserResponder;

    }

    public function __invoke(Request $request ){
        Log::info($request);
        Log::info(Auth::User());
        $valid = validator($request->only('attendence_id' , 'reason'  ),[
            'attendence_id' =>'required',
            'reason'=> 'required|string',
        ]);
        
        if($valid->fails()){
            return $this->validResponder->response($valid);
        }
        
        // 1:출석 2:지각 3:결석
        $user = Auth::User();

        $check = $this->checkUser->check($user , $request->attendence_id);
        Log::info('kkk'.$check);
        if($check==false){
            return $this->checkUserResponder->response();
        }

        $clear = $this->updateReason->update($request , $user );
        return $this->requestResponder->response($clear,"update" , "attendence reason");

    }

}