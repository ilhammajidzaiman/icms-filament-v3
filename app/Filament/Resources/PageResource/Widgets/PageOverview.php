<?php

namespace App\Filament\Resources\PageResource\Widgets;

use App\Models\Page;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class PageOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Semua', Page::all()->count())
                ->color('primary'),
            Stat::make('Aktif', Page::where('is_active', true)->count())
                ->color('success'),
            Stat::make('Tidak Aktif', Page::where('is_active', false)->count())
                ->color('warning'),
        ];
    }
}
