<?php

namespace App\Filament\Resources;

use stdClass;
use App\Models\File;
use Filament\Tables;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\FileResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\FileResource\RelationManagers;

class FileResource extends Resource
{
    protected static ?string $model = File::class;

    protected static ?string $navigationIcon = 'heroicon-o-archive-box';
    protected static ?string $activeNavigationIcon = 'heroicon-s-archive-box';
    protected static ?string $modelLabel = 'File';
    protected static ?string $navigationLabel = 'File';
    protected static ?string $slug = 'file';
    protected static ?string $recordTitleAttribute = 'title';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form

            //     Forms\Components\TextInput::make('thumbnail')
            //         ->maxLength(255),
            //     Forms\Components\TextInput::make('file')
            //         ->required()
            //         ->maxLength(255),
            //     Forms\Components\Toggle::make('is_active')
            //         ->required(),
            // ]);
            ->columns(3)
            ->schema([
                Section::make()
                    ->columnSpan(2)
                    ->schema([
                        TextInput::make('title')
                            ->label('Judul')
                            ->required()
                            ->maxLength(255)
                            ->live(1)
                            ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),
                        TextInput::make('slug')
                            ->label('Slug')
                            ->required()
                            ->maxLength(255)
                            ->disabled()
                            ->dehydrated(),
                        FileUpload::make('file')
                            ->label('File')
                            ->required()
                            ->maxSize(5120)
                            ->directory('file/' . date('Y/m'))
                            // ->acceptedFileTypes(['application/pdf', 'document/docx'])
                            ->helperText('Maksimal ukuran file 5120 kb atau 5 mb.'),
                    ]),
                Section::make()
                    ->columnSpan(1)
                    ->schema([
                        Toggle::make('is_active')
                            ->label('Status')
                            ->required()
                            ->default('1'),
                        FileUpload::make('thumbnail')
                            ->label('File Cover/Sampul')
                            ->maxSize(1024)
                            ->directory('cover/' . date('Y/m'))
                            ->image()
                            ->imageEditor()
                            ->openable()
                            ->downloadable()
                            ->helperText('Maksimal ukuran file 1024 kb atau 1 mb.'),
                    ]),
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
                TextColumn::make('id')
                    ->label('Id')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                ImageColumn::make('thumbnail')
                    ->label('Sampul')
                    ->circular()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('title')
                    ->label('Judul')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('slug')
                    ->label('Slug')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime()
                    ->sortable(),
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
                ToggleColumn::make('is_active')
                    ->label('Status')
                    ->sortable(),
            ])
            // ->columns([
            //     Tables\Columns\TextColumn::make('title')
            //         ->searchable(),
            //     Tables\Columns\TextColumn::make('slug')
            //         ->searchable(),
            //     Tables\Columns\TextColumn::make('thumbnail')
            //         ->searchable(),
            //     Tables\Columns\TextColumn::make('file')
            //         ->searchable(),
            //     Tables\Columns\IconColumn::make('is_active')
            //         ->boolean(),
            //     Tables\Columns\TextColumn::make('created_at')
            //         ->dateTime()
            //         ->sortable()
            //         ->toggleable(isToggledHiddenByDefault: true),
            //     Tables\Columns\TextColumn::make('updated_at')
            //         ->dateTime()
            //         ->sortable()
            //         ->toggleable(isToggledHiddenByDefault: true),
            //     Tables\Columns\TextColumn::make('deleted_at')
            //         ->dateTime()
            //         ->sortable(),
            // ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListFiles::route('/'),
            'create' => Pages\CreateFile::route('/create'),
            'view' => Pages\ViewFile::route('/{record}'),
            'edit' => Pages\EditFile::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
