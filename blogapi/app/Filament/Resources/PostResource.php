<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\SelectFilter;


class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-plus-circle';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Başlık')
                    ->required()
                    ->maxLength(255),
                
                Forms\Components\Textarea::make('content')
                    ->label('İçerik')
                    ->required()
                    ->maxLength(10000),
                Forms\Components\FileUpload::make('image')
                    ->label('Resim')
                    ->image()
                    ->required(),
                Forms\Components\MultiSelect::make('categories')
                    ->relationship('categories', 'name')
                    ->preload()
                    ->label('Kategoriler'),

                Forms\Components\Toggle::make('status')
                    ->label('Aktiflik')
                    ->required()
                    ->onColor('success')
                    ->offColor('danger'),

                Forms\Components\MultiSelect::make('tags')
                    ->relationship('tags', 'name')
                    ->preload()
                    ->label('Etiketler'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->label('Başlık'),
                Tables\Columns\TextColumn::make('categories.name')->label('Kategoriler'),
                Tables\Columns\TextColumn::make('tags.name')->label('Etiketler'),
                Tables\Columns\ImageColumn::make('image')
                    ->label('Resim')
                    ->disk('public')
                    ->height(60),
                Tables\Columns\BooleanColumn::make('status')->label('Aktiflik'),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('siralama')
                ->label('Sıralama')
                ->options([
                    'yeni' => 'En Yeniler',
                    'populer' => 'En Popüler',
                ])
                ->default('yeni')
                ->query(function (Builder $query, array $data) {
                    $query->when(
                        $data['value'] === 'populer',
                        function (Builder $query) {
                            $query->withCount(['comments' => function ($query) {
                                $query->where('status', true);
                            }])
                            ->orderBy('comments_count', 'desc');
                        },
                        function (Builder $query) {
                            $query->latest();
                        }
                    );
                })
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                    Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}