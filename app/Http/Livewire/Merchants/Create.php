<?php

namespace App\Http\Livewire\Merchants;

use App\Models\Country;
use App\Models\DocumentType;
use App\Models\Merchant;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Illuminate\View\View;
use Livewire\Component;

class Create extends Component implements HasForms
{
    use InteractsWithForms;

    public function mount(): void
    {
        $this->form->fill();
    }

    public function render(): View
    {
        return view('livewire.merchants.create');
    }

    protected function getFormModel(): string
    {
        return Merchant::class;
    }

    public function submit(): void
    {
        Merchant::create($this->form->getState());

        Notification::make()
            ->title('Created!')
            ->success()
            ->send();
    }

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('name')->required(),
            TextInput::make('brand'),
            Select::make('countryId')
                ->label('Country')
                ->relationship('country', 'name')
                ->reactive()
                ->afterStateUpdated(fn (callable $set) => $set('documentTypeId', null)),
            Select::make('documentTypeId')
                ->label('Document type')
                ->relationship('documentType', 'name')
                ->options(function (callable $get) {
                    $country = Country::find($get('countryId'));

                    if (is_null($country)) {
                        return DocumentType::all()->pluck('name', 'id');
                    }

                    return $country->documentTypes->pluck('name', 'id');
                })
                ->requiredWith('document'),
            TextInput::make('document')->requiredWith('documentTypeId'),
            TextInput::make('websiteUrl'),
        ];
    }
}
