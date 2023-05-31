<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\User\Domain\Repositories\CreateUserRepository;
use App\User\Domain\Repositories\CreateUserRepositoryInterface;
use App\User\Domain\Repositories\CheckDuplicateEmailRepositoryInterface;
use App\User\Domain\Repositories\CheckDuplicateEmailRepository;
use App\User\Domain\Repositories\MyinfoRepositoryInterface;
use App\User\Domain\Repositories\MyinfoRepository;
use App\User\Domain\Repositories\ShowGroupAttendenceRepositoryInterface;
use App\User\Domain\Repositories\ShowGroupAttendenceRepository;


class UserServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind(CreateUserRepositoryInterface::class , CreateUserRepository::class);
        $this->app->bind(CheckDuplicateEmailRepositoryInterface::class, CheckDuplicateEmailRepository::class);
        $this->app->bind(MyinfoRepositoryInterface::class, MyinfoRepository::class);
        $this->app->bind(ShowGroupAttendenceRepositoryInterface::class , ShowGroupAttendenceRepository::class);

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

