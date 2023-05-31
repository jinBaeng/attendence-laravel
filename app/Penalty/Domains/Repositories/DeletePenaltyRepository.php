<?php
namespace App\Penalty\Domains\Repositories;


use Illuminate\Http\Request;
use App\Penalty\Domains\Entities\Penalty;
use Illuminate\Support\Facades\Auth;

class DeletePenaltyRepository implements DeletePenaltyRepositoryInterface{
    public function delete($request):bool{
        Penalty::where('attendence_id',$request->attendence_id)
        ->delete();

        return true;
    }
}