<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FacturaPorCobrarResource\Pages;
use App\Models\FacturaPorCobrar;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FacturaPorCobrarResource extends Resource
{
    protected static ?string $model = FacturaPorCobrar::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('consecutivo_factura')
                    ->required(),
                Forms\Components\DatePicker::make('fecha_emision_factura')
                    ->required(),
                Forms\Components\DatePicker::make('fecha_vencimiento_factura')
                    ->required(),
                Forms\Components\TextInput::make('valor_total_factura')
                    ->numeric()
                    ->required(),
                Forms\Components\TextInput::make('valor_abonado')
                    ->numeric()
                    ->required(),
                Forms\Components\Select::make('clientes_id_cliente')
                    ->relationship('cliente', 'nombres_cliente')
                    ->required(),
                Forms\Components\TextInput::make('estado_pago_factura')
                    ->required(),
                Forms\Components\FileUpload::make('pdf_factura')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('consecutivo_factura'),
                Tables\Columns\TextColumn::make('fecha_emision_factura')
                    ->date(),
                Tables\Columns\TextColumn::make('fecha_vencimiento_factura')
                    ->date(),
                Tables\Columns\TextColumn::make('valor_total_factura'),
                Tables\Columns\TextColumn::make('valor_abonado'),
                Tables\Columns\TextColumn::make('cliente.nombres_cliente')
                    ->label('Cliente'),
                Tables\Columns\TextColumn::make('estado_pago_factura'),
                Tables\Columns\TextColumn::make('pdf_factura'),
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
            'index' => Pages\ListFacturasPorCobrar::route('/'),
            'create' => Pages\CreateFacturaPorCobrar::route('/create'),
            'edit' => Pages\EditFacturaPorCobrar::route('/{record}/edit'),
        ];
    }
}
