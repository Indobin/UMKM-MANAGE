<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Product;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Models\TransactionProduct;
use Filament\Forms\Components\Grid;
use App\Models\TransactionProductDetail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\TransactionProductDetailResource\Pages;
use App\Filament\Resources\TransactionProductDetailResource\RelationManagers;

class TransactionProductDetailResource extends Resource
{
    protected static ?string $model = TransactionProductDetail::class;
    protected static ?string $pluralLabel = 'Transaksi Produk';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Transaksi Produk';
    public static function canViewAny(): bool
    {
        // Cek jika route yang sedang diakses adalah "create"
        $currentRouteName = request()->route()?->getName();
    
        if ($currentRouteName === 'filament.dashboard.resources.transaction-product-details.create') {
            return true; // Izinkan akses ke halaman create
        }
    
        return false; // Sembunyikan dari sidebar dan halaman lain
    }
    

    public static function isGloballySearchable(): bool
    {
        // Return false agar tidak muncul dalam global search
        return false;
    }
    public static function form(Form $form): Form
    {
        $transaction = new TransactionProduct();
        if (request()->filled('transaction_id')) {
            $transaction = TransactionProduct::find(request('transaction_id'));
        }
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_pembeli')
                    ->required()
                    ->maxLength(255)
                    ->default($transaction->nama_pembeli ?? null)
                    ->disabled(),
                Forms\Components\DatePicker::make('tanggal_transaksi')
                    ->required()
                    ->default($transaction->tanggal_transaksi ?? null)
                    ->disabled(),
                Grid::make()
                ->schema([
                    Forms\Components\Select::make('product_id')
                    ->label('Produk')
                    ->relationship('product', 'nama')
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function($state, Set $set){
                        $produk = Product::find($state);
                        $set('harga', $produk->harga ?? null);
                    }),
                    Forms\Components\TextInput::make('harga')
                    ->label('Harga Produk'),
                    // ->disabled(),
                    Forms\Components\TextInput::make('jumlah')
                        ->required()
                        ->numeric()
                        ->label('Jumlah'),

                ])->columns(3),

                Forms\Components\Hidden::make('transaction_id')
                    ->label('Harga Produk')
                    ->default(request('transaction_id')),


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ListTransactionProductDetails::route('/'),
            'create' => Pages\CreateTransactionProductDetail::route('/create'),
            'edit' => Pages\EditTransactionProductDetail::route('/{record}/edit'),
        ];
    }
}
