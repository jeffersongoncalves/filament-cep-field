<?php

use JeffersonGoncalves\Filament\CepField\CepFieldServiceProvider;
use Spatie\LaravelPackageTools\Package;

it('can be instantiated', function () {
    $provider = new CepFieldServiceProvider(app());

    expect($provider)->toBeInstanceOf(CepFieldServiceProvider::class);
});

it('registers the package correctly', function () {
    $provider = new CepFieldServiceProvider(app());

    // Test that the service provider has the configurePackage method
    $reflection = new ReflectionClass($provider);
    $method = $reflection->getMethod('configurePackage');

    expect($method)->toBeInstanceOf(ReflectionMethod::class);
    expect($method->getName())->toBe('configurePackage');
});

it('has correct package name', function () {
    $provider = new CepFieldServiceProvider(app());

    // Create a new package instance and configure it
    $package = new Package;
    $provider->configurePackage($package);

    expect($package->name)->toBe('filament-cep-field');
});
