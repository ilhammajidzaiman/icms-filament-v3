<?php

namespace App\Filament\Pages;

use App\Models\Post;
use App\Models\User;
use Livewire\Component;
use Filament\Pages\Page;
use Filament\Actions\Action;
use Filament\Forms\Contracts\HasForms;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Actions\Concerns\InteractsWithActions;

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

    public User $user;

    public function deleteAction(): Action
    {
        return Action::make('delete')
            ->requiresConfirmation()
            ->action(fn () => $this->user->delete());
    }
}
