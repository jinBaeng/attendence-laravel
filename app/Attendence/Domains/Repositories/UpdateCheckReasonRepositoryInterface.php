<?php
namespace App\Attendence\Domains\Repositories;

interface UpdateCheckReasonRepositoryInterface{
    public function update($accept ):bool;
}