<?php

namespace App\Filament\Resources\TransactionProductDetailResource\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\DB;
use Filament\Tables\Actions\Action;
use App\Models\TransactionProductDetail;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Redirect;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Tables\Columns\Summarizers\Summarizer;

class TransactionDetailWidget extends BaseWidget
{
    public $transactionId;
    public function mount($record)
    {
        $this->transactionId = $record;
    }
    public function table(Table $table): Table
    {
        return $table
            ->query(
                TransactionProductDetail::query()->where('transaction_id', $this->transactionId),
            )
            ->columns([
                Tables\Columns\TextColumn::make('product.nama')->label('Nama Produk'),
                Tables\Columns\TextColumn::make('jumlah')->label('Jumlah Produk')
                ->alignCenter(),
                Tables\Columns\TextColumn::make('harga')->label('Harga Produk')
                ->money('IDR')->alignEnd(),
                Tables\Columns\TextColumn::make('harga')->label('Total Harga')
                ->getStateUsing(function ($record){
                    return $record->jumlah * $record->harga;
                })->money('IDR')->alignEnd()
                ->summarize(
                    Summarizer::make()
                    ->using(function ($query){
                        return $query->sum(DB::raw('jumlah * harga'));
                    })->money('IDR'),
                ),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                ->form([
                    TextInput::make('jumlah')
                    ->required()
                ]),
                Tables\Actions\DeleteAction::make()
            ])
            ->headerActions([
                Action::make('selesai')
                    ->label('Simpan')
                    ->action(function () {
                        // Cek apakah ada data yang disimpan
                        $dataExists = TransactionProductDetail::where('transaction_id', $this->transactionId)->exists();

                        if (!$dataExists) {
                            Notification::make()
                            ->title('Tambahkan transaksi !')
                            ->danger()
                            ->send();
                            return Redirect::back();
                        }
                        Notification::make()
                        ->title('Transaksi berhasil')
                        ->success()
                        ->send();
                        return redirect()->route('filament.dashboard.resources.transaction-products.index');

                    }),
            ]);
    }
}
