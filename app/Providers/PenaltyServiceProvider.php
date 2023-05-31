<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Penalty\Domains\Repositories\DeletePenaltyRepositoryInterface;
use App\Penalty\Domains\Repositories\DeletePenaltyRepository;
use App\Penalty\Domains\Repositories\ShowLeftPenaltyRepositoryInterface;
use App\Penalty\Domains\Repositories\ShowLeftPenaltyRepository;
use App\Penalty\Domains\Repositories\ShowAllPenaltyRepositoryInterface;
use App\Penalty\Domains\Repositories\ShowAllPenaltyRepository;
use App\Penalty\Domains\Repositories\UpdatePenaltyImgRepositoryInterface;
use App\Penalty\Domains\Repositories\UpdatePenaltyImgRepository;
use App\Penalty\Domains\Repositories\ShowLeftAllPenaltyRepositoryInterface;
use App\Penalty\Domains\Repositories\ShowLeftAllPenaltyRepository;
use App\Penalty\Domains\Repositories\ShowPenaltyImgRepositoryInterface;
use App\Penalty\Domains\Repositories\ShowPenaltyImgRepository;
use App\Penalty\Domains\Repositories\ShowPenaltyClearImgRepositoryInterface;
use App\Penalty\Domains\Repositories\ShowPenaltyClearImgRepository;

class PenaltyServiceProvider extends ServiceProvider{
    public function register()
    {
        //
        $this->app->bind(DeletePenaltyRepositoryInterface::class , DeletePenaltyRepository::class);
        $this->app->bind(ShowLeftPenaltyRepositoryInterface::class , ShowLeftPenaltyRepository::class);
        $this->app->bind(ShowAllPenaltyRepositoryInterface::class , ShowAllPenaltyRepository::class);
        $this->app->bind(UpdatePenaltyImgRepositoryInterface::class , UpdatePenaltyImgRepository::class);
        $this->app->bind(ShowLeftAllPenaltyRepositoryInterface::class , ShowLeftAllPenaltyRepository::class);
        $this->app->bind(ShowPenaltyImgRepositoryInterface::class , ShowPenaltyImgRepository::class);
        $this->app->bind(ShowPenaltyClearImgRepositoryInterface::class , ShowPenaltyClearImgRepository::class);

    }
}