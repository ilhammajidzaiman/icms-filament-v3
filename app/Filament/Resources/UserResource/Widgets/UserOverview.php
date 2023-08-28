<?php

namespace App\Filament\Resources\UserResource\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class UserOverview extends BaseWidget
{
    // protected static string $view = 'filament.resources.user-resource.widgets.user-overview';

    protected function getStats(): array
    {
        return [
            Stat::make('Semua', User::all()->count())
                ->color('primary')
                ->chart([User::all()->count()]),
            Stat::make('Aktif', User::where('is_active', true)->count())
                ->color('success'),
            Stat::make('Tidak aktif', User::where('is_active', false)->count())
                ->color('warning'),
        ];
    }
}
