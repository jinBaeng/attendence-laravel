<?php
namespace App\Penalty\Domains\Repositories;



interface ShowLeftPenaltyRepositoryInterface{
    public function show($user):object;
}