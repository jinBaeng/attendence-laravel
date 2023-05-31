<?php
namespace App\Penalty\Domains\Repositories;



interface UpdatePenaltyImgRepositoryInterface{
    public function update($request , $user , $image):bool;
}