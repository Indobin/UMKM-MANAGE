<?php

namespace App\Filament\Resources\CategorieResource\Pages;

use App\Filament\Resources\CategorieResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCategorie extends EditRecord
{
    protected static string $resource = CategorieResource::class;
    protected static ?string $title = 'Edit Kategori';

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()->label('Hapus'),
        ];
    }
}
