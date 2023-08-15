<?php

namespace App\Filament\Resources\PostArticleResource\Pages;

use App\Filament\Resources\PostArticleResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePostArticle extends CreateRecord
{
    protected static string $resource = PostArticleResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
