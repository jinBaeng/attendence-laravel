<?php

namespace App\User\Actions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Common\Responders\RequestValidResponder;
use App\Common\Responders\RequestResponder;



class LoginAction extends Controller{

    protected $requestResponder;
    protected $validResponder;
    
    public function __construct(       
        RequestValidResponder $validResponder,
        RequestResponder $requestResponder,
    ){
        $this->requestResponder = $requestResponder;
        $this->validResponder = $validResponder;
    }


    public function __invoke(Request $request){
        $loginCredential =  validator($request->only('studentID' , 'password'),[
            'studentID'=>'required|string|max:255',
            'password'=>'required|string|min:6'
        ]);

        if($loginCredential->fails()){
            return $this->validResponder->response($loginCredential);
        }

        $loginCredential = request()->only('studentID', 'password');

        if (Auth::attempt($loginCredential)) {
            $request->session()->put('key',$loginCredential['studentID']);
            return $this->requestResponder->response(true,"login" , "user");
        }
        return $this->requestResponder->response(false,"login" , "user");
        
 

    }

}