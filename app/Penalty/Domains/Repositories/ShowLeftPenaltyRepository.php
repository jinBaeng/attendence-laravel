<?php
namespace App\Penalty\Domains\Repositories;

use Illuminate\Http\Request;
use App\Penalty\Domains\Entities\Penalty;

class ShowLeftPenaltyRepository implements ShowLeftPenaltyRepositoryInterface{
    public function show($user):object{
        $penalty = Penalty::where('user_id',$user->id)
        ->where('clear',false)
        ->with(['user'=> function ($query) {
            $query->select(['id','studentID','name']);
        }])
        ->get(['id','user_id','image','clear','created_at']);
        return $penalty;
    }
}

// 言ったらいいと言われました。