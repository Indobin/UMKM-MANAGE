<?php

namespace App\Filament\Resources\TransactionProductDetailResource\Pages;

use Filament\Actions;
use App\Models\Product;
// use Filament\Forms\Components\Actions\Action;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\TransactionProductDetailResource;

class CreateTransactionProductDetail extends CreateRecord
{
    protected static string $resource = TransactionProductDetailResource::class;
    protected function getFormActions(): array
    {
        return [
            Action::make('create')
                ->label('Simpan')
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
    // protected function afterSave(): void
    // {
    //     // Ambil produk terkait
    //     $product = Product::find($this->record->product_id);

    //     if ($product) {
    //         // Periksa apakah stok cukup
    //         if ($product->stok < $this->record->jumlah) {
    //             throw new \Exception('Jumlah yang dimasukkan melebihi stok yang tersedia.');
    //         }

    //         // Kurangi stok produk
    //         $product->decrement('stok', $this->record->jumlah);
    //     }
    // }
    protected function beforeSave(): void
    {
      // Contoh validasi untuk memastikan 'stok' adalah angka sebelum melakukan operasi
$product = Product::find($this->record->product_id);

if ($product) {
    // Memastikan 'stok' adalah angka sebelum manipulasi
    $stok = $product->stok;

    if (!is_numeric($stok)) {
        throw new \Exception('Stok harus berupa angka yang valid.');
    }

    if ($this->record->jumlah > $stok) {
        $this->notify('danger', 'Jumlah yang dimasukkan melebihi stok yang tersedia!');
        throw new \Exception('Jumlah tidak valid.'); // Menghentikan proses penyimpanan
    }

    // Kurangi stok jika valid
    $product->decrement('stok', $this->record->jumlah);
}

    }

}
