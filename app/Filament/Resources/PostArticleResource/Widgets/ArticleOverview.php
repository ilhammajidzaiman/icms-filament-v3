<?php

namespace App\Filament\Resources\PostArticleResource\Widgets;

use App\Models\PostArticle;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class ArticleOverview extends BaseWidget
{
    // protected static string $view = 'filament.resources.post-article-resource.widgets.article-overview';

    protected function getStats(): array
    {
        return [
            Stat::make('Semua', PostArticle::all()->count())
                ->color('primary')
                ->chart([PostArticle::all()->count()]),
            Stat::make('Terbit', PostArticle::where('is_active', true)->count())
                ->color('success'),
            Stat::make('Draft', PostArticle::where('is_active', false)->count())
                ->color('warning'),
        ];
    }
}
