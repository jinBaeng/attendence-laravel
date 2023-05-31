<?php
namespace App\Attendence\Domains\Repositories;
// use App\Attendence\Domain\Entities\Attendence;


interface ShowAllAttendencesRepositoryInterface{
    public function show($page):array;
}