<?php
namespace App\User\Actions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use App\User\Domain\Repositories\ShowGroupAttendenceRepositoryInterface;



class ShowGroupAttendenceAction extends Controller{

    protected $showAttendence;

    public function __construct(
        ShowGroupAttendenceRepositoryInterface $showAttendence,
    ){
        $this->showAttendence = $showAttendence;
    }

    public function __invoke(Request $request ){
        $user = Auth::User();
        Log::info($user);
        $attendence = $this->showAttendence->show($user);

        return response()->json([
            "att_rate"=>$attendence
        ],Response::HTTP_OK);


        // return $this->showAttendenceAllResponder->response($data);
    }

}