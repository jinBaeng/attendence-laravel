<?php
namespace App\Attendence\Domains\Repositories;

use Illuminate\Http\Request;
use App\Attendence\Domains\Entities\Attendence;

class ShowAllAttendencesRepository implements ShowAllAttendencesRepositoryInterface{
    public function show($page):array{
        $attendence = Attendence::skip(($page - 1) * 10)->take(10)
                                ->with(['user'=> function ($query) {
                                    $query->select(['id','studentID','name']);
                                }])
                                ->get(['user_id','check','reason','created_at']);
        $pages = ceil(Attendence::count()/10);
        return [
            'pages' => $pages,
            'attendences' => $attendence
        ];   
        
    }
}