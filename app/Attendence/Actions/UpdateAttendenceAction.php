<?php
namespace App\Attendence\Actions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Attendence\Domains\Repositories\UpdateAttendenceRepositoryInterface;
use App\Common\Responders\RequestResponder;



class UpdateAttendenceAction extends Controller{

    protected $updateReason;
    protected $requestResponder;

    public function __construct(
        UpdateAttendenceRepositoryInterface $updateReason,
        RequestResponder $requestResponder,

    ){
        $this->updateReason = $updateReason;
        $this->requestResponder = $requestResponder;

    }

    public function __invoke(Request $request ){
        // 1:출석 2:지각 3:결석
        $user = Auth::User();
        $clear = $this->updateReason->update($request , $user );

        return $this->requestResponder->response($clear,"update" , "check attendence");

    }

}