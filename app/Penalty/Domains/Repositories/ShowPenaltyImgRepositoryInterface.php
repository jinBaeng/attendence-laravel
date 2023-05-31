<?php
namespace App\Penalty\Domains\Repositories;



interface ShowPenaltyImgRepositoryInterface{
    public function show($user):object;
}