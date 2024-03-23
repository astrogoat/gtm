<?php

namespace Astrogoat\Gtm;

use Astrogoat\Gtm\Settings\GtmSettings;
use Helix\Lego\Apps\App;
use Helix\Lego\Apps\Services\IncludeFrontendViews;
use Helix\Lego\LegoManager;
use Helix\Lego\Providers\RouteServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Event;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Stancl\Tenancy\Events\TenancyBootstrapped;

class GtmServiceProvider extends PackageServiceProvider
{
    public function registerApp(App $app)
    {
        return $app
            ->name('gtm')
            ->settings(GtmSettings::class)
            ->migrations([
                __DIR__ . '/../database/migrations',
                __DIR__ . '/../database/migrations/settings',
            ])->includeFrontendViews(function (IncludeFrontendViews $views) {
                return $views
                    ->addToHead(['gtm::header-script'])
                    ->addToEnd(['gtm::body-script']);
            });
    }

    public function bootingPackage()
    {
        $this->app['view']->creator([
            'gtm::header-script',
            'gtm::body-script'
        ], ScriptViewCreator::class);

        resolve(Router::class)->pushMiddlewareToGroup(RouteServiceProvider::MIDDLEWARE_GROUP_FRONTEND, GoogleTagManagerMiddleware::class);
    }

    public function registeringPackage()
    {
        $this->callAfterResolving('lego', function (LegoManager $lego) {
            $lego->registerApp(fn (App $app) => $this->registerApp($app));
        });

        Event::listen(TenancyBootstrapped::class, function () {
            $this->app->singleton(GoogleTagManager::class, function () {
                return new GoogleTagManager(settings(GtmSettings::class, 'container_id'));
            });

            $this->app->alias(GoogleTagManager::class, 'googletagmanager');
        });
    }

    public function configurePackage(Package $package): void
    {
        $package->name('gtm')->hasViews()->hasConfigFile();
    }
}
