<?php

namespace App\Filament\Resources\TransactionProductResource\Pages;

use App\Filament\Resources\TransactionProductResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTransactionProducts extends ListRecords
{
    protected static string $resource = TransactionProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
