<?php
namespace App\Attendence\Actions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Attendence\Domains\Repositories\ShowMyAttendecneRateRepositoryInterface;



class ShowMyAttendenceRateAction extends Controller{

    protected $showRate;

    public function __construct(
        ShowMyAttendecneRateRepositoryInterface $showRate,
    ){
        $this->showRate = $showRate;
    }

    public function __invoke(Request $request ){
        $user = Auth::User();
        $attendence = $this->showRate->show($user);
        $totalAtt =0;
        $total= 0 ;
        foreach($attendence as $att){
            $total++;
            if($att->check ==1){
                $totalAtt++;
            }
        }

        $avg = $totalAtt / $total;
        return response()->json([
            "ok"=>true,
            "att_rate"=>$avg
        ],Response::HTTP_OK);


        // return $this->showAttendenceAllResponder->response($data);
    }

}