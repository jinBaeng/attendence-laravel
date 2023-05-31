<?php
namespace App\Attendence\Domains\Repositories;

interface CheckAttendenceUserRepositoryInterface{
    public function check($user ,$id):bool;
}