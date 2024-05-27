<?php

namespace App\Filament\Resources\FacturaPorCobrarResource\Pages;

use App\Filament\Resources\FacturaPorCobrarResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFacturaPorCobrar extends EditRecord
{
    protected static string $resource = FacturaPorCobrarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
