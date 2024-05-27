<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReciboResource\Pages;
use App\Models\Recibo;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ReciboResource extends Resource
{
    protected static ?string $model = Recibo::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('pago_id')
                    ->relationship('pago', 'monto')
                    ->required(),
                Forms\Components\TextInput::make('numero_recibo')
                    ->required(),
                Forms\Components\DatePicker::make('fecha_recibo')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('pago.monto')
                    ->label('Pago'),
                Tables\Columns\TextColumn::make('numero_recibo'),
                Tables\Columns\TextColumn::make('fecha_recibo')
                    ->date(),
            ])
            ->filters([
                // Agrega filtros si es necesario
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
            // Agrega relaciones si es necesario
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRecibos::route('/'),
            'create' => Pages\CreateRecibo::route('/create'),
            'edit' => Pages\EditRecibo::route('/{record}/edit'),
        ];
    }
}
