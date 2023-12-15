<?php

namespace App\Livewire;

use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Livewire\Component;

/**
 * @property-read Form $form
 */
class SelectComponent extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('main')
                    ->label('Main')
                    ->options(fn() => [1 => 'One', 2 => 'Two'])
                    ->searchable()
                    ->live(),
                Select::make('sub_main')
                    ->label('Sub Main')
                    ->disabled(fn(Get $get) => !$get('main'))
                    ->options(function (Get $get) {

                        if (!$main = $get('main')) {
                            return [];
                        }

                        $options = [
                            1 => [
                                1 => 'One-a',
                                2 => 'One-b'
                            ],
                            2 => [
                                3 => 'Two-a',
                                4 => 'Two-b',
                            ]
                        ];
                        return $options[$main];
                    })
                    ->searchable()
                    ->live(),
                Select::make('sub_sub_main')
                    ->label('Sub sub main')
                    ->disabled(fn(Get $get) => !$get('sub_main'))
                    ->options(function (Get $get) {

                        if (!$subMain = $get('sub_main')) {
                            return [];
                        }

                        $options = [
                            1 => [
                                1 => 'One-a-1',
                                2 => 'One-a-2'
                            ],
                            2 => [
                                3 => 'One-b-1',
                                4 => 'One-b-2',
                            ],
                            3 => [
                                5 => 'Two-c-1',
                                6 => 'Two-c-2',
                            ],
                            4 => [
                                7 => 'Two-d-1',
                                8 => 'Two-d-2',
                            ],
                        ];
                        return $options[$subMain];
                    })
                    ->searchable()
                    ->live()
            ])
            ->statePath('data');
    }

    public function render()
    {
        return view('livewire.create-advertisement');
    }
}
