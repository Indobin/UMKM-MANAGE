<?php

namespace App\Filament\Resources\ReceinvableResource\Pages;

use App\Filament\Resources\ReceinvableResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditReceinvable extends EditRecord
{
    protected static string $resource = ReceinvableResource::class;

    protected static ?string $title = 'Edit Piutang';
    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()->label('Hapus'),
        ];
    }
}
