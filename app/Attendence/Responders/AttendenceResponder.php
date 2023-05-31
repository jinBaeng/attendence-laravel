<?php

namespace App\Attendence\Responders;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;


class AttendenceResponder{

    protected $reponse;

    public function __construct(Response $response){
        $this->response = $response;
    }

    public function response($attendence):Response{
        if(empty($attendence[0])==true){
            $this->response->setContent([
                'ok' =>false,
                'message' => 'not found attendence'
            ]);
            $this->response->setStatusCode(Response::HTTP_NOT_FOUND);
        }else if($attendence[0]->user->id == Auth::user()->id ){
            $this->response->setContent([
                'ok' =>true,
                'attendence' =>$attendence
            ]);
            $this->response->setStatusCode(Response::HTTP_OK);
        }else if($attendence[0]->user->id !== Auth::user()->id){
            $this->response->setContent([
                'ok' =>false,
                'message' => 'you can not access this content'
            ]);
            $this->response->setStatusCode(Response::HTTP_FORBIDDEN);
        }else{
            $this->response->setContent([
                'ok' =>false,
                'message' => 'error'
            ]);
        }

        return $this->response;

    }
}