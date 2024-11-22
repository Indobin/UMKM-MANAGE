<?php

namespace App\Filament\Resources\TransactionProductResource\Pages;

use App\Filament\Resources\TransactionProductResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTransactionProduct extends EditRecord
{
    protected static string $resource = TransactionProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
