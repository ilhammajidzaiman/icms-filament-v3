<?php

namespace App\Filament\Widgets;

use App\Models\Article;
use App\Models\Category;
use App\Models\File;
use App\Models\Image;
use App\Models\Information;
use App\Models\Link;
use App\Models\Page;
use App\Models\Slideshow;
use App\Models\Tag;
use App\Models\User;
use App\Models\Video;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('User', User::all()->count())
                ->chart([3, 4, 10, 7, 8, 1, 6])
                ->color('teal'),
            Stat::make('Artikel', Article::all()->count())
                ->chart([3, 4, 10, 7, 8, 1, 6])
                ->color('sky'),
            Stat::make('Tanda/Topik', Tag::all()->count())
                ->chart([7, 2, 10, 3, 8, 5, 9])
                ->color('green'),
            Stat::make('Kategori', Category::all()->count())
                ->chart([3, 4, 10, 7, 8, 1, 6])
                ->color('indigo'),
            Stat::make('Halaman', Page::all()->count())
                ->chart([10, 6, 2, 3, 1, 5, 9])
                ->color('purple'),
            Stat::make('Link', Link::all()->count())
                ->chart([7, 2, 10, 3, 8, 5, 9])
                ->color('pink'),
            Stat::make('Slideshow', Slideshow::all()->count())
                ->chart([3, 4, 10, 7, 8, 1, 6])
                ->color('rose'),
            Stat::make('Informasi', Information::all()->count())
                ->chart([3, 4, 10, 7, 8, 1, 6])
                ->color('orange'),
            Stat::make('Dokumen', File::all()->count())
                ->chart([1, 2, 7, 3,  8, 5, 9])
                ->color('cyan'),
            Stat::make('Galeri', Image::all()->count())
                ->chart([1, 2, 7, 3,  8, 5, 9])
                ->color('fuchsia'),
            Stat::make('Video', Video::all()->count())
                ->chart([1, 2, 7, 3,  8, 5, 9])
                ->color('yellow'),
        ];
    }
}
