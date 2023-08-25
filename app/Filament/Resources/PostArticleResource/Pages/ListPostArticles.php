<?php

namespace App\Filament\Resources\PostArticleResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\PostArticleResource;
use App\Filament\Resources\PostArticleResource\Widgets\ArticleOverview;
use Filament\Pages\Concerns\ExposesTableToWidgets;

class ListPostArticles extends ListRecords
{
    use ExposesTableToWidgets;
    protected static string $resource = PostArticleResource::class;

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
