<?php

namespace App\Filament\Pages\Auth;

use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Forms\Form;

use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Pages\Auth\EditProfile as BaseEditProfile;

class EditProfile extends BaseEditProfile
{
    // protected static ?string $navigationIcon = 'heroicon-o-document-text';

    // protected static string $view = 'filament.pages.auth.edit-profile';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                $this->getNameFormComponent()
                    ->label('Nama'),
                $this->getEmailFormComponent()
                    ->label('Email')
                    ->unique(ignoreRecord: true),
                TextInput::make('username')
                    ->label('Username')
                    ->required()
                    ->unique(ignoreRecord: true),
                $this->getPasswordFormComponent()
                    ->label('Password Baru')
                    ->password()
                    ->dehydrated(fn (?string $state): bool => filled($state))
                    ->required(fn (string $operation): bool => $operation === 'create')
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('password_string', $state))
                    ->maxLength(255),
                $this->getPasswordConfirmationFormComponent()
                    ->label('Konfirmasi Password Baru')
                    ->same('password')
                    ->password()
                    ->required(fn (string $operation): bool => $operation === 'create')
                    ->visible(fn (Get $get): bool => filled($get('password')))
                    ->maxLength(255),
                Hidden::make('password_string')
                    ->label('Password String')
                    ->disabled()
                    ->dehydrated(),
                FileUpload::make('file')
                    ->label('File')
                    ->maxSize(1024)
                    ->directory('user/' . date('Y/m'))
                    ->image()
                    ->imageEditor()
                    ->openable()
                    ->downloadable()
                    ->helperText('Maksimal ukuran file 1024 kb atau 1 mb'),

            ]);
    }
}
