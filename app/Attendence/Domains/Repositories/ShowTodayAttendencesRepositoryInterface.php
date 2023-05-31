<?php
namespace App\Attendence\Domains\Repositories;
// use App\Attendence\Domain\Entities\Attendence;


interface ShowTodayAttendencesRepositoryInterface{
    public function show($page):array;
}