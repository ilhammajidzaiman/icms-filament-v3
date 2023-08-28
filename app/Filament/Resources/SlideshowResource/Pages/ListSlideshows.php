<?php

namespace App\Filament\Resources\SlideshowResource\Pages;

use Filament\Actions;
use App\Models\Slideshow;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\SlideshowResource;
use App\Filament\Resources\SlideshowResource\Widgets\SlideshowOverview;

class ListSlideshows extends ListRecords
{
    protected static string $resource = SlideshowResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            SlideshowOverview::class,
        ];
    }
}
