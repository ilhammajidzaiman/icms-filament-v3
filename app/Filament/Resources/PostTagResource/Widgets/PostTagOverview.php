<?php

namespace App\Filament\Resources\PostTagResource\Widgets;

use App\Models\PostTag;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class PostTagOverview extends BaseWidget
{
    // protected static string $view = 'filament.resources.post-tag-resource.widgets.post-tag-overview';

    protected function getStats(): array
    {
        return [
            Stat::make('Semua', PostTag::all()->count())
                ->chart([PostTag::all()->count()]),
            Stat::make('Aktif', PostTag::where('is_active', true)->count())
                ->color('success'),
            Stat::make('Tidak Aktif', PostTag::where('is_active', false)->count())
                ->color('success'),
        ];
    }
}
