<?php
namespace App\Penalty\Domains\Repositories;

interface DeletePenaltyRepositoryInterface{
    public function delete($request):bool;
}