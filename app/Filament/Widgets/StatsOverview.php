<?php

namespace App\Filament\Widgets;

use App\Models\MasterDeskel;
use App\Models\MonitoringDeskel;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $user = Auth::user();
        $query = MonitoringDeskel::query();
        $labelWilayah = '';

        if ($user->hasRole('Kecamatan')) {
            $wilkerstatIds = $user->masterKecamatan()->pluck('master_kecamatan.wilkerstat_kecamatan_id');
            $namaKecamatans = $user->masterKecamatan()->pluck('master_kecamatan.kecamatan')->toArray();
            $labelWilayah = 'Kecamatan ' . self::implodeWithAnd($namaKecamatans);
            $query->whereHas('masterDeskel.masterKecamatan', function ($q) use ($wilkerstatIds) {
                $q->whereIn('wilkerstat_kecamatan_id', $wilkerstatIds);
            });
        }

        if ($user->hasAnyRole(['Super Admin', 'Admin', 'Kabupaten'])) {

            $labelWilayah = '';
        }

        if ($user->hasRole('Kecamatan')) {
            $wilkerstatIds = $user->masterKecamatan()->pluck('master_kecamatan.wilkerstat_kecamatan_id');
            $namaKecamatans = $user->masterKecamatan()->pluck('master_kecamatan.kecamatan')->toArray();
            $labelWilayah = 'di Kecamatan ' . self::implodeWithAnd($namaKecamatans);
            $query->whereHas('masterDeskel.masterKecamatan', function ($q) use ($wilkerstatIds) {
                $q->whereIn('wilkerstat_kecamatan_id', $wilkerstatIds);
            });
        }

        $total = $query->count();
        $average = $query->avg('progress_persen');

        $selesai = $query->where('progress_persen', '=', 100)->count();
        $belum = $total - $selesai;
        $persen = $average !== null ? number_format($average, 2) . '%' : '0%';
        return [
            Stat::make('Total Desa/Kelurahan Selesai ' . $labelWilayah, $selesai),
            Stat::make('Total Desa/Kelurahan Belum ' . $labelWilayah, $belum),

            Stat::make('Persentase Penyelesaian', $persen)
                ->chart([0, 59])
                ->color('success'),
        ];
    }

    // KHUSUS UNTUK INI
    private static function implodeWithAnd(array $items): string
    {
        $count = count($items);

        if ($count === 0) return '';
        if ($count === 1) return $items[0];
        if ($count === 2) return implode(' dan ', $items);

        $last = array_pop($items);
        return implode(', ', $items) . ' dan ' . $last;
    }
}
