<?php
namespace App\User\Domain\Repositories;

use Illuminate\Http\Request;
use App\User\Domain\Entities\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ShowGroupAttendenceRepository implements ShowGroupAttendenceRepositoryInterface{
    public function show($user):object{
        $groupAtt = User::where('group',$user->group)
                        ->with(['attendences'=>function($query){
                            $query->select(['check','reason','user_id'])
                            ->where('created_at','>',date("Y-m-d"));
                        }])
                        ->get(['id','name','studentID','group']);
        
        $user = Auth::User();
        return $groupAtt;
    }
}