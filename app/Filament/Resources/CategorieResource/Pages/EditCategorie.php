<?php

namespace App\Filament\Resources\CategorieResource\Pages;

use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\CategorieResource;

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
    public function afterSave()
    {
        $this->redirect(static::getResource()::getUrl('index'));
    }
}
