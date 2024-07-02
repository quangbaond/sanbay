<?php

namespace App\Filament\Resources\InvestResource\Pages;

use App\Filament\Resources\InvestResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInvest extends EditRecord
{
    protected static string $resource = InvestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
