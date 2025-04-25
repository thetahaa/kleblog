<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Filament\Forms;
use Filament\Forms\Get;
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
                Forms\Components\Fieldset::make('Başlık & İçerik & Resim')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Başlık')
                            ->required()
                            ->columnSpan(2),
                            
                        Forms\Components\Textarea::make('content')
                            ->label('İçerik')
                            ->required()
                            ->rows(3)
                            ->columnSpan(1),

                        Forms\Components\FileUpload::make('image')
                            ->label('Resim')
                            ->image()
                            ->imagePreviewHeight(90)
                            ->columnSpan(1),
                    ])
                    ->columns(2),
                
                Forms\Components\Fieldset::make('Kategoriler ve Etiketler')
                    ->schema([
                        Forms\Components\Grid::make()
                            ->schema([
                                Select::make('categories')
                                    ->relationship('categories', 'name')
                                    ->label('Kategoriler')
                                    ->preload()
                                    ->searchable(),
                                    
                                Forms\Components\MultiSelect::make('tags')
                                    ->relationship('tags', 'name')
                                    ->label('Etiketler')
                                    ->preload()
                                    ->searchable()
                            ])
                            ->columns(2)
                    ]),

                Forms\Components\Fieldset::make('Tarih')
                    ->schema([
                        Forms\Components\DateTimePicker::make('publish_at')
                            ->label('Başlangıç Tarihi')
                            ->default(now())
                            ->seconds(false)
                            ->timezone('Europe/Istanbul')
                            ->required(),
                            
                        Forms\Components\DateTimePicker::make('expire_at')
                            ->label('Bitiş Tarihi')
                            ->seconds(false)
                            ->timezone('Europe/Istanbul')
                            ->required(),
                            
                        Forms\Components\Toggle::make('status')
                            ->label('Aktif')
                            ->onColor('success')
                            ->offColor('danger')
                            ->default(true)
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->label('Başlık'),
                Tables\Columns\TextColumn::make('categories.name')
                    ->label('Kategoriler')
                    ->badge()
                    ->color('primary'),
                Tables\Columns\TextColumn::make('tags.name')
                    ->label('Etiketler')
                    ->badge()
                    ->color('success'),
                Tables\Columns\ImageColumn::make('image')
                    ->label('Resim')
                    ->disk('public')
                    ->height(60),
                Tables\Columns\BooleanColumn::make('status')->label('Aktiflik'),

                Tables\Columns\TextColumn::make('publish_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('expire_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

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
                // SelectFilter::make('siralama')
                // ->label('Sıralama')
                // ->options([
                //     'yeni' => 'En Yeniler',
                //     'populer' => 'En Popüler',
                // ])
                // ->default('yeni')
                // ->query(function (Builder $query, array $data) {
                //     $query->when(
                //         $data['value'] === 'populer',
                //         function (Builder $query) {
                //             $query->withCount(['comments' => function ($query) {
                //                 $query->where('status', true);
                //             }])
                //             ->orderBy('comments_count', 'desc');
                //         },
                //         function (Builder $query) {
                //             $query->latest();
                //         }
                //     );
                // })
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