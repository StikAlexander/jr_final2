<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CollaboratorResource\Pages;
use App\Models\Collaborator;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CollaboratorResource extends Resource
{
    protected static ?string $model = Collaborator::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('tipo_documento_colaborador')
                    ->options([
                        'NIT' => 'NIT',
                        'CC' => 'CC',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('numero_documento_colaborador')
                    ->required(),
                Forms\Components\TextInput::make('nombres_colaborador')
                    ->required(),
                Forms\Components\TextInput::make('apellidos_colaborador')
                    ->required(),
                Forms\Components\Select::make('cargo_colaborador')
                    ->options([
                        'ADMINISTRADOR' => 'ADMINISTRADOR',
                        'COLABORADOR' => 'COLABORADOR',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('contrasena_colaborador')
                    ->password()
                    ->required(),
                Forms\Components\TextInput::make('correo_colaborador')
                    ->email()
                    ->required(),
                Forms\Components\TextInput::make('telefono_colaborador'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tipo_documento_colaborador'),
                Tables\Columns\TextColumn::make('numero_documento_colaborador'),
                Tables\Columns\TextColumn::make('nombres_colaborador'),
                Tables\Columns\TextColumn::make('apellidos_colaborador'),
                Tables\Columns\TextColumn::make('cargo_colaborador'),
                Tables\Columns\TextColumn::make('correo_colaborador'),
                Tables\Columns\TextColumn::make('telefono_colaborador'),
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
            'index' => Pages\ListCollaborators::route('/'),
            'create' => Pages\CreateCollaborator::route('/create'),
            'edit' => Pages\EditCollaborator::route('/{record}/edit'),
        ];
    }
}
