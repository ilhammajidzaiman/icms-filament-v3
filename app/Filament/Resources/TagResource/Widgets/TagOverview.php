<?php

namespace App\Filament\Resources\TagResource\Widgets;

use App\Models\Tag;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class TagOverview extends BaseWidget
{
    // protected static string $view = 'filament.resources.post-tag-resource.widgets.post-tag-overview';

    protected function getStats(): array
    {
        return [
            Stat::make('Semua', Tag::all()->count())
                ->color('primary'),
            Stat::make('Aktif', Tag::where('is_active', true)->count())
                ->color('success'),
            Stat::make('Tidak Aktif', Tag::where('is_active', false)->count())
                ->color('warning'),
        ];
    }
}
