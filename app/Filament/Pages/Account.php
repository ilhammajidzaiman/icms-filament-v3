<?php

namespace App\Filament\Pages;

use stdClass;
use Filament\Pages\Page;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\ToggleColumn;

class Account extends Page
{
    protected static ?string $model = User::class;
    protected static string $view = 'filament.pages.account';
    protected static ?string $navigationIcon = 'heroicon-o-user-circle';
    protected static ?string $activeNavigationIcon = 'heroicon-s-user-circle';
    protected static ?string $modelLabel = 'Akun';
    protected static ?string $navigationLabel = 'Akun';
    protected static ?string $slug = 'account';
    protected static ?int $navigationSort = 1;
}
