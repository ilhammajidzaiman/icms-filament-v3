<?php

namespace App\Filament\Resources\PostArticleResource\Pages;

use App\Filament\Resources\PostArticleResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPostArticles extends ListRecords
{
    protected static string $resource = PostArticleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
