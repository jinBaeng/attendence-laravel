<?php
namespace App\Attendence\Domains\Repositories;

use Illuminate\Http\Request;
use App\Attendence\Domains\Entities\Attendence;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;



class ShowRankingRepository implements ShowRankingRepositoryInterface{
    public function show():object{
        $ranking = Attendence::select('user_id', 
                DB::raw('count(*) as total'))
                ->groupBy('user_id')
                ->where('check','>','1')
                ->with(['user'=> function ($query) {
                    $query->select(['id','name']);
                }])
                ->orderBy('total','desc')
                ->get();
        return $ranking;
    }
}