<?php

namespace App\Filament\Resources\PostCategoryResource\Widgets;

use App\Models\PostCategory;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class CategoryOverview extends BaseWidget
{
    // protected static string $view = 'filament.resources.post-category-resource.widgets.category-overview';

    protected function getStats(): array
    {
        return [
            Stat::make('Semua', PostCategory::all()->count())
                ->chart([PostCategory::all()->count()]),
            Stat::make('Aktif', PostCategory::where('is_active', true)->count())
                ->color('success'),
            Stat::make('Tidak Aktif', PostCategory::where('is_active', false)->count())
                ->color('success'),
        ];
    }
}
