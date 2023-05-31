<?php
namespace App\Attendence\Domains\Repositories;

interface UpdateAttendenceRepositoryInterface{
    public function update($request , $user):bool;
}