<?php

namespace App\Filament\Resources\InvestResource\Pages;

use App\Filament\Resources\InvestResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInvests extends ListRecords
{
    protected static string $resource = InvestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
