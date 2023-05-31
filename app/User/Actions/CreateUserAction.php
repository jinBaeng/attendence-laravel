<?php

namespace App\User\Actions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\User\Domain\Repositories\CreateUserRepositoryInterface;
use App\Common\Responders\RequestResponder;
use App\Common\Responders\RequestValidResponder;

class CreateUserAction extends Controller{

    protected $createUser;
    protected $requestResponder;
    protected $validResponder;

    public function __construct(
        CreateUserRepositoryInterface $createUser,
        RequestResponder $requestResponder,
        RequestValidResponder $validResponder
    ){
        $this->createUser = $createUser;
        $this->requestResponder = $requestResponder;
        $this->validResponder = $validResponder;
    }

    public function __invoke(Request $request){
        $valid = validator($request->only('studentID','name','password'),[
            'studentID'=>'required|string|max:255',
            'name'=>'required|string|max:255',
            'password'=>'required|string|min:6',
            'group'=>'string'
        ]);

        if($valid->fails()){
            return $this->validResponder->response($valid);
        }


        $data = request()->only('studentID','name','password','group');

        $check = $this->createUser->create($data);

        return $this->requestResponder->response($check,"create" , "user");
    }

}