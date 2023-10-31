<?php

namespace App\Filament\Resources\ArticleResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\ArticleResource;
use App\Filament\Resources\ArticleResource\Widgets\ArticleOverview;
use Filament\Pages\Concerns\ExposesTableToWidgets;

class ListArticles extends ListRecords
{
    use ExposesTableToWidgets;
    protected static string $resource = ArticleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            ArticleOverview::class,
        ];
    }
}
