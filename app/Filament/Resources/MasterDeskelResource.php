<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MasterDeskelResource\Pages;
use App\Filament\Resources\MasterDeskelResource\RelationManagers;
use App\Models\MasterDeskel;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;

class MasterDeskelResource extends Resource
{
    protected static ?string $model = MasterDeskel::class;

    protected static ?string $navigationIcon = 'heroicon-o-table-cells';
    protected static ?string $navigationLabel = 'Master Desa/Kelurahan';
    protected static ?string $navigationGroup = 'Master Wilayah';
    protected static ?int $navigationSort = 2;

    protected static ?string $slug = 'master-deskel';

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
                TextColumn::make('desa_kelurahan')
                    ->label('Nama Desa')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('wilkerstat_kecamatan_id')
                    ->label('Kode Kecamatan')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('desa_id')
                    ->label('Kode Desa')
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
            'index' => Pages\ListMasterDeskels::route('/'),
            // 'create' => Pages\CreateMasterDeskel::route('/create'),
            // 'edit' => Pages\EditMasterDeskel::route('/{record}/edit'),
        ];
    }
}
