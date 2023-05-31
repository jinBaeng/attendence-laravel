<?php
namespace App\Attendence\Domains\Repositories;

use App\Attendence\Domains\Entities\Attendence;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CheckAttendenceUserRepository implements CheckAttendenceUserRepositoryInterface{
    public function check($user , $id):bool{
        Log::info($user->id==Attendence::where('id',$id)->get('user_id')[0]->user_id );
        if($user->id !=Attendence::where('id',$id)->get('user_id')[0]->user_id ){
            Log::info('kk');
            return false;
        }
        return true;

    }
}
