---
name: cep-field-development
description: Build and work with the Filament CEP Field plugin, including Brazilian postal code input, automatic address lookup, field mapping, API providers, and database caching.
---

# CEP Field Development

## When to use this skill

Use this skill when:
- Adding a Brazilian CEP postal code field to a Filament form
- Auto-populating address fields (street, neighborhood, city, state) from a CEP lookup
- Configuring CEP API providers (BrasilAPI, ViaCEP, AwesomeAPI)
- Customizing the search button position, label, and error messages
- Troubleshooting SSL certificate issues or API connection errors

## Architecture

### Namespace
```
JeffersonGoncalves\Filament\CepField
```

### Key Classes

| Class | Path | Description |
|-------|------|-------------|
| `CepInput` | `src/Forms/Components/CepInput.php` | Main form field component with CEP mask, validation, and address lookup |
| `CepFieldServiceProvider` | `src/CepFieldServiceProvider.php` | Service provider that registers views and config |

### Dependencies
- `filament/filament: ^5.0`
- `jeffersongoncalves/laravel-cep: ^1.0` (API providers, caching, model)
- `spatie/laravel-package-tools: ^1.14.0`

## Configuration

### Installation

```bash
composer require jeffersongoncalves/filament-cep-field
```

### Migrations

Publish and run the migration for CEP database caching:

```bash
php artisan vendor:publish --tag=cep-migrations
php artisan migrate
```

## Features

### Basic CEP Input

```php
use JeffersonGoncalves\Filament\CepField\Forms\Components\CepInput;

CepInput::make('postal_code')
    ->label('CEP')
    ->required();
```

### CEP with Address Auto-Population

Map form fields to be auto-filled when a valid CEP is found:

```php
CepInput::make('cep')
    ->label('CEP')
    ->required()
    ->setStreetField('street')
    ->setNeighborhoodField('neighborhood')
    ->setCityField('city')
    ->setStateField('state');
```

### Custom Portuguese Field Names

```php
CepInput::make('cep')
    ->label('CEP')
    ->required()
    ->setStreetField('endereco')
    ->setNeighborhoodField('bairro')
    ->setCityField('cidade')
    ->setStateField('estado');
```

### Search Button Customization

#### Button Position

```php
// Suffix (default) - button after input
CepInput::make('cep')
    ->setMode('suffix');

// Prefix - button before input
CepInput::make('cep')
    ->setMode('prefix');
```

#### Button Label

```php
CepInput::make('cep')
    ->setActionLabel('Consultar')       // Custom label text
    ->setActionLabelHidden(false);      // Show label (false = visible)

// Icon-only button (hide label)
CepInput::make('cep')
    ->setActionLabelHidden(true);
```

### Custom Error Message

```php
CepInput::make('cep')
    ->setErrorMessage('CEP nao encontrado ou invalido.');
```

### Full Configuration Example

```php
CepInput::make('cep')
    ->label('Codigo Postal')
    ->required()
    ->setMode('prefix')
    ->setActionLabel('Consultar')
    ->setActionLabelHidden(false)
    ->setErrorMessage('CEP nao encontrado ou invalido.')
    ->setStreetField('endereco')
    ->setNeighborhoodField('bairro')
    ->setCityField('cidade')
    ->setStateField('estado');
```

## Default Field Mapping

| Method | Default Value |
|--------|---------------|
| `setStreetField()` | `'street'` |
| `setNeighborhoodField()` | `'neighborhood'` |
| `setCityField()` | `'city'` |
| `setStateField()` | `'state'` |

## API Providers

The underlying `jeffersongoncalves/laravel-cep` package supports multiple API providers:
- **BrasilAPI** (`brasilapi.com.br`)
- **ViaCEP** (`viacep.com.br`)
- **AwesomeAPI** (`awesomeapi.com.br`)

All providers are tried in sequence with automatic fallback.

## Caching

- CEP lookup results are cached in the database using a Laravel Model
- Cache is automatically invalidated when data changes
- Queue-based cache management available for background updates

## Troubleshooting

### SSL Certificate Errors
**Cause**: PHP cannot verify HTTPS connections to CEP APIs (common on Windows).
**Solution**: Download `cacert.pem` from `https://curl.se/ca/cacert.pem` and configure `php.ini`:
```ini
openssl.cafile = "C:\php\extras\ssl\cacert.pem"
curl.cainfo = "C:\php\extras\ssl\cacert.pem"
```
Restart the web server after changes.

### CEP Not Found
**Cause**: Invalid CEP or all API providers failing.
**Solution**: Verify the CEP is valid (8 digits). Check network connectivity to BrasilAPI, ViaCEP, and AwesomeAPI endpoints.

### Address Fields Not Populating
**Cause**: Field name mismatch between `CepInput` mapping and the form schema.
**Solution**: Ensure the field names passed to `setStreetField()`, `setNeighborhoodField()`, `setCityField()`, and `setStateField()` exactly match the `TextInput::make()` names in your form schema.

### Migration Not Found
**Cause**: Migrations not published.
**Solution**: Run `php artisan vendor:publish --tag=cep-migrations` then `php artisan migrate`.
