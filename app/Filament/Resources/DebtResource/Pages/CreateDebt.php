<?php

namespace App\Filament\Resources\DebtResource\Pages;

use App\Filament\Resources\DebtResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDebt extends CreateRecord
{
    protected static string $resource = DebtResource::class;
    protected static ?string $title = 'Tambah Hutang';
    public function afterSave()
    {
        $this->redirect(static::getResource()::getUrl('index'));
    }
}
