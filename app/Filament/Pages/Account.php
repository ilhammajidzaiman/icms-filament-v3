<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class Account extends Page
{
    protected static string $view = 'filament.pages.account';
    protected static ?string $navigationIcon = 'heroicon-o-user-circle';
    protected static ?string $activeNavigationIcon = 'heroicon-s-user-circle';
    // protected static ?string $navigationGroup = 'Blog';
    protected static ?string $modelLabel = 'Akun';
    protected static ?string $navigationLabel = 'Akun';
    protected static ?string $slug = 'account';
    protected static ?int $navigationSort = 1;
}
