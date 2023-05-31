<?php
namespace App\Attendence\Domains\Repositories;

use Illuminate\Http\Request;
use App\Attendence\Domains\Entities\Attendence;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UpdateReasonRepository implements UpdateReasonRepositoryInterface{
    public function update($request , $user ):bool{
        $check = Attendence::where('id',$request->attendence_id)
            ->where('user_id',$user->id)
            ->update(['reason'=>$request->reason]);
        return $check;
    }
}