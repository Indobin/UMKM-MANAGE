<?php

namespace App\Filament\Resources\ReceinvableResource\Pages;

use App\Filament\Resources\ReceinvableResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListReceinvables extends ListRecords
{
    protected static string $resource = ReceinvableResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah'),
        ];
    }
}
