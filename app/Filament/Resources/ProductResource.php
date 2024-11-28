<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;
    protected static ?string $pluralLabel = 'Produk';
    protected static ?string $navigationIcon = 'heroicon-o-cube';
    protected static ?string $navigationGroup = 'Transaksi Produk';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('kode')
                    ->required()
                    ->disabled()
                    ->dehydrated(true)
                    ->default(function (){
                        $lastCode = Product::max('kode');
                        return $lastCode ? $lastCode + 1 : 1001;
                    }),
                    // ->disabled(),
                Forms\Components\TextInput::make('nama')
                    ->required()
                    ->maxLength(255),
                // Forms\Components\TextInput::make('kategori')
                //     ->maxLength(255),
                Forms\Components\TextInput::make('stok')
                    ->required()
                    ->disabledOn('edit')
                    ->numeric(),
                Forms\Components\TextInput::make('harga')
                    ->required()
                    ->numeric(),
                Forms\Components\Select::make('satuan')
                    ->options([
                        'pcs' => 'Pcs',
                        'kg' => 'Kg',
                        'lusin' => 'Lusin'
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kode')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama')
                    ->searchable(),
                // Tables\Columns\TextColumn::make('kategori')
                //     ->searchable(),
                Tables\Columns\TextColumn::make('stok')
                    ->searchable(),
                Tables\Columns\TextColumn::make('satuan'),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
