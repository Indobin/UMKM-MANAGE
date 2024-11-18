<?php

namespace App\Filament\Resources\ReceinvableResource\Pages;

use App\Filament\Resources\ReceinvableResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateReceinvable extends CreateRecord
{
    protected static string $resource = ReceinvableResource::class;
    
    protected static ?string $title = 'Tambah Piutang';
    public function afterSave()
    {
        $this->redirect(static::getResource()::getUrl('index'));
    }
}
