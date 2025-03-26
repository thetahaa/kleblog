<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CommentResource\Pages;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User; 
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\DateColumn;

class CommentResource extends Resource
{
    protected static ?string $model = Comment::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-ellipsis';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->label('Kullanıcı')
                    ->options(User::pluck('name', 'id'))
                    ->searchable()
                    ->required(),
                Forms\Components\Textarea::make('content')
                    ->label('İçerik')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Select::make('post_id')
                    ->label('Gönderi')
                    ->options(Post::pluck('title', 'id'))
                    ->searchable()
                    ->required(),
                Forms\Components\Toggle::make('status')
                    ->label('Aktiflik')
                    ->required()
                    ->onColor('success')
                    ->offColor('danger'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('content')
                    ->label('Yorum')
                    ->limit(35)
                    ->searchable(),
                    
                TextColumn::make('post.title')
                    ->label('Gönderi')
                    ->sortable(),
                    
                TextColumn::make('user.name')
                    ->label('Kullanıcı')
                    ->sortable(),
                
                Tables\Columns\BooleanColumn::make('status')->label('Aktiflik'),
                
                TextColumn::make('created_at')
                    ->label('Oluşturulma Tarihi')
                    ->date('d.m.Y H:i')
                    ->sortable(),
            ])

            ->filters([
                // Filtreler buraya
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListComments::route('/'),
            'create' => Pages\CreateComment::route('/create'),
            'edit' => Pages\EditComment::route('/{record}/edit'),
        ];
    }
}   