<?php
namespace App\Penalty\Domains\Repositories;



interface ShowAllPenaltyRepositoryInterface{
    public function show($user):object;
}