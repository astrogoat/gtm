<?php

namespace Astrogoat\Gtm;

use Astrogoat\Gtm\Settings\GtmSettings;
use Helix\Lego\Apps\App;
use Helix\Lego\LegoManager;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

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
            ]);
    }

    public function bootingPackage()
    {
        $this->app['view']->creator(
            ['gtm::header-script', 'gtm::body-script'],
            ScriptViewCreator::class
        );
    }

    public function registeringPackage()
    {
        $this->callAfterResolving('lego', function (LegoManager $lego) {
            $lego->registerApp(fn (App $app) => $this->registerApp($app));
        });

        $this->app->singleton(GoogleTagManager::class, function () {
            return new GoogleTagManager(settings(GtmSettings::class, 'container_id'));
        });

        $this->app->alias(GoogleTagManager::class, 'googletagmanager');
    }

    public function configurePackage(Package $package): void
    {
        $package->name('gtm')->hasViews()->hasConfigFile();
    }
}
