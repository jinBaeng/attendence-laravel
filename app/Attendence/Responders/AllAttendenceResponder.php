<?php

namespace App\Attendence\Responders;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;


class AllAttendenceResponder{

    protected $reponse;

    public function __construct(Response $response){
        $this->response = $response;
    }

    public function response($attendences,$page):Response{
        if($attendences['pages']==0||$page >$attendences['pages']){
            $this->response->setContent([
                'ok' =>false,
                'message' => 'not found attendences'
            ]);
            $this->response->setStatusCode(Response::HTTP_NOT_FOUND);
        }else{
            $this->response->setContent([
                'ok' =>true,
                'pages' =>$attendences['pages'],
                'attendences' =>$attendences['attendences']
            ]);
            $this->response->setStatusCode(Response::HTTP_OK);
        }

        return $this->response;

    }
}