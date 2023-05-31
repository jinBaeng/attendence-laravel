<?php
namespace App\User\Domain\Repositories;


interface ShowGroupAttendenceRepositoryInterface{
    public function show($user):object;
}