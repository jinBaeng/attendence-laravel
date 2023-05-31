<?php
namespace App\Attendence\Domains\Repositories;


interface ShowMyTodayAttendenceRepositoryInterface{
    public function show($user):object;
}