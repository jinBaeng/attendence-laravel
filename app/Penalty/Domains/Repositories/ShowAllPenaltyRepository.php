<?php
namespace App\Penalty\Domains\Repositories;

use Illuminate\Http\Request;
use App\Penalty\Domains\Entities\Penalty;

class ShowAllPenaltyRepository implements ShowAllPenaltyRepositoryInterface{
    public function show($user):object{
        $penalty = Penalty::where('user_id',$user->id)
                            ->with(['user'=> function ($query) {
                                $query->select(['studentID','name','id',]);
                            }])
                            ->get(['id','user_id','image','clear','created_at']);
        return $penalty;
    }
}

// 言ったらいいと言われました。