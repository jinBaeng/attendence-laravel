<?php
namespace App\Penalty\Domains\Repositories;

use Illuminate\Http\Request;
use App\Penalty\Domains\Entities\Penalty;

class ShowPenaltyImgRepository implements ShowPenaltyImgRepositoryInterface{
    public function show($user):object{
        $image = Penalty::where('user_id',$user->id)
                        ->whereNotNull('image')
                        ->get(['id','image']);
        return $image;
    }
}

// 言ったらいいと言われました。