<?php

namespace App\User\Domain\Repositories;

use App\User\Domain\Entities\User;

class CreateUserRepository implements CreateUserRepositoryInterface{
    public function create( $data ):bool{
        if(User::where('studentID',$data['studentID'])->exists()){
            return false;
        }else{
            $user = User::create([
                'name' =>$data['name'],
                'studentID' =>$data['studentID'],
                'password' =>bcrypt($data['password']),
                'group' =>$data['group']
            ]);
            return true;
        }

    }
}