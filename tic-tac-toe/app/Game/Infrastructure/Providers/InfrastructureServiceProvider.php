<?php

namespace App\Game\Infrastructure\Providers;

use App\Game\Domain\Repositories\GameRepositoryInterface;
use App\Game\Infrastructure\Repositories\GameRepository;
use Illuminate\Support\ServiceProvider;

class InfrastructureServiceProvider extends ServiceProvider
{
    /**
     * Bind the interface to an implementation repository class
     */
    public function register()
    {
        $this->app->bind(
            GameRepositoryInterface::class,
            GameRepository::class
        );
    }
}
