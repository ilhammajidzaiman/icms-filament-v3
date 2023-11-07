<?php

namespace App\Filament\Resources\NavMenuResource\Widgets;

use App\Models\NavMenu;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class NavMenuOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Semua', NavMenu::all()->count())
                ->color('primary'),
            Stat::make('Aktif', NavMenu::where('is_active', true)->count())
                ->color('success'),
            Stat::make('Tidak Aktif', NavMenu::where('is_active', false)->count())
                ->color('warning'),
        ];
    }
}
