<?php

namespace App\Filament\Resources\CategoryResource\Widgets;

use App\Models\Category;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class CategoryOverview extends BaseWidget
{
    // protected static string $view = 'filament.resources.post-category-resource.widgets.category-overview';

    protected function getStats(): array
    {
        return [
            Stat::make('Semua', Category::all()->count())
                ->color('primary'),
            Stat::make('Aktif', Category::where('is_active', true)->count())
                ->color('success'),
            Stat::make('Tidak Aktif', Category::where('is_active', false)->count())
                ->color('warning'),
        ];
    }
}
