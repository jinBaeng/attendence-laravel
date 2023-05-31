<?php
namespace App\Attendence\Domains\Repositories;

use Illuminate\Http\Request;
use App\Attendence\Domains\Entities\Attendence;
use Illuminate\Support\Facades\Log;


class ShowMyAttendecneRateRepository implements ShowMyAttendecneRateRepositoryInterface{
    public function show($user):object{
        $attendence = Attendence::where('user_id','=',$user->id)->get('check'); 
        return $attendence;
    }
}