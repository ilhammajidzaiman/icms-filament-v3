<?php

namespace App\Filament\Resources;

use stdClass;
use Filament\Forms;
use App\Models\Page;
use Filament\Tables;
use App\Models\Article;
use App\Models\NavMenu;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\MorphToSelect;
use App\Filament\Resources\NavMenuResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\NavMenuResource\RelationManagers;

class NavMenuResource extends Resource
{
    protected static ?string $model = NavMenu::class;

    protected static ?string $navigationIcon = 'heroicon-o-bars-3';
    // protected static ?string $navigationGroup = 'Blog';
    protected static ?string $modelLabel = 'Nav Menu';
    protected static ?string $navigationLabel = 'Nav Menu';
    protected static ?string $slug = 'nav-menu';
    protected static ?string $recordTitleAttribute = 'title';
    protected static ?int $navigationSort = 6;

    public static function form(Form $form): Form
    {
        return $form
            ->columns(1)
            ->schema([
                Hidden::make('user_id')
                    ->label('Id Penulis')
                    ->required()
                    ->default(auth()->user()->id)
                    ->disabled()
                    ->dehydrated(),
                Hidden::make('parent_id')
                    ->label('Id Menu Utama')
                    ->required()
                    ->default(-1)
                    ->disabled()
                    ->dehydrated(),
                Hidden::make('order')
                    ->label('Urutan')
                    ->required()
                    ->default(0)
                    ->disabled()
                    ->dehydrated(),
                Section::make()
                    ->schema([
                        Toggle::make('is_active')
                            ->label('Status')
                            ->required()
                            ->default('1'),
                        TextInput::make('title')
                            ->label('Judul')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),
                        TextInput::make('slug')
                            ->label('Slug')
                            ->required()
                            ->maxLength(255)
                            ->disabled()
                            ->dehydrated()
                            ->helperText('Slug akan otomatis dihasilkan dari judul.'),
                    ]),
                MorphToSelect::make('modelable')
                    ->label('Arahkan Ke')
                    ->required()
                    // ->searchable()
                    // ->noSearchResultsMessage('Pencarian tidak ditemukan.')
                    ->types([
                        MorphToSelect\Type::make(Article::class)
                            ->titleAttribute('title')
                            ->label('Artikel'),
                        MorphToSelect\Type::make(Page::class)
                            ->titleAttribute('title')
                            ->label('Halaman'),
                        // MorphToSelect\Type::make(Link::class)
                        //     ->titleAttribute('name')
                        //     ->label('Link'),
                    ])
            ]);
    }

    // {
    //     return $form
    //         ->schema([
    //             Forms\Components\Select::make('user_id')
    //                 ->relationship('user', 'name')
    //                 ->required(),
    //             Forms\Components\TextInput::make('parent_id')
    //                 ->required()
    //                 ->numeric()
    //                 ->default(-1),
    //             Forms\Components\TextInput::make('order')
    //                 ->required()
    //                 ->numeric()
    //                 ->default(0),
    //             Forms\Components\TextInput::make('modelable_type')
    //                 ->required()
    //                 ->maxLength(255),
    //             Forms\Components\TextInput::make('modelable_id')
    //                 ->required()
    //                 ->numeric(),
    //             Forms\Components\TextInput::make('title')
    //                 ->required()
    //                 ->maxLength(255),
    //             Forms\Components\TextInput::make('slug')
    //                 ->required()
    //                 ->maxLength(255),
    //             Forms\Components\Toggle::make('is_active')
    //                 ->required(),
    //         ]);
    // }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('#')->state(
                    static function (HasTable $livewire, stdClass $rowLoop): string {
                        return (string) ($rowLoop->iteration +
                            ($livewire->getTableRecordsPerPage() * ($livewire->getTablePage() - 1
                            ))
                        );
                    }
                ),
                TextColumn::make('title')
                    ->label('Judul')
                    ->sortable()
                    ->wrap()
                    ->searchable(),
                TextColumn::make('modelable_type')
                    ->label('Model Type')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('modelable_id')
                    ->label('Model Id')
                    ->numeric()
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('user.name')
                    ->label('Penulis')
                    ->badge()
                    ->color('info')
                    ->sortable()
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
            'index' => Pages\ListNavMenus::route('/'),
            'create' => Pages\CreateNavMenu::route('/create'),
            'edit' => Pages\EditNavMenu::route('/{record}/edit'),
            'view' => Pages\ViewNavMenu::route('/{record}'),
            'tree-list' => Pages\NavMenuTree::route('/tree-list'),
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
