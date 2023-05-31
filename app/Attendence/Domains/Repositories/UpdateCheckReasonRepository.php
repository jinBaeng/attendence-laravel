<?php
namespace App\Attendence\Domains\Repositories;

use Illuminate\Http\Request;
use App\Attendence\Domains\Entities\Attendence;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UpdateCheckReasonRepository implements UpdateCheckReasonRepositoryInterface{
    public function update($request ):bool{
        Log::info($request);
        if($request->accept == '1'){
            Log::info('kkkk');
            Attendence::where('id',$request->attendence_id)
                        ->update([
                            'check'=>"1",
                            'reason'=>NULL
                        ]);
            Log::info($re);
            return true;
        }else{
            Attendence::where('id',$request->attendence_id)
                        ->update(['reason'=>NULL]);
            return false;
        }
    }
}