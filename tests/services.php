<?php

namespace tests\Meals;

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return function(ContainerConfigurator $configurator) {

    $services = $configurator->services()
        ->defaults()
        ->public()
        ->autowire()
        ->autoconfigure()
    ;

    $services->load('Meals\\Application\\', '../src/Application/*');
    $services->load('Meals\\Domain\\Provider\\', '../src/Domain/Provider');
    $services->load('Meals\\Domain\\Service\\', '../src/Domain/Service');

    $services->load('tests\\Meals\\Functional\\Fake\\', '../tests/Functional/Fake/*');
};
