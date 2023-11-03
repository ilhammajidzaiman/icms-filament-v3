<?php

namespace App\Filament\Resources\NavMenuResource\Widgets;

use App\Models\Page;
use App\Models\Article;
use App\Models\NavMenu;
use Filament\Forms\Set;
use Illuminate\Support\Str;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Components\MorphToSelect;
use SolutionForest\FilamentTree\Actions\Action;
use SolutionForest\FilamentTree\Actions\EditAction;
use SolutionForest\FilamentTree\Actions\ViewAction;
use SolutionForest\FilamentTree\Actions\ActionGroup;
use SolutionForest\FilamentTree\Actions\DeleteAction;
use SolutionForest\FilamentTree\Widgets\Tree as BaseWidget;

class NavMenuWidget extends BaseWidget
{
    protected static string $model = NavMenu::class;
    protected static int $maxDepth = 2;
    // protected ?string $treeTitle = 'Nav Menu';
    protected bool $enableTreeTitle = true;

    protected function getFormSchema(): array
    {
        return [
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
                        ->afterStateUpdated(fn (Set $set, ?string $state) => $set(
                            'slug',
                            Str::slug($state)
                        )),
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
        ];
    }

    // INFOLIST, CAN DELETE
    public function getViewFormSchema(): array
    {
        return [
            //
        ];
    }

    // CUSTOMIZE ICON OF EACH RECORD, CAN DELETE
    public function getTreeRecordIcon(?\Illuminate\Database\Eloquent\Model $record = null): ?string
    {
        // default null
        return 'heroicon-o-bars-3';
    }

    // CUSTOMIZE ACTION OF EACH RECORD, CAN DELETE 
    // protected function getTreeActions(): array
    // {
    //     return [
    //         Action::make('helloWorld')
    //             ->action(function () {
    //                 Notification::make()->success()->title('Hello World')->send();
    //             }),
    //         // ViewAction::make(),
    //         // EditAction::make(),
    //         ActionGroup::make([
    //             
    //             ViewAction::make(),
    //             EditAction::make(),
    //         ]),
    //         DeleteAction::make(),
    //     ];
    // }
    // OR OVERRIDE FOLLOWING METHODS
    protected function hasDeleteAction(): bool
    {
        return true;
    }
    protected function hasEditAction(): bool
    {
        return true;
    }
    protected function hasViewAction(): bool
    {
        return true;
    }
}
