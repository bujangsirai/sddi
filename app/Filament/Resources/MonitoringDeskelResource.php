<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MonitoringDeskelResource\Pages;
use App\Filament\Resources\MonitoringDeskelResource\RelationManagers;
use App\Models\MonitoringDeskel;
use Filament\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\TextInput;

class MonitoringDeskelResource extends Resource
{
    protected static ?string $model = MonitoringDeskel::class;

    protected static ?string $navigationIcon = 'heroicon-o-receipt-percent';
    protected static ?string $navigationLabel = 'Input Monitoring';
    protected static ?string $navigationGroup = 'Input Monitoring';
    protected static ?int $navigationSort = 1;

    protected static ?string $slug = 'monitoring-deskel';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([


                Repeater::make('detail_progress')
                    ->label('Detail Progress')
                    ->columns(2)
                    // ->addActionLabel(function ($state) {
                    //     return $state['indikator'] ?? 'Indikator';
                    // })
                    ->schema([
                        TextInput::make('indikator')
                            ->label('Nama Indikator')
                            ->required()
                            ->disabled()
                            ->dehydrated(true),

                        TextInput::make('nilai')
                            ->label('Persentase Selesai')
                            ->required()
                            ->disabled()
                            ->numeric()
                            ->afterStateHydrated(function ($component, $state, $record, $set, $get) {
                                $detail = $get('detail') ?? [];
                                $avg = collect($detail)->pluck('nilai')->avg();
                                $set('nilai', round($avg, 2));
                            })
                            ->afterStateUpdated(function ($state, $set, $get) {
                                $detail = $get('detail') ?? [];
                                $avg = collect($detail)->pluck('nilai')->avg();
                                $set('nilai', round($avg, 2));
                            })
                            ->dehydrated(true),

                        Repeater::make('detail')
                            ->label('Detail Indikator')
                            // ->addActionLabel(function ($state) {
                            //     return $state['nama'] ?? 'Detail';
                            // })
                            ->schema([
                                TextInput::make('nama')
                                    ->label('Nama Detail')
                                    ->required()
                                    ->disabled()
                                    ->dehydrated(true),

                                TextInput::make('nilai')
                                    ->label('Persentase Selesai')
                                    ->numeric()
                                    ->required()
                                    ->afterStateUpdated(function ($state, $set, $get) {
                                        $detail = $get('../../detail') ?? [];
                                        $avg = collect($detail)->pluck('nilai')->avg();
                                        $set('../../nilai', round($avg, 2));
                                    }),
                            ])
                            ->defaultItems(0)
                            ->reorderable(false)
                            ->addable(false)
                            ->deletable(false)
                            ->columns(2)
                            ->columnSpan(2),
                    ])
                    ->defaultItems(0)
                    ->reorderable(false)
                    ->addable(false)
                    ->deletable(false)
                    ->columnSpanFull(),

                Textarea::make('catatan')
                    ->label('Catatan')
                    ->columnSpanFull(),
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

                TextColumn::make('progress_persen')
                    ->label('Persentase')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('catatan')
                    ->label('Catatan')
                    ->searchable()
                    ->sortable(),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->mutateFormDataUsing(function (array $data): array {
                        $detailProgress = $data['detail_progress'] ?? [];
                        $indikatorNilais = collect($detailProgress)->pluck('nilai')->filter(fn($n) => is_numeric($n));
                        $data['progress_persen'] = round($indikatorNilais->avg() ?? 0, 2);
                        return $data;
                    }),
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
            // 'create' => Pages\CreateMonitoringDeskel::route('/create'),
            // 'edit' => Pages\EditMonitoringDeskel::route('/{record}/edit'),
            // 'edit' => Pages\EditMonitoringDeskel::route('/{record}/edit'),
        ];
    }


    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();
        $user = Auth::user();


        // TODO PARAH DI KANTOR NI
        // dd($user->masterKecamatan->pluck('wilkerstat_kecamatan_id'));


        // DEBUG
        // $wilkerstatIds = $user->masterKecamatan->pluck('wilkerstat_kecamatan_id');
        // $results = \App\Models\MonitoringDeskel::whereHas('masterDeskel.masterKecamatan', function ($q) use ($wilkerstatIds) {
        //     $q->whereIn('wilkerstat_kecamatan_id', $wilkerstatIds);
        // })->get();
        // dd($results);

        // dd($user->hasRole('Kecamatan'));

        if ($user->hasRole('Super Admin')) {
            return $query;
        }

        // Jika role-nya kecamatan, filter berdasarkan kecamatan yang diampu
        if ($user->hasRole('Kecamatan')) {
            $wilkerstatIds = $user->masterKecamatan()->pluck('master_kecamatan.wilkerstat_kecamatan_id');
            return $query->whereHas('masterDeskel.masterKecamatan', function ($q) use ($wilkerstatIds) {
                $q->whereIn('wilkerstat_kecamatan_id', $wilkerstatIds);
            });
        }

        return $query->whereRaw('1=0');
    }
}
