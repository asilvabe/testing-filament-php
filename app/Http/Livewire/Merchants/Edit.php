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
            'documentTypeId' => $this->merchant->document_type_id,
            'document' => $this->merchant->document,
            'websiteUrl' => $this->merchant->website_url,
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

    public function submit(): void
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
