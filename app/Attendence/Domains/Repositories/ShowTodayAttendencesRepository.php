<?php
namespace App\Attendence\Domains\Repositories;

use Illuminate\Http\Request;
use App\Attendence\Domains\Entities\Attendence;

class ShowTodayAttendencesRepository implements ShowTodayAttendencesRepositoryInterface{
    public function show($page):array{
        $attendence = Attendence::where('created_at','>',date("Y-m-d"))
        ->skip(($page - 1) * 10)->take(10)
        ->with(['user'=> function ($query) {
            $query->select(['id' , 'studentID','name','group']);
        }])
        // ->orderBy('group','asc')
        ->get(['user_id','check','reason','created_at']);
        $pages = ceil(Attendence::where('created_at','>',date("Y-m-d"))->count()/10);
        return [
            'pages' => $pages,
            'attendences' => $attendence
        ];   
        
    }
}