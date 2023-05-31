<?php
namespace App\Attendence\Domains\Repositories;

use Illuminate\Http\Request;
use App\Attendence\Domains\Entities\Attendence;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UpdateAttendenceRepository implements UpdateAttendenceRepositoryInterface{
    public function update($request , $user ):bool{
        $data = Attendence::where('user_id',$user->id)
        ->where('created_at' , '>' , date("Y-m-d"))
        ->update(['check'=>$request->check]);
        return $data;
    }
}