<?php
namespace App\Attendence\Actions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Common\Responders\RequestResponder;
use App\Attendence\Domains\Repositories\UpdateCheckReasonRepositoryInterface;
use App\Penalty\Domains\Repositories\DeletePenaltyRepositoryInterface;



class UpdateCheckReasonAction extends Controller{

    protected $updateReason;
    protected $deletePenalty;
    protected $requestResponder;

    public function __construct(
        UpdateCheckReasonRepositoryInterface $updateReason,
        DeletePenaltyRepositoryInterface $deletePenalty,
        RequestResponder $requestResponder,
        
    ){
        $this->updateReason = $updateReason;
        $this->deletePenalty = $deletePenalty;
        $this->requestResponder = $requestResponder;

    }

    public function __invoke(Request $request ){

        $valid = validator($request->only('check'),[
            'check' =>'1|2',
        ]);
        Log:info($request);
        if($valid->fails()){
            return $this->validResponder->response($valid);
        }

        $clear = $this->updateReason->update($request);

        if($clear){
            $deletedData = $this->deletePenalty->delete($request);
        }

        return $this->requestResponder->response($clear,"update" , "check attendence");
    }

}