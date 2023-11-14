<?php

namespace App\Filament\Resources\ImageResource\Widgets;

use App\Models\Image;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ImageOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Semua', Image::all()->count())
                ->color('primary'),
            Stat::make(
                'Aktif',
                Image::where('is_active', true)->count()
            )
                ->color('success'),
            Stat::make('Tidak Aktif', Image::where('is_active', false)->count())
                ->color('warning'),
        ];
    }
}
