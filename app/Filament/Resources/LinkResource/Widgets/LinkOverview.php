<?php

namespace App\Filament\Resources\LinkResource\Widgets;

use App\Models\Link;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class LinkOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Semua', Link::all()->count())
                ->color('primary'),
            Stat::make('Aktif', Link::where('is_active', true)->count())
                ->color('success'),
            Stat::make('Tidak Aktif', Link::where('is_active', false)->count())
                ->color('warning'),
        ];
    }
}
