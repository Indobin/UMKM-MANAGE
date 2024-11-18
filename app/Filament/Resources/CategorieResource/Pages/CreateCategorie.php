<?php

namespace App\Filament\Resources\CategorieResource\Pages;

use App\Filament\Resources\CategorieResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCategorie extends CreateRecord
{
    protected static string $resource = CategorieResource::class;
    protected static ?string $title = 'Tambah Kategori';
    public function afterSave()
    {
        $this->redirect(static::getResource()::getUrl('index'));
    }
}
