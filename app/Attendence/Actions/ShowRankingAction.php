<?php
namespace App\Attendence\Actions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Attendence\Domains\Repositories\ShowRankingRepositoryInterface;



class ShowRankingAction extends Controller{

    protected $showAttendence;

    public function __construct(
        ShowRankingRepositoryInterface $showAttendence,
    ){
        $this->showAttendence = $showAttendence;
    }

    public function __invoke(Request $request ){
        $attendence = $this->showAttendence->show();
        return $attendence;
        // return $this->showAttendenceAllResponder->response($data);
    }

}