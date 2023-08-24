<?php

namespace App\Filament\Resources;

use stdClass;
use Filament\Tables;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\PostArticle;
use Illuminate\Support\Str;
use App\Models\PostCategory;
use Filament\Resources\Resource;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\DateTimePicker;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PostArticleResource\Pages;
use App\Filament\Resources\PostArticleResource\RelationManagers;

class PostArticleResource extends Resource
{
    protected static ?string $model = PostArticle::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-duplicate';
    protected static ?string $activeNavigationIcon = 'heroicon-s-document-duplicate';
    protected static ?string $navigationGroup = 'Blog';
    protected static ?string $modelLabel = 'Artikel';
    protected static ?string $navigationLabel = 'Artikel';
    protected static ?string $slug = 'article';
    protected static ?string $recordTitleAttribute = 'title';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->columns(3)
            ->schema([
                Section::make()
                    ->columnSpan(2)
                    ->schema([
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
                            ->dehydrated(),
                        RichEditor::make('content')
                            ->label('Isi')
                            ->required(),
                    ]),
                Section::make()
                    ->columnSpan(1)
                    ->schema([
                        Toggle::make('is_active')
                            ->label('Status')
                            ->required()
                            ->default('1'),
                        DateTimePicker::make('published_at')
                            ->label('Tanggal rilis')
                            ->required()
                            ->default(now()),
                        Hidden::make('user_id')
                            ->label('Id Penulis')
                            ->required()
                            ->default(auth()->id())
                            ->disabled()
                            ->dehydrated(),
                        Hidden::make('visitor')
                            ->label('Pengunjung')
                            ->required()
                            ->default(0)
                            ->disabled()
                            ->dehydrated(),
                        Select::make('post_category_id')
                            ->label('Kategori')
                            ->required()
                            ->options(PostCategory::all()->pluck('name', 'id'))
                            ->relationship(name: 'category', titleAttribute: 'name')
                            ->createOptionForm([
                                TextInput::make('name')
                                    ->label('Nama')
                                    ->required()
                                    ->maxLength(255)
                                    ->live(1)
                                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))
                                    ->unique(table: PostCategory::class),
                                TextInput::make('slug')
                                    ->label('Slug')
                                    ->required()
                                    ->maxLength(255)
                                    ->disabled()
                                    ->dehydrated(),
                            ])
                            ->editOptionForm([
                                TextInput::make('name')
                                    ->label('Nama')
                                    ->required()
                                    ->maxLength(255)
                                    ->live(1)
                                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))
                                    ->unique(table: PostCategory::class),
                                TextInput::make('slug')
                                    ->label('Slug')
                                    ->required()
                                    ->maxLength(255)
                                    ->disabled()
                                    ->dehydrated(),
                            ]),
                        TagsInput::make('tags')
                            ->label('Tanda/Topik')
                            ->required()
                            // ->separator(',')
                            ->suggestions(PostCategory::all()->pluck('name')),
                        FileUpload::make('file')
                            ->label('File')
                            ->required()
                            ->maxSize(1024)
                            ->directory('article/' . date('Y/m'))
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
                TextColumn::make('id')
                    ->label('Id')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                ImageColumn::make('file')
                    ->label('File')
                    ->circular(),
                TextColumn::make('title')
                    ->label('Judul')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('slug')
                    ->label('Slug')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('visitor')
                    ->label('Pengunjung')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('user.name')
                    ->label('Penulis')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('category.name')
                    ->label('Kategori')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('tags')
                    ->label('Tag')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('published_at')
                    ->label('Diterbitkan ')
                    ->dateTime()
                    ->sortable(),
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
            'index' => Pages\ListPostArticles::route('/'),
            'create' => Pages\CreatePostArticle::route('/create'),
            'view' => Pages\ViewPostArticle::route('/{record}'),
            'edit' => Pages\EditPostArticle::route('/{record}/edit'),
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
