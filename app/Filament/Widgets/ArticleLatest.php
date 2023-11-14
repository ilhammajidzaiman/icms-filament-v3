<?php

namespace App\Filament\Widgets;

use stdClass;
use Filament\Tables;
use App\Models\Article;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Widgets\TableWidget as BaseWidget;

class ArticleLatest extends BaseWidget
{
    protected static ?string $heading = 'Artikel Terbaru';
    protected static string $color = 'info';
    protected static bool $isLazy = true;
    protected int | string | array $columnSpan = 'full';
    protected static ?int $sort = 3;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Article::orderByDesc('published_at')
                    ->limit(10)
            )
            ->columns([
                TextColumn::make('index')
                    ->label('#')
                    ->state(
                        static function (HasTable $livewire, stdClass $rowLoop): string {
                            return (string) ($rowLoop->iteration +
                                ($livewire->getTableRecordsPerPage() * ($livewire->getTablePage() - 1
                                ))
                            );
                        }
                    ),
                TextColumn::make('title')
                    ->label('Judul')
                    ->wrap(),
                TextColumn::make('visitor')
                    ->label('Pengunjung'),
                TextColumn::make('published_at')
                    ->label('Terbit')
                    ->since(),
            ]);
    }

    public function getDescription(): ?string
    {
        return 'Daftar artikel terbaru.';
    }
}
