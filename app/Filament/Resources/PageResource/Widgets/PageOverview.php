<?php

namespace App\Filament\Resources\PageResource\Widgets;

use App\Models\Page;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class PageOverview extends BaseWidget
{
    // protected static string $view = 'filament.resources.page-resource.widgets.page-overview';

    protected function getStats(): array
    {
        return [
            Stat::make('Semua', Page::all()->count())
                ->color('primary')
                ->chart([Page::all()->count()]),
            Stat::make('Terbit', Page::where('is_active', true)->count())
                ->color('success'),
            Stat::make('Draft', Page::where('is_active', false)->count())
                ->color('warning'),
        ];
    }
}
