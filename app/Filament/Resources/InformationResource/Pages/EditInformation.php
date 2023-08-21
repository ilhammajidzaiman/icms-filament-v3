<?php

namespace App\Filament\Resources\InformationResource\Pages;

use App\Filament\Resources\InformationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInformation extends EditRecord
{
    protected static string $resource = InformationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
