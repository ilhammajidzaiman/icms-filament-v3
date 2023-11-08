<?php

namespace App\Filament\Resources;

use stdClass;
use Filament\Tables;
use App\Models\Article;
use Filament\Forms\Set;
use App\Models\Category;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Forms\Components\DateTimePicker;
use Filament\Infolists\Components\ImageEntry;
use App\Filament\Resources\ArticleResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Infolists\Components\TextEntry\TextEntrySize;
use App\Filament\Resources\ArticleResource\RelationManagers;
use Filament\Infolists\Components\Section as InfolistsSection;
use App\Filament\Resources\ArticleResource\Widgets\ArticleOverview;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-duplicate';
    protected static ?string $navigationGroup = 'Blog';
    protected static ?string $modelLabel = 'Artikel';
    protected static ?string $navigationLabel = 'Artikel';
    protected static ?string $slug = 'artikel';
    protected static ?string $recordTitleAttribute = 'title';
    protected static ?int $navigationSort = 3;

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
                            ->dehydrated()
                            ->helperText('Slug akan otomatis dihasilkan dari judul.'),
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
                            ->default(auth()->user()->id)
                            ->disabled()
                            ->dehydrated(),
                        Hidden::make('visitor')
                            ->label('Pengunjung')
                            ->required()
                            ->default(0)
                            ->disabled()
                            ->dehydrated(),
                        Select::make('category_id')
                            ->label('Kategori')
                            ->required()
                            ->options(Category::all()->pluck('title', 'id'))
                            ->relationship(name: 'category', titleAttribute: 'title')
                            ->createOptionForm([
                                Hidden::make('user_id')
                                    ->label('Id Penulis')
                                    ->required()
                                    ->default(auth()->user()->id)
                                    ->disabled()
                                    ->dehydrated(),
                                TextInput::make('title')
                                    ->label('Judul')
                                    ->required()
                                    ->maxLength(255)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))
                                    ->unique(table: Category::class),
                                TextInput::make('slug')
                                    ->label('Slug')
                                    ->required()
                                    ->maxLength(255)
                                    ->disabled()
                                    ->dehydrated()
                                    ->helperText('Slug akan otomatis dihasilkan dari judul.'),
                            ])
                            ->editOptionForm([
                                Hidden::make('user_id')
                                    ->label('Id Penulis')
                                    ->required()
                                    ->default(auth()->user()->id)
                                    ->disabled()
                                    ->dehydrated(),
                                TextInput::make('title')
                                    ->label('Judul')
                                    ->required()
                                    ->maxLength(255)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))
                                    ->unique(table: Category::class),
                                TextInput::make('slug')
                                    ->label('Slug')
                                    ->required()
                                    ->maxLength(255)
                                    ->disabled()
                                    ->dehydrated()
                                    ->helperText('Slug akan otomatis dihasilkan dari judul.'),
                            ]),
                        // TagsInput::make('tags')
                        //     ->label('Tanda/Topik')
                        //     ->required()
                        //     // ->separator(',')
                        //     ->suggestions(Tag::all()->pluck('title')),
                        Select::make('tags')
                            ->label('Tanda/Topik')
                            ->required()
                            ->multiple()
                            ->relationship(
                                name: 'tags',
                                titleAttribute: 'title',
                                modifyQueryUsing: fn (Builder $query) => $query
                                    ->orderBy('title')
                                    ->where('is_active', true),
                            )
                            ->createOptionForm([
                                Hidden::make('user_id')
                                    ->label('Id Penulis')
                                    ->required()
                                    ->default(auth()->user()->id)
                                    ->disabled()
                                    ->dehydrated(),
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
                            ])
                            ->helperText('Anda bisa membuat Tanda/Topik baru jika tidak tersedia.'),
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
                ImageColumn::make('file')
                    ->label('File')
                    ->defaultImageUrl(asset('/image/default-img.svg'))
                    ->circular(),
                TextColumn::make('title')
                    ->label('Judul')
                    ->wrap()
                    ->sortable()
                    ->searchable(),
                TextColumn::make('visitor')
                    ->label('Pengunjung')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('category.title')
                    ->label('Kategori')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('tags.title')
                    ->label('Tanda/Topik')
                    ->badge()
                    ->color('success')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('user.name')
                    ->label('Penulis')
                    ->badge()
                    ->color('info')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('published_at')
                    ->label('Diterbitkan ')
                    ->dateTime()
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
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
            'view' => Pages\ViewArticle::route('/{record}'),
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
                            ->defaultImageUrl(asset('/images/default-img.svg')),
                        TextEntry::make('title')
                            ->label('Judul')
                            ->weight(FontWeight::Medium)
                            ->size(TextEntrySize::Large),
                        TextEntry::make('slug')
                            ->label('Slug')
                            ->color('gray'),
                        TextEntry::make('category.title')
                            ->label('Kategori')
                            ->color('primary'),
                        TextEntry::make('content')
                            ->label('Content')
                            ->html(),
                        TextEntry::make('tags.title')
                            ->label('Tanda/Topik')
                            ->badge()
                            ->separator(',')
                            ->size(TextEntrySize::Large),
                    ]),
                InfolistsSection::make()
                    ->columnSpan(1)
                    ->schema([
                        IconEntry::make('is_active')
                            ->label('Status')
                            ->boolean(),
                        TextEntry::make('visitor')
                            ->label('Pengunjung'),
                        TextEntry::make('user.name')
                            ->label('Penulis')
                            ->badge(),
                        TextEntry::make('published_at')
                            ->label('Diterbitkan ')
                            ->since(),
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
