<?php
namespace App\Attendence\Domains\Repositories;


interface ShowMyAttendecneRateRepositoryInterface{
    public function show($user):object;
}