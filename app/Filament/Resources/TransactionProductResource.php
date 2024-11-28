<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransactionProductResource\Pages;
use App\Filament\Resources\TransactionProductResource\RelationManagers;
use App\Models\TransactionProduct;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

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
                Tables\Actions\Action::make('print_invoice')
                    ->label('Print Invoice')
                    ->icon('heroicon-o-printer')
                    ->url(fn (TransactionProduct $record) => route('invoice.print', $record))
                    ->openUrlInNewTab(),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTransactionProducts::route('/'),
            'create' => Pages\CreateTransactionProduct::route('/create'),
            'edit' => Pages\EditTransactionProduct::route('/{record}/edit'),
        ];
    }
}
