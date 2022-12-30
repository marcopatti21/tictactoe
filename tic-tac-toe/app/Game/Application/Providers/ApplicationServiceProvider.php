<?php
/**
 * Created by PhpStorm.
 * User: David
 * Date: 29/01/2019
 * Time: 16:26
 */

namespace App\Game\Application\Providers;

use App\Game\Application\Services\GameApplicationService;
use App\Game\Application\Services\GameApplicationServiceInterface;
use Illuminate\Support\ServiceProvider;

class ApplicationServiceProvider extends ServiceProvider
{
    /**
     * Bind the interface to an implementation repository class
     */
    public function register()
    {
        $this->app->bind(
            GameApplicationServiceInterface::class,
            GameApplicationService::class
        );
    }
}
