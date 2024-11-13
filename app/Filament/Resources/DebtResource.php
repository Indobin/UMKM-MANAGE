<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DebtResource\Pages;
use App\Filament\Resources\DebtResource\RelationManagers;
use App\Models\Debt;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use PhpParser\Node\Stmt\Label;

class DebtResource extends Resource
{
    protected static ?string $model = Debt::class;
    protected static ?string $pluralLabel = 'Hutang';
    protected static ?string $navigationIcon = 'heroicon-o-credit-card';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('jumlah')
                    ->required()
                    ->numeric(),
                Forms\Components\DatePicker::make('tanggal_jatuh_tempo')
                    ->required(),
                Forms\Components\TextInput::make('catatan')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Toggle::make('lunas')
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('jumlah')
                    ->label('Total')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tanggal_jatuh_tempo')
                    ->label('Tgl Jatuh Tempo')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('catatan')
                    ->searchable(),
                Tables\Columns\IconColumn::make('lunas')
                    ->boolean(),
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
                Tables\Actions\EditAction::make()->label('Ubah'),
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
    public static function getHeaderActions(): array
    {
        return [
            Tables\Actions\CreateAction::make()->label('Tambah Data'),
        ];
    }
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDebts::route('/'),
            'create' => Pages\CreateDebt::route('/create'),
            'edit' => Pages\EditDebt::route('/{record}/edit'),
        ];
    }
}
