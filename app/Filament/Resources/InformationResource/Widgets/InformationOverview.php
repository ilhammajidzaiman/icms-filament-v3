<?php

namespace App\Filament\Resources\InformationResource\Widgets;

use App\Models\Information;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class InformationOverview extends BaseWidget
{
    // protected static string $view = 'filament.resources.information-resource.widgets.information-overview';

    protected function getStats(): array
    {
        return [
            Stat::make('Semua', Information::all()->count())
                ->color('primary')
                ->chart([Information::all()->count()]),
            Stat::make(
                'Terbit',
                Information::where('is_active', true)->count()
            )
                ->color('success'),
            Stat::make('Draft', Information::where('is_active', false)->count())
                ->color('warning'),
        ];
    }
}
