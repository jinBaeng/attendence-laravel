<?php
namespace App\Attendence\Actions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Attendence\Domains\Repositories\ShowTodayAttendencesRepositoryInterface;
use App\Attendence\Responders\AllAttendenceResponder;



class ShowTodayAttendencesAction extends Controller{

    protected $showAttendenceAll;
    protected $showAttendenceAllResponder;

    public function __construct(
        ShowTodayAttendencesRepositoryInterface $ShowTodayAttendences,
        AllAttendenceResponder $showAttendenceAllResponder
    ){
        $this->ShowTodayAttendences = $ShowTodayAttendences;
        $this->showAttendenceAllResponder = $showAttendenceAllResponder;
    }

    public function __invoke(Request $request , $page ){
        $data = $this->ShowTodayAttendences->show($page);
        return $this->showAttendenceAllResponder->response($data,$page);
    }

}