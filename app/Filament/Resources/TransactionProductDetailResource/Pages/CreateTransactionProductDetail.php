<?php

namespace App\Filament\Resources\TransactionProductDetailResource\Pages;

use Filament\Actions;
use App\Models\Product;
// use Filament\Forms\Components\Actions\Action;
use Filament\Actions\Action;
use Illuminate\Support\Facades\DB;
use App\Models\TransactionProductDetail;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\TransactionProductDetailResource;
use App\Filament\Resources\TransactionProductDetailResource\Widgets\TransactionDetailWidget;

class CreateTransactionProductDetail extends CreateRecord
{
    protected static string $resource = TransactionProductDetailResource::class;
    protected function getFormActions(): array
    {
        return [
            Action::make('create')
                ->label('Tambah')
                ->submit('create')
                ->keyBindings(['mode+s']),
        ];

    }
    protected function getRedirectUrl(): string
    {
        $id = $this->record->transaction_id;
        return route(
        'filament.dashboard.resources.transaction-product-details.create',
        [
            'transaction_id' => $id
        ]);

    }
    public function getFooterWidgetsColumns(): int | array
    {
        return 1;
    }
    public function getFooterWidgets():array
    {
        return [
            TransactionDetailWidget::make([
                'record' => request('transaction_id')
            ]),
        ];
    }

    protected function beforeSave(): void
    {

    $product = Product::find($this->record->product_id);

    if ($product) {

        $stok = $product->stok;

        if (!is_numeric($stok)) {
            throw new \Exception('Stok harus berupa angka yang valid.');
        }

        if ($this->record->jumlah > $stok) {
            $this->notify('danger', 'Jumlah yang dimasukkan melebihi stok yang tersedia!');
            throw new \Exception('Jumlah tidak valid.');
        }

        $product->decrement('stok', $this->record->jumlah);
    }

    }





}
