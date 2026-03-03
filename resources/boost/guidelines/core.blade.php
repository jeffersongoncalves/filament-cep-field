## Filament CEP Field

A Filament form field for Brazilian postal codes (CEP) with automatic mask formatting (99999-999), address lookup via external APIs (BrasilAPI, ViaCEP, AwesomeAPI), database caching, and auto-population of address fields. Requires Filament 5.0+ and PHP 8.2+.

### Installation

@verbatim
<code-snippet name="Install the plugin" lang="bash">
composer require jeffersongoncalves/filament-cep-field
</code-snippet>
@endverbatim

### Publish & Run Migrations

@verbatim
<code-snippet name="Publish and run CEP cache migrations" lang="bash">
php artisan vendor:publish --tag=cep-migrations
php artisan migrate
</code-snippet>
@endverbatim

### Basic Usage

@verbatim
<code-snippet name="Use CepInput in a form" lang="php">
use JeffersonGoncalves\Filament\CepField\Forms\Components\CepInput;

CepInput::make('cep')
    ->required()
    ->setStreetField('street')
    ->setNeighborhoodField('neighborhood')
    ->setCityField('city')
    ->setStateField('state');
</code-snippet>
@endverbatim

### Advanced Usage

@verbatim
<code-snippet name="CepInput with all options" lang="php">
use JeffersonGoncalves\Filament\CepField\Forms\Components\CepInput;

CepInput::make('cep')
    ->required()
    ->setMode('suffix')
    ->setActionLabel('Buscar CEP')
    ->setActionLabelHidden(false)
    ->setErrorMessage('CEP nao encontrado.')
    ->setStreetField('street')
    ->setNeighborhoodField('neighborhood')
    ->setCityField('city')
    ->setStateField('state');
</code-snippet>
@endverbatim

### Key Methods

- `setMode(string $mode)` - Button position: `'suffix'` (default) or `'prefix'`
- `setActionLabel(string $label)` - Custom search button label (default: `'Buscar CEP'`)
- `setActionLabelHidden(bool $hidden)` - Show/hide action label (default: `false`)
- `setErrorMessage(string $message)` - Custom error message (default: `'CEP invalido.'`)
- `setStreetField(string $field)` - Field to populate with street name (default: `'street'`)
- `setNeighborhoodField(string $field)` - Field to populate with neighborhood (default: `'neighborhood'`)
- `setCityField(string $field)` - Field to populate with city name (default: `'city'`)
- `setStateField(string $field)` - Field to populate with state (default: `'state'`)

### Architecture

- **Namespace**: `JeffersonGoncalves\Filament\CepField`
- **Component**: `CepInput` extends Filament form field
- **Service Provider**: `CepFieldServiceProvider` (auto-discovered)
- **Depends on**: `jeffersongoncalves/laravel-cep` for API and caching logic

### Best Practices

- Always publish and run the migrations for database-backed CEP caching
- Map field names to match your form schema (e.g., `setStreetField('endereco')` for Portuguese field names)
- The component auto-applies the Brazilian CEP mask (99999-999) -- no extra mask package needed
- Configure SSL certificates (`cacert.pem`) if you encounter HTTPS errors on Windows environments
