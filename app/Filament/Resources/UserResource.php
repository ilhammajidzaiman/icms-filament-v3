<?php

namespace App\Filament\Resources;

use stdClass;
use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\Rules\Password;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use App\Filament\Resources\UserResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\UserResource\RelationManagers;
use Filament\Infolists\Components\TextEntry\TextEntrySize;
use Filament\Infolists\Components\Section as InfolistsSection;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $navigationGroup = 'Pengaturan';
    protected static ?string $modelLabel = 'User';
    protected static ?string $navigationLabel = 'User';
    protected static ?string $slug = 'user';
    protected static ?int $navigationSort = 3;
    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->columns(3)
            ->schema([
                Section::make()
                    ->columnSpan(2)
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('email')
                            ->label('E-mail')
                            ->email()
                            ->required()
                            ->maxLength(255),
                        TextInput::make('password')
                            ->label('Password')
                            ->password()
                            ->required()
                            ->maxLength(255)
                            ->same('confirmation')
                            // ->autocomplete('new-password')
                            ->rule(Password::default())
                            ->dehydrateStateUsing(fn ($state) => Hash::make($state)),
                        TextInput::make('confirmation')
                            ->label('Konfirmasi password')
                            ->password()
                            ->required()
                            ->maxLength(255)
                            ->dehydrated(false),
                    ]),
                Section::make()
                    ->columnSpan(1)
                    ->schema([
                        Toggle::make('is_active')
                            ->label('Status')
                            ->required()
                            ->default('1'),
                        FileUpload::make('file')
                            ->label('File')
                            ->required()
                            ->maxSize(1024)
                            ->directory('user/' . date('Y/m'))
                            ->image()
                            ->imageEditor()
                            ->openable()
                            ->downloadable()
                            ->helperText('Maksimal ukuran file 1024 kb atau 1 mb'),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
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
                ImageColumn::make('file')
                    ->label('File')
                    ->defaultImageUrl(asset('/image/default-user.svg'))
                    ->circular(),
                TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('username')
                    ->label('Username')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('password_string')
                    ->label('Password')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deleted_at')
                    ->label('Dihapus')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                IconColumn::make('is_active')
                    ->label('Status')
                    ->boolean()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()->color('blue'),
                    Tables\Actions\EditAction::make()->color('emerald'),
                    Tables\Actions\DeleteAction::make()->color('red'),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
            'view' => Pages\ViewUser::route('/{record}'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->columns(3)
            ->schema([
                InfolistsSection::make()
                    ->columnSpan(2)
                    ->schema([
                        ImageEntry::make('file')
                            ->hiddenlabel('Gambar')
                            ->defaultImageUrl(asset('/images/default-user.svg')),
                        TextEntry::make('name')
                            ->label('Nama')
                            ->weight(FontWeight::Medium)
                            ->size(TextEntrySize::Large),
                        TextEntry::make('email')
                            ->label('Email'),
                        TextEntry::make('username')
                            ->label('Username'),
                    ]),
                InfolistsSection::make()
                    ->columnSpan(1)
                    ->schema([
                        IconEntry::make('is_active')
                            ->label('Status')
                            ->boolean(),
                        TextEntry::make('roles.name')
                            ->label('Role')
                            ->badge()
                            ->color('info')
                            ->separator(',')
                            ->size(TextEntrySize::Large),
                        TextEntry::make('created_at')
                            ->label('Dibuat')
                            ->since(),
                        TextEntry::make('updated_at')
                            ->label('Diperbarui')
                            ->since(),
                    ])
            ]);
    }
}
