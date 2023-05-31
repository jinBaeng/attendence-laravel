<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use \Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\util\GetHoliday;
use App\Models\Attendence;
use App\Models\Penalty;



use Illuminate\Support\Facades\Log;



class UserController extends Controller
{
    //
    public function currentUserInfo(){
        $user = Auth::User();
        Log::info($user);
        return response()->json([
            'user' =>Auth::user()
        ],Response::HTTP_OK);
    }
    
    public function fetchUsers(){
        return User::all();
    }

    public function test(){
        $holidays = (new GetHoliday)->getHoliday(2023,04);
        Log::info($holidays);
        if(count($holidays)>0){
            for($i=0;$i<count($holidays);$i++){
                if(date('Ymd')==$holidays[$i]){
                    return;
                }else{
                    foreach ( User::all() as $user){
                        if($user->studentID!= 'professor'){
                            $attendence = new Attendence;
                            $attendence->user_id=$user->id;
                            $attendence->check='3';
                            $attendence->save();
                        }
                    }
                }
            }
        }else{
            foreach ( User::all() as $user){
                if($user->studentID!= 'professor'){
                    $attendence = new Attendence;
                    $attendence->user_id=$user->id;
                    $attendence->check='3';
                    $attendence->save();
                }
            } 
        }

        // date_default_timezone_set('Asia/Seoul');
        // $year = date('Y');
        // $month = date('m');

        // //get holiday
        // $holidays = (new GetHoliday)->getHoliday($year,$month);
        // foreach ( Attendence::where('created_at' , '>' , date("Y-m-d"))->where('check','>','1')->get() as $att){
        //     $penalty = new Penalty;
        //     $penalty->user_id=$att->user_id;
        //     $penalty->attendence_id=$att->id;
        //     $penalty->clear=false;
        //     $penalty->save();
        // }
        return $holidays;

    }
}
