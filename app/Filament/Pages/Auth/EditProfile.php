<?php

namespace App\Filament\Pages\Auth;

use Filament\Forms\Form;
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
                    ->label('Email'),
                TextInput::make('username')
                    ->label('Username')
                    ->required()
                    ->unique(ignoreRecord: true),
                $this->getPasswordFormComponent()
                    ->label('Password Baru'),
                $this->getPasswordConfirmationFormComponent()
                    ->label('Konfirmasi Password Baru'),
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
