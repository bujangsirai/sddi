<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MasterKecamatanResource\Pages;
use App\Filament\Resources\MasterKecamatanResource\RelationManagers;
use App\Models\MasterKecamatan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MasterKecamatanResource extends Resource
{
    protected static ?string $model = MasterKecamatan::class;

    protected static ?string $navigationIcon = 'heroicon-o-table-cells';
    protected static ?string $navigationLabel = 'Master Kecamatan';
    protected static ?string $navigationGroup = 'Master Wilayah';

    protected static ?string $slug = 'master-kecamatan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListMasterKecamatans::route('/'),
            'create' => Pages\CreateMasterKecamatan::route('/create'),
            'edit' => Pages\EditMasterKecamatan::route('/{record}/edit'),
        ];
    }
}
