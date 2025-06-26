<div class="filament-hidden">

![Filament CEP Field](https://raw.githubusercontent.com/jeffersongoncalves/filament-cep-field/1.x/art/jeffersongoncalves-filament-cep-field.png)

</div>

# Filament CEP Field

[![Latest Version on Packagist](https://img.shields.io/packagist/v/jeffersongoncalves/filament-cep-field.svg?style=flat-square)](https://packagist.org/packages/jeffersongoncalves/filament-cep-field)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/jeffersongoncalves/filament-cep-field/fix-php-code-style-issues.yml?branch=1.x&label=code%20style&style=flat-square)](https://github.com/jeffersongoncalves/filament-cep-field/actions?query=workflow%3A"Fix+PHP+code+styling"+branch%3A1.x)
[![Total Downloads](https://img.shields.io/packagist/dt/jeffersongoncalves/filament-cep-field.svg?style=flat-square)](https://packagist.org/packages/jeffersongoncalves/filament-cep-field)

The Filament CEP Field is a custom input component designed specifically for Brazilian postal codes (CEP - Código de Endereçamento Postal). This component extends Filament's form capabilities by providing a specialized input field that handles CEP formatting, validation, and automatic address lookup.

### What it does:

- **CEP Formatting**: Automatically applies the standard Brazilian CEP mask (99999-999) as users type
- **Address Lookup**: Integrates with CEP APIs to automatically fetch and populate address information
- **Form Integration**: Seamlessly integrates with Filament forms and follows Filament's design patterns
- **Validation**: Provides built-in validation for CEP format and existence
- **Customization**: Offers extensive customization options for labels, error messages, and field mappings

This component is perfect for Brazilian applications that need to collect address information efficiently and accurately.

## Features

- 🚀 Multiple API providers (BrasilAPI, ViaCEP, AwesomeAPI)
- 💾 Automatic database caching with Laravel Model Caching
- 🔄 Automatic cache invalidation
- 🎯 CEP validation and formatting
- ⚡ Queue-based cache management
- 🇧🇷 Complete Brazilian states support

## Installation

You can install the package via composer:

```bash
composer require jeffersongoncalves/filament-cep-field
```

Publish and run the migration file:

```bash
php artisan vendor:publish --tag=cep-migrations
php artisan migrate
```

## Usage

Once installed, you can use the CepInput component in your Filament forms. The component automatically applies a CEP mask (99999-999), validates the input, and can automatically populate address fields when a valid CEP is found.

```php
use JeffersonGoncalves\Filament\CepField\Forms\Components\CepInput;

// Basic usage
CepInput::make('cep')
    ->required(),

// Advanced usage with all available options
CepInput::make('cep')
    ->required()
    ->setMode('suffix') // 'prefix' or 'suffix' (default: 'suffix')
    ->setActionLabel('Buscar CEP') // Custom search button label
    ->setActionLabelHidden(false) // Show/hide action label (default: false)
    ->setErrorMessage('CEP não encontrado.') // Custom error message
    ->setStreetField('street') // Field to populate with street name
    ->setNeighborhoodField('neighborhood') // Field to populate with neighborhood
    ->setCityField('city') // Field to populate with city name
    ->setStateField('state'), // Field to populate with state
```

### Available Methods

#### `setMode(string $mode)`

Sets the position of the search action button.
- `'suffix'` (default): Places the button after the input field
- `'prefix'`: Places the button before the input field

#### `setActionLabel(string $label)`

Customizes the label text for the search action button.
- Default: `'Buscar CEP'`

#### `setActionLabelHidden(bool $hidden)`

Controls whether the action button label is visible.
- `true`: Shows only the magnifying glass icon
- `false` (default): Shows both icon and label

#### `setErrorMessage(string $message)`

Sets a custom error message when CEP lookup fails.
- Default: `'CEP inválido.'`

#### Field Mapping Methods

These methods allow you to specify which form fields should be automatically populated with the address information:

- `setStreetField(string $fieldName)` - Default: `'street'`
- `setNeighborhoodField(string $fieldName)` - Default: `'neighborhood'`
- `setCityField(string $fieldName)` - Default: `'city'`
- `setStateField(string $fieldName)` - Default: `'state'`

### Features

- **Automatic Masking**: Applies the Brazilian CEP format (99999-999)
- **Real-time Validation**: Validates CEP format and existence
- **Automatic Address Population**: Fills related address fields when a valid CEP is found
- **Customizable Search Button**: Can be positioned as prefix or suffix with custom labels
- **Error Handling**: Provides validation errors for invalid CEPs

### Usage Examples

#### Simple CEP Input

```php
CepInput::make('postal_code')
    ->label('CEP')
    ->required()
```

#### CEP with Custom Field Mapping

```php
CepInput::make('cep')
    ->label('CEP')
    ->required()
    ->setStreetField('endereco')
    ->setNeighborhoodField('bairro')
    ->setCityField('cidade')
    ->setStateField('estado')
```

#### CEP with Prefix Button and Custom Labels

```php
CepInput::make('cep')
    ->label('Código Postal')
    ->setMode('prefix')
    ->setActionLabel('Consultar')
    ->setActionLabelHidden(false)
    ->setErrorMessage('CEP não encontrado ou inválido.')
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Jèfferson Gonçalves](https://github.com/jeffersongoncalves)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
