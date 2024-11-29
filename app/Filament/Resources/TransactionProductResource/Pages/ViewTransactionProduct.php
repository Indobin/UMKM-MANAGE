<?php

namespace App\Filament\Resources\TransactionProductResource\Pages;
use Filament\Pages\Actions\ButtonAction;
use App\Filament\Resources\TransactionProductResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewTransactionProduct extends ViewRecord
{
    protected static string $resource = TransactionProductResource::class;

    public function getActions(): array
    {
        return [
            ButtonAction::make('show_modal')
                ->label('Lihat Detail Transaksi')
                ->color('primary')
                ->icon('heroicon-o-eye')
                ->action('openModal')
        ];
    }

    // Action untuk membuka modal
    public function openModal()
    {
        $this->emit('openModal'); // Emit event untuk membuka modal
    }



    protected function getViewData(): array
    {
        return [
            'record' => $this->getRecord(),
        ];
    }

    protected static string $view = 'filament.transaction-product-detail';

}
