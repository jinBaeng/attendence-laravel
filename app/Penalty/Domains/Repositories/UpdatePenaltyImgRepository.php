<?php
namespace App\Penalty\Domains\Repositories;

use Illuminate\Http\Request;
use App\Penalty\Domains\Entities\Penalty;

class UpdatePenaltyImgRepository implements UpdatePenaltyImgRepositoryInterface{
    public function update($request , $user , $image):bool{
        Penalty::where('id',$request->penalty_id)
                ->where('user_id',$user->id)
                ->update([
                    'clear'=>true,
                    'image'=>$image
                ]);
        return true;
    }
}

// 言ったらいいと言われました。