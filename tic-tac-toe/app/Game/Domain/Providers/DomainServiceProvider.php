<?php

namespace App\Game\Domain\Providers;

use App\Game\Domain\Services\GameService;
use App\Game\Domain\Services\GameServiceInterface;
use Illuminate\Support\ServiceProvider;

class DomainServiceProvider extends ServiceProvider
{
    /**
     * Bind the interface to an implementation repository class
     */
    public function register()
    {
        $this->app->bind(
            GameServiceInterface::class,
            GameService::class
        );
    }
}
