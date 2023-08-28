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
            Stat::make('Artikel', PostArticle::all()->count())
                // ->description('Jumlah artikel')
                ->descriptionIcon('heroicon-o-newspaper')
                ->color('primary')
                ->chart([PostArticle::all()->count()]),
            Stat::make('Diterbitkan', PostArticle::where('is_active', true)->count())
                // ->description('Jumlah diterbitkan')
                ->descriptionIcon('heroicon-o-rocket-launch')
                ->color('success'),
            Stat::make('Draft', PostArticle::where('is_active', false)->count())
                // ->description('Jumlah belum diterbitkan')
                ->descriptionIcon('heroicon-o-archive-box')
                ->color('warning'),
        ];
    }
}
