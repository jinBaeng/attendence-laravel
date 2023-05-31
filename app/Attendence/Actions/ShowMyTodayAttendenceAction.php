<?php
namespace App\Attendence\Actions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Attendence\Domains\Repositories\ShowMyTodayAttendenceRepositoryInterface;
use App\Attendence\Responders\AttendenceResponder;



class ShowMyTodayAttendenceAction extends Controller{

    protected $showAttendence;
    protected $showAttendenceResponder;

    public function __construct(
        ShowMyTodayAttendenceRepositoryInterface $showAttendence,
        AttendenceResponder $showAttendenceResponder
    ){
        $this->showAttendence = $showAttendence;
        $this->showAttendenceResponder = $showAttendenceResponder;
    }

    public function __invoke(Request $request ){
        $user = Auth::User();
        $attendence = $this->showAttendence->show($user);
        
        return $this->showAttendenceResponder->response($attendence);
    }

}