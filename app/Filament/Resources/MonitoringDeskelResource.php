<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MonitoringDeskelResource\Pages;
use App\Filament\Resources\MonitoringDeskelResource\RelationManagers;
use App\Models\MonitoringDeskel;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;


class MonitoringDeskelResource extends Resource
{
    protected static ?string $model = MonitoringDeskel::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

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

                TextColumn::make('masterDeskel.masterKecamatan.kecamatan')
                    ->label('Nama Kecamatan')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('masterDeskel.desa_kelurahan')
                    ->label('Nama Desa/Kelurahan')
                    ->searchable()
                    ->sortable(),

                IconColumn::make('detail_progress')
                    ->label('Detail'),

                TextColumn::make('progress_persen')
                    ->label('Persentase')
                    ->searchable()
                    ->sortable(),



                // TextColumn::make('')
                //     ->label('Nama C')
                //     ->searchable()
                //     ->sortable(),

                TextColumn::make('catatan')
                    ->label('Catatan')
                    ->searchable()
                    ->sortable(),




                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ])
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
            'index' => Pages\ListMonitoringDeskels::route('/'),
            'create' => Pages\CreateMonitoringDeskel::route('/create'),
            'edit' => Pages\EditMonitoringDeskel::route('/{record}/edit'),
        ];
    }
}
