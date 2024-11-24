<?php

namespace App\Filament\Resources\TransactionProductResource\Pages;

// use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\TransactionProductResource;

class CreateTransactionProduct extends CreateRecord
{
    protected static string $resource = TransactionProductResource::class;
    protected function getFormActions(): array
    {
        return [
            Action::make('create')
                ->label('Selanjutnya')
                ->submit('create')
                ->keyBindings(['mode+s']),
        ];
    }
    protected function getRedirectUrl(): string
    {
        $id = $this->record->id;
        return route(
        'filament.dashboard.resources.transaction-product-details.create',
        [
            'transaction_id' => $id
        ]);
    
    }
}

