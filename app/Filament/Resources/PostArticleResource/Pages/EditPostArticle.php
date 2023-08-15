<?php

namespace App\Filament\Resources\PostArticleResource\Pages;

use App\Filament\Resources\PostArticleResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPostArticle extends EditRecord
{
    protected static string $resource = PostArticleResource::class;

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
