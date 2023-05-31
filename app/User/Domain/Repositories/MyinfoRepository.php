<?php
namespace App\User\Domain\Repositories;

use Illuminate\Http\Request;
use App\User\Domain\Entities\User;
use Illuminate\Support\Facades\Auth;


class MyinfoRepository implements MyinfoRepositoryInterface{
    public function show():object{
        if(Auth::user()==true){
            $user = User::where('studentID',Auth::user()->email)
                    ->get(['name','email','group']);
            return $user;
        }else{
            return NULL;
        }
    }
}