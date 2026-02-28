<?php

namespace JeffersonGoncalves\Filament\CepField\Forms\Components;

use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Set;
use Illuminate\Validation\ValidationException;
use JeffersonGoncalves\Cep\Models\Cep;
use Livewire\Component as Livewire;

class CepInput extends TextInput
{
    private string $mode = 'suffix';

    private string $errorMessage = 'CEP inválido.';

    private string $actionLabel = 'Buscar CEP';

    private bool $actionLabelHidden = false;

    private string $streetField = 'street';

    private string $neighborhoodField = 'neighborhood';

    private string $cityField = 'city';

    private string $stateField = 'state';

    public function setMode(string $mode): static
    {
        $this->mode = $mode;

        return $this;
    }

    public function setErrorMessage(string $errorMessage): static
    {
        $this->errorMessage = $errorMessage;

        return $this;
    }

    public function setActionLabel(string $actionLabel): static
    {
        $this->actionLabel = $actionLabel;

        return $this;
    }

    public function setActionLabelHidden(bool $actionLabelHidden): static
    {
        $this->actionLabelHidden = $actionLabelHidden;

        return $this;
    }

    public function setStreetField(string $streetField): static
    {
        $this->streetField = $streetField;

        return $this;
    }

    public function setNeighborhoodField(string $neighborhoodField): static
    {
        $this->neighborhoodField = $neighborhoodField;

        return $this;
    }

    public function setCityField(string $cityField): static
    {
        $this->cityField = $cityField;

        return $this;
    }

    public function setStateField(string $stateField): static
    {
        $this->stateField = $stateField;

        return $this;
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->mask('99999-999');
        $this->minLength(9);
        $this->afterStateUpdated(function ($state, Livewire $livewire, Set $set) {
            $this->findByCep($state, $livewire, $set);
        });
        $this->suffixAction(function () {
            if ($this->mode === 'suffix') {
                return $this->makeCepAction();
            }

            return null;
        });
        $this->prefixAction(function () {
            if ($this->mode === 'prefix') {
                return $this->makeCepAction();
            }

            return null;
        });
    }

    private function makeCepAction(): Action
    {
        $action = Action::make('search-action-'.$this->getKey())
            ->label($this->actionLabel)
            ->icon('heroicon-o-magnifying-glass')
            ->action(function ($state, Livewire $livewire, Set $set) {
                $this->findByCep($state, $livewire, $set);
            })
            ->cancelParentActions();

        if (! $this->actionLabelHidden) {
            $action->button();
        }

        return $action;
    }

    private function findByCep($state, Livewire $livewire, Set $set): void
    {
        $livewire->validateOnly($this->getStatePath());
        $cep = Cep::findByCep($state);
        if (blank($cep['cep'])) {
            throw ValidationException::withMessages([
                $this->getStatePath() => $this->errorMessage,
            ]);
        }
        $set($this->streetField, $cep['street']);
        $set($this->neighborhoodField, $cep['neighborhood']);
        $set($this->cityField, $cep['city']);
        $set($this->stateField, $cep['state']);
    }
}
