<?php

namespace App\Filament\Resources\TransactionResource\Pages;

use App\Filament\Resources\TransactionResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTransaction extends CreateRecord
{
    protected static string $resource = TransactionResource::class;
    protected static ?string $title = 'Tambah Transaksi';
    public function afterSave()
    {
        $this->redirect(static::getResource()::getUrl('index'));
    }
}
