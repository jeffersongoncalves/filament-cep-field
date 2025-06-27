<?php

use JeffersonGoncalves\Filament\CepField\Forms\Components\CepInput;

it('can be instantiated', function () {
    $cepInput = CepInput::make('cep');

    expect($cepInput)->toBeInstanceOf(CepInput::class);
});

it('can set mode', function () {
    $cepInput = CepInput::make('cep')->setMode('prefix');

    $reflection = new ReflectionClass($cepInput);
    $modeProperty = $reflection->getProperty('mode');
    $modeProperty->setAccessible(true);

    expect($modeProperty->getValue($cepInput))->toBe('prefix');
});

it('can set error message', function () {
    $customMessage = 'Custom CEP error message';
    $cepInput = CepInput::make('cep')->setErrorMessage($customMessage);

    $reflection = new ReflectionClass($cepInput);
    $errorMessageProperty = $reflection->getProperty('errorMessage');
    $errorMessageProperty->setAccessible(true);

    expect($errorMessageProperty->getValue($cepInput))->toBe($customMessage);
});

it('can set action label', function () {
    $customLabel = 'Search Address';
    $cepInput = CepInput::make('cep')->setActionLabel($customLabel);

    $reflection = new ReflectionClass($cepInput);
    $actionLabelProperty = $reflection->getProperty('actionLabel');
    $actionLabelProperty->setAccessible(true);

    expect($actionLabelProperty->getValue($cepInput))->toBe($customLabel);
});

it('can set action label hidden', function () {
    $cepInput = CepInput::make('cep')->setActionLabelHidden(true);

    $reflection = new ReflectionClass($cepInput);
    $actionLabelHiddenProperty = $reflection->getProperty('actionLabelHidden');
    $actionLabelHiddenProperty->setAccessible(true);

    expect($actionLabelHiddenProperty->getValue($cepInput))->toBe(true);
});

it('can set street field', function () {
    $customField = 'address_street';
    $cepInput = CepInput::make('cep')->setStreetField($customField);

    $reflection = new ReflectionClass($cepInput);
    $streetFieldProperty = $reflection->getProperty('streetField');
    $streetFieldProperty->setAccessible(true);

    expect($streetFieldProperty->getValue($cepInput))->toBe($customField);
});

it('can set neighborhood field', function () {
    $customField = 'address_neighborhood';
    $cepInput = CepInput::make('cep')->setNeighborhoodField($customField);

    $reflection = new ReflectionClass($cepInput);
    $neighborhoodFieldProperty = $reflection->getProperty('neighborhoodField');
    $neighborhoodFieldProperty->setAccessible(true);

    expect($neighborhoodFieldProperty->getValue($cepInput))->toBe($customField);
});

it('can set city field', function () {
    $customField = 'address_city';
    $cepInput = CepInput::make('cep')->setCityField($customField);

    $reflection = new ReflectionClass($cepInput);
    $cityFieldProperty = $reflection->getProperty('cityField');
    $cityFieldProperty->setAccessible(true);

    expect($cityFieldProperty->getValue($cepInput))->toBe($customField);
});

it('can set state field', function () {
    $customField = 'address_state';
    $cepInput = CepInput::make('cep')->setStateField($customField);

    $reflection = new ReflectionClass($cepInput);
    $stateFieldProperty = $reflection->getProperty('stateField');
    $stateFieldProperty->setAccessible(true);

    expect($stateFieldProperty->getValue($cepInput))->toBe($customField);
});

it('has default configuration values', function () {
    $cepInput = CepInput::make('cep');

    $reflection = new ReflectionClass($cepInput);

    $modeProperty = $reflection->getProperty('mode');
    $modeProperty->setAccessible(true);
    expect($modeProperty->getValue($cepInput))->toBe('suffix');

    $errorMessageProperty = $reflection->getProperty('errorMessage');
    $errorMessageProperty->setAccessible(true);
    expect($errorMessageProperty->getValue($cepInput))->toBe('CEP inválido.');

    $actionLabelProperty = $reflection->getProperty('actionLabel');
    $actionLabelProperty->setAccessible(true);
    expect($actionLabelProperty->getValue($cepInput))->toBe('Buscar CEP');

    $streetFieldProperty = $reflection->getProperty('streetField');
    $streetFieldProperty->setAccessible(true);
    expect($streetFieldProperty->getValue($cepInput))->toBe('street');
});

it('can chain configuration methods', function () {
    $cepInput = CepInput::make('cep')
        ->setMode('prefix')
        ->setErrorMessage('Custom error')
        ->setActionLabel('Custom label')
        ->setStreetField('custom_street')
        ->setNeighborhoodField('custom_neighborhood')
        ->setCityField('custom_city')
        ->setStateField('custom_state');

    expect($cepInput)->toBeInstanceOf(CepInput::class);
});
