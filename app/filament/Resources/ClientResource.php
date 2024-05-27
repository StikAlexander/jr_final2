<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClientResource\Pages;
use App\Models\Client;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ClientResource extends Resource
{
    protected static ?string $model = Client::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('tipo_documento_cliente')
                    ->options([
                        'NIT' => 'NIT',
                        'CC' => 'CC',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('numero_documento_cliente')
                    ->required(),
                Forms\Components\TextInput::make('razon_social'),
                Forms\Components\TextInput::make('nombres_cliente'),
                Forms\Components\TextInput::make('apellidos_cliente'),
                Forms\Components\TextInput::make('correo_cliente')
                    ->email(),
                Forms\Components\TextInput::make('telefono_cliente'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tipo_documento_cliente'),
                Tables\Columns\TextColumn::make('numero_documento_cliente'),
                Tables\Columns\TextColumn::make('razon_social'),
                Tables\Columns\TextColumn::make('nombres_cliente'),
                Tables\Columns\TextColumn::make('apellidos_cliente'),
                Tables\Columns\TextColumn::make('correo_cliente'),
                Tables\Columns\TextColumn::make('telefono_cliente'),
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
            'index' => Pages\ListClients::route('/'),
            'create' => Pages\CreateClient::route('/create'),
            'edit' => Pages\EditClient::route('/{record}/edit'),
        ];
    }
}
