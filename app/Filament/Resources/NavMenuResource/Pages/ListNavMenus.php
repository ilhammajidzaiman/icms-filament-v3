<?php

namespace App\Filament\Resources\NavMenuResource\Pages;

use App\Filament\Resources\NavMenuResource;
use App\Filament\Resources\NavMenuResource\Widgets\NavMenuOverview;
use App\Filament\Resources\NavMenuResource\Widgets\NavMenuWidget;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListNavMenus extends ListRecords
{
    protected static string $resource = NavMenuResource::class;

    // protected function getHeaderActions(): array
    // {
    //     return [
    //         Actions\CreateAction::make(),
    //     ];
    // }

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            NavMenuOverview::class,
            NavMenuWidget::class,
        ];
    }
}
