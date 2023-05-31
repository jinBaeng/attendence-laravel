<?php
namespace App\Penalty\Domains\Repositories;

use Illuminate\Http\Request;
use App\Penalty\Domains\Entities\Penalty;

class ShowPenaltyClearImgRepository implements ShowPenaltyClearImgRepositoryInterface{
    public function show():object{
        $image = Penalty::where('clear',true)
                        ->with(['user'=> function ($query) {
                            $query->select(['studentID','name']);
                        }])
                        ->with(['attendence'=> function ($query) {
                            $query->select('id','created_at');
                        }])
                        ->get(['id','user_id','image','attendence_id']);
        return $image;
    }
}

// 言ったらいいと言われました。