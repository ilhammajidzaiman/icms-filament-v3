<?php

namespace App\Filament\Resources\FileResource\Widgets;

use App\Models\File;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class FileOverview extends BaseWidget
{
    // protected static string $view = 'filament.resources.file-resource.widgets.file-overview';


    protected function getStats(): array
    {
        return [
            Stat::make('Semua', File::all()->count())
                ->color('primary'),
            Stat::make(
                'Aktif',
                File::where('is_active', true)->count()
            )
                ->color('success'),
            Stat::make('Tidak Aktif', File::where('is_active', false)->count())
                ->color('warning'),
        ];
    }
}
