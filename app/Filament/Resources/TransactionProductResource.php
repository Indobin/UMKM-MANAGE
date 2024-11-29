<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Filament\Resources\Resource;
use App\Models\TransactionProduct;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\TransactionProductResource\Pages;
use App\Filament\Resources\TransactionProductResource\RelationManagers;

class TransactionProductResource extends Resource
{
    protected static ?string $model = TransactionProduct::class;
    protected static ?string $pluralLabel = 'Transaksi Produk';
    protected static ?string $navigationIcon = 'heroicon-o-banknotes';
    protected static ?string $navigationGroup = 'Transaksi Produk';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_pembeli')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('tanggal_transaksi')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_pembeli')
                    ->label('Nama Pembeli')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tanggal_transaksi')
                    ->label('Tanggal Transaksi')
                    ->date('d F Y')
                    ->sortable(),
                // Tables\Actions\Action::make('print_invoice')

            ])
            ->filters([
                //
            ])
            ->actions([
                Action::make('view')
                    ->label('Detail')
                    ->icon('heroicon-o-eye')
                    ->modalHeading('Detail Transaksi')
                    ->modalSubmitAction(false)
                    ->modalCancelActionLabel('Kembali')
                    ->modalContent(fn (TransactionProduct $record) => view('filament.transaction-product-detail', [
                        'transaction' => $record->load('details.product'),
                    ])),

                Tables\Actions\Action::make('print_invoice')
                    ->label('Cetak')
                    ->icon('heroicon-o-printer')
                    ->url(fn (TransactionProduct $record) => route('invoice.print', $record))
                    ->openUrlInNewTab()
            ])

            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    public static function getWidgets(): array
    {
        return [
            TransactionProductResource\Widgets\WidgetTransactionDetail::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTransactionProducts::route('/'),
            'create' => Pages\CreateTransactionProduct::route('/create'),
            'edit' => Pages\EditTransactionProduct::route('/{record}/edit'),
            'view' => Pages\ViewTransactionProduct::route('/{record}/view'),
        ];
    }
}
