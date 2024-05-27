<?php

namespace App\Filament\Resources\FacturaPorCobrarResource\Pages;

use App\Filament\Resources\FacturaPorCobrarResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFacturasPorCobrar extends ListRecords
{
    protected static string $resource = FacturaPorCobrarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
