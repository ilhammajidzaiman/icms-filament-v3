<?php

namespace App\Filament\Resources\InformationResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\InformationResource;
use App\Filament\Resources\InformationResource\Widgets\InformationOverview;

class ListInformation extends ListRecords
{
    protected static string $resource = InformationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }


    protected function getHeaderWidgets(): array
    {
        return [
            InformationOverview::class,
        ];
    }
}
