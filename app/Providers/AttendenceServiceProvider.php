<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Attendence\Domains\Repositories\ShowAllAttendencesRepositoryInterface;
use App\Attendence\Domains\Repositories\ShowAllAttendencesRepository;
use App\Attendence\Domains\Repositories\ShowTodayAttendencesRepositoryInterface;
use App\Attendence\Domains\Repositories\ShowTodayAttendencesRepository;
use App\Attendence\Domains\Repositories\UpdateCheckReasonRepositoryInterface;
use App\Attendence\Domains\Repositories\UpdateCheckReasonRepository;
use App\Attendence\Domains\Repositories\ShowMyAttendecneRateRepositoryInterface;
use App\Attendence\Domains\Repositories\ShowMyAttendecneRateRepository;
use App\Attendence\Domains\Repositories\ShowMyTodayAttendenceRepositoryInterface;
use App\Attendence\Domains\Repositories\ShowMyTodayAttendenceRepository;
use App\Attendence\Domains\Repositories\UpdateAttendenceRepositoryInterface;
use App\Attendence\Domains\Repositories\UpdateAttendenceRepository;
use App\Attendence\Domains\Repositories\UpdateReasonRepositoryInterface;
use App\Attendence\Domains\Repositories\UpdateReasonRepository;
use App\Attendence\Domains\Repositories\ShowRankingRepositoryInterface;
use App\Attendence\Domains\Repositories\ShowRankingRepository;
use App\Attendence\Domains\Repositories\CheckAttendenceUserRepository;
use App\Attendence\Domains\Repositories\CheckAttendenceUserRepositoryInterface;


class AttendenceServiceProvider extends ServiceProvider{
    public function register()
    {
        //
        $this->app->bind(ShowAllAttendencesRepositoryInterface::class , ShowAllAttendencesRepository::class);
        $this->app->bind(ShowTodayAttendencesRepositoryInterface::class , ShowTodayAttendencesRepository::class);
        $this->app->bind(UpdateCheckReasonRepositoryInterface::class , UpdateCheckReasonRepository::class);
        $this->app->bind(ShowMyAttendecneRateRepositoryInterface::class , ShowMyAttendecneRateRepository::class);
        $this->app->bind(ShowMyTodayAttendenceRepositoryInterface::class , ShowMyTodayAttendenceRepository::class);
        $this->app->bind(UpdateAttendenceRepositoryInterface::class , UpdateAttendenceRepository::class);
        $this->app->bind(UpdateReasonRepositoryInterface::class , UpdateReasonRepository::class);
        $this->app->bind(ShowRankingRepositoryInterface::class , ShowRankingRepository::class);
        $this->app->bind(CheckAttendenceUserRepositoryInterface::class , CheckAttendenceUserRepository::class);




    }
}