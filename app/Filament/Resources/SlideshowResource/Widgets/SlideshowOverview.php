<?php

namespace App\Filament\Resources\SlideshowResource\Widgets;

use App\Models\Information;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class SlideshowOverview extends BaseWidget
{
    // protected static string $view = 'filament.resources.slideshow-resource.widgets.slideshow-overview';

    protected function getStats(): array
    {
        return [
            Stat::make('Semua', Information::all()->count())
                ->color('primary'),
            Stat::make(
                'Aktif',
                Information::where('is_active', true)->count()
            )
                ->color('success'),
            Stat::make('Tidak Aktif', Information::where('is_active', false)->count())
                ->color('warning'),
        ];
    }
}
