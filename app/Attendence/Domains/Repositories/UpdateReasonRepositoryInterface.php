<?php
namespace App\Attendence\Domains\Repositories;

interface UpdateReasonRepositoryInterface{
    public function update($request , $user):bool;
}