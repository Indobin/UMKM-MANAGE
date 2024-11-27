<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransactionResource\Pages;
use App\Filament\Resources\TransactionResource\RelationManagers;
use App\Models\Transaction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use PhpParser\Node\Stmt\Label;

class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;
    protected static ?string $pluralLabel = 'Transaksi';
    protected static ?string $navigationIcon = 'heroicon-o-banknotes';
    protected static ?string $navigationGroup = 'Transaksi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('foto')
                    ->image(),
                Forms\Components\DatePicker::make('tanggal')
                    ->required(),
                Forms\Components\TextInput::make('jumlah')
                    ->label('Total')
                    ->required()
                    ->numeric(),
                Forms\Components\Select::make('pemasukan')
                    ->label('Jenis Transaksi')
                    ->required()
                    ->options([
                        true => 'Pemasukan',
                        false => 'Pengeluaran',
                    ]),
                Forms\Components\Select::make('idkategori')
                    ->label('Kategori')
                    ->relationship('category', 'kategori')
                    ->required(),
                Forms\Components\Textarea::make('catatan')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('category.foto')
                    ->searchable(),
                Tables\Columns\TextColumn::make('category.kategori')
                    ->description(fn (Transaction $transaction): string => $transaction->nama)
                    ->label('Transaksi'),
                Tables\Columns\IconColumn::make('pemasukan')
                    ->label('Tipe')
                    ->trueIcon('heroicon-o-arrow-up-circle')
                    ->falseIcon('heroicon-o-arrow-down-circle')
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->boolean(),
                Tables\Columns\TextColumn::make('tanggal')
                    ->date('Y-m-d')
                    ->sortable(),
                Tables\Columns\TextColumn::make('jumlah')
                    ->label('Total')
                    ->numeric()
                    ->money('IDR', locale:'id')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListTransactions::route('/'),
            'create' => Pages\CreateTransaction::route('/create'),
            'edit' => Pages\EditTransaction::route('/{record}/edit'),
        ];
    }
}
