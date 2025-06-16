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
use Filament\Tables\Columns\TextColumn;

class MasterKecamatanResource extends Resource
{
    protected static ?string $model = MasterKecamatan::class;

    protected static ?string $navigationIcon = 'heroicon-o-table-cells';
    protected static ?string $navigationLabel = 'Master Kecamatan';
    protected static ?string $navigationGroup = 'Master Wilayah';
    protected static ?int $navigationSort = 1;

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




                TextColumn::make('kecamatan')
                    ->label('Nama Kecamatan')
                    ->searchable()
                    ->sortable(),


                TextColumn::make('wilkerstat_kecamatan_id')
                    ->label('Kode Kecamatan')
                    ->searchable()
                    ->sortable(),

            ])
            ->filters([
                //
            ])
            ->actions([])
            ->bulkActions([])
            ->recordUrl(
                null
            );
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
