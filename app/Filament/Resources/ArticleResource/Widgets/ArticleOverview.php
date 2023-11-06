<?php

namespace App\Filament\Resources\ArticleResource\Widgets;

use App\Models\Article;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class ArticleOverview extends BaseWidget
{
    // protected static string $view = 'filament.resources.post-article-resource.widgets.article-overview';

    protected function getStats(): array
    {
        return [
            Stat::make('Semua', Article::all()->count())
                ->color('primary')
                ->chart([Article::all()->count()]),
            Stat::make('Aktif', Article::where('is_active', true)->count())
                ->color('success'),
            Stat::make('Tidak Aktif', Article::where('is_active', false)->count())
                ->color('warning'),
        ];
    }
}
