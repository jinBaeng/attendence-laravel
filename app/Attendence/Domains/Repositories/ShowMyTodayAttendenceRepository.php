<?php
namespace App\Attendence\Domains\Repositories;

use Illuminate\Http\Request;
use App\Attendence\Domains\Entities\Attendence;
use Illuminate\Support\Facades\Log;


class ShowMyTodayAttendenceRepository implements ShowMyTodayAttendenceRepositoryInterface{
    public function show($user):object{
        Log::info('my today');
        $attendence = Attendence::where('user_id',$user->id)
                                ->where('created_at','>',date("Y-m-d"))
                                ->with(['user'=> function ($query) {
                                    $query->select(['studentID','name']);
                                }])
                                ->get(['id','user_id','check','reason','created_at']);
        return $attendence;
    }
}