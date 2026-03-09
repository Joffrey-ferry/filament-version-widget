<?php

namespace Neoxiel\FilamentVersionWidget;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class VersionWidgetServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('filament-version-widget')
            ->hasViews('filament-version-widget'); // Le préfixe pour appeler la vue
    }
}