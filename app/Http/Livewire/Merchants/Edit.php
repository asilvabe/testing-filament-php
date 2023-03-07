<?php

namespace App\Http\Livewire\Merchants;

use App\Models\Country;
use App\Models\Merchant;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class Edit extends Component implements HasForms
{
    use InteractsWithForms;

    public Merchant $merchant;

    public function mount(): void
    {
        $this->form->fill([
            'name' => $this->merchant->name,
            'brand' => $this->merchant->brand,
            'country_id' => $this->merchant->country_id,
            'document_type_id' => $this->merchant->document_type_id,
            'document' => $this->merchant->document,
            'website_url' => $this->merchant->website_url,
            'size' => $this->merchant->size,
            'increment_type' => $this->merchant->increment_type,
            'disabled_at' => $this->merchant->disabled_at,
        ]);
    }

    public function render()
    {
        return view('livewire.merchants.edit');
    }

    protected function getFormModel(): Merchant
    {
        return $this->merchant;
    }

    public function update(): void
    {
        $this->merchant->update(
            $this->form->getState(),
        );

        Notification::make()
            ->title('Updated!')
            ->success()
            ->send();
    }

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('name')
                ->required(),

            TextInput::make('brand'),

            Select::make('country_id')
                ->label('Country')
                ->relationship('country', 'name')
                ->reactive()
                ->afterStateUpdated(fn (callable $set) => $set('document_type_id', null)),

            Select::make('document_type_id')
                ->label('Document type')
                ->placeholder(function (callable $get) {
                    $country = Country::find($get('country_id'));

                    return isset($country) ? 'Select an option' : 'Select a country';
                })
                ->relationship('documentType', 'name')
                ->options(function (callable $get) {
                    $country = Country::find($get('country_id'));

                    return isset($country) ? $country->documentTypes->pluck('name', 'id') : [];
                })
                ->requiredWith('document'),

            TextInput::make('document')
                ->requiredWith('document_type_id'),

            TextInput::make('website_url'),

            Select::make('size')
                ->label('Size')
                ->options([
                    'MICRO' => 'Micro company (<10 employees)',
                    'SMALL' => 'Small company (<50 employees)',
                    'MEDIUM' => 'Medium company (<250 employees)',
                    'BIG' => 'Big company (>=250 employees)',
                ]),

            Select::make('increment_type')
                ->label('Increment type')
                ->options([
                    'SMLMV' => 'SMLMV',
                    'IPC' => 'IPC',
                ])
                ->required(),

            Toggle::make('disabled_at')
                ->label('Enabled')
                ->afterStateHydrated(fn (Toggle $component, $state) => $component->state(is_null($state)))
                ->dehydrateStateUsing(fn ($state) => $state ? null : now()),
        ];
    }

    protected function onValidationError(ValidationException $exception): void
    {
        Notification::make()
            ->title($exception->getMessage())
            ->danger()
            ->send();
    }
}
