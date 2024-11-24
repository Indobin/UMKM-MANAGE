<?php

namespace App\Filament\Resources\TransactionProductDetailResource\Pages;

use App\Filament\Resources\TransactionProductDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTransactionProductDetails extends ListRecords
{
    protected static string $resource = TransactionProductDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
