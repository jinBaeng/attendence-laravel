<?php
namespace App\Penalty\Domains\Repositories;

use Illuminate\Http\Request;
use App\Penalty\Domains\Entities\Penalty;
use Illuminate\Support\Facades\DB;


class ShowLeftAllPenaltyRepository implements ShowLeftAllPenaltyRepositoryInterface{
    public function show():object{
        $leftAll = Penalty::select('user_id',DB::raw('count(*) as total'))
                            ->groupBy('user_id')
                            ->where('clear',false)
                            ->with(['user'=> function ($query) {
                                $query->select(['id','studentID','name']);
                            }])
                            ->get();
        return $leftAll;
    }
}

// 言ったらいいと言われました。