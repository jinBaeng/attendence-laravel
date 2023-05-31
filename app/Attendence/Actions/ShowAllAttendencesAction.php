<?php
namespace App\Attendence\Actions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Attendence\Domains\Repositories\ShowAllAttendencesRepositoryInterface;
use App\Attendence\Responders\AllAttendenceResponder;

// 모든 지각데이터

class ShowAllAttendencesAction extends Controller{

    protected $showAttendenceAll;
    protected $showAttendenceAllResponder;

    public function __construct(
        ShowAllAttendencesRepositoryInterface $showAttendenceAll,
        AllAttendenceResponder $showAttendenceAllResponder,
    ){
        $this->showAttendenceAll = $showAttendenceAll;
        $this->showAttendenceAllResponder = $showAttendenceAllResponder;
    }

    public function __invoke(Request $request ,$page){
        $data = $this->showAttendenceAll->show($page);
        return $this->showAttendenceAllResponder->response($data,$page);
    }

}