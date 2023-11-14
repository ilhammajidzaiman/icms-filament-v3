<?php

namespace App\Filament\Resources\VideoResource\Widgets;

use App\Models\Video;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class VideoOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Semua', Video::all()->count())
                ->color('primary'),
            Stat::make(
                'Aktif',
                Video::where('is_active', true)->count()
            )
                ->color('success'),
            Stat::make('Tidak Aktif', Video::where('is_active', false)->count())
                ->color('warning'),
        ];
    }
}
