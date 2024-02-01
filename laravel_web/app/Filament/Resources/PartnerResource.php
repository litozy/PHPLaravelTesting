<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PartnerResource\Pages;
use App\Filament\Resources\PartnerResource\RelationManagers;
use App\Models\Partner;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Storage;

class PartnerResource extends Resource
{
    protected static ?string $model = Partner::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-list';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                    FileUpload::make('thumbnail') //ini untuk file upload
                    ->required()
                    ->image()
                    ->disk('public'),
                    RichEditor::make('content')
                    ->required(),
                    TextInput::make('link')
                    ->required()
                    ->maxLength(255)
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                ->sortable() // agar bisa disort
                ->searchable(), // ada input search untuk mencari
                ImageColumn::make('thumbnail'),
                TextColumn::make('link')
                ->sortable()
                ->searchable(),
                TextColumn::make('created_at')
                ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()->after(function (Collection $records) {
                    foreach ($records as $key => $value) {
                        if ($value->thumbnail) {
                            Storage::disk('public')->delete($value->thumbnail);
                        }
                    }
                }),
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
            'index' => Pages\ListPartners::route('/'),
            'create' => Pages\CreatePartner::route('/create'),
            'edit' => Pages\EditPartner::route('/{record}/edit'),
        ];
    }    
}
