<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReceinvableResource\Pages;
use App\Filament\Resources\ReceinvableResource\RelationManagers;
use App\Models\Receinvable;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ReceinvableResource extends Resource
{
    protected static ?string $model = Receinvable::class;
    protected static ?string $pluralLabel = 'Piutang';
    protected static ?string $navigationIcon = 'heroicon-o-circle-stack';

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
                Forms\Components\Toggle::make('terbayarkan')
                    ->required(),
                Forms\Components\TextInput::make('catatan')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->searchable(),
                Tables\Columns\IconColumn::make('terbayarkan')
                ->boolean(),
                Tables\Columns\TextColumn::make('jumlah')
                    ->label('Total')
                    ->numeric()
                    ->money('IDR', locale:'id')
                    ->sortable(),
                Tables\Columns\TextColumn::make('tanggal_jatuh_tempo')
                    ->label('Tgl. Jatuh Tempo')     
                    ->date('Y-m-d')
                    ->sortable(),
                Tables\Columns\TextColumn::make('catatan')
                    ->searchable(),
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
            'index' => Pages\ListReceinvables::route('/'),
            'create' => Pages\CreateReceinvable::route('/create'),
            'edit' => Pages\EditReceinvable::route('/{record}/edit'),
        ];
    }
}
