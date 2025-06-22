<?php

namespace Database\Seeders;

use App\Models\MasterDeskel;
use App\Models\MonitoringDeskel;
use Illuminate\Database\Seeder;

class ProgresDesaSeederV2 extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $desaList = MasterDeskel::all();

        foreach ($desaList as $desa) {
            // Template indikator tetap
            $indikatorList = [
                [
                    'indikator' => 'Profil Desa',
                    'detail' => [
                        ['nama' => 'Visi Misi Desa'],
                        ['nama' => 'Sejarah Desa'],
                        ['nama' => 'Struktur Pemerintahan Desa'],
                        ['nama' => 'Produk Hukum Desa'],
                    ],
                ],
                [
                    'indikator' => 'Ketersediaan Data Penduduk',
                    'detail' => [
                        ['nama' => 'Data Penduduk Terupdate'],
                        ['nama' => 'Data Penduduk Berkualitas Bagus'],
                        ['nama' => 'Lorem'],
                    ],
                ],
            ];

            // Tambahkan nilai acak dan hitung rata-rata tiap indikator
            $finalDetailProgress = collect($indikatorList)->map(function ($indikator) {
                $detail = collect($indikator['detail'])->map(function ($d) {
                    $nilai = rand(0, 100);
                    return [
                        'nama' => $d['nama'],
                        'nilai' => $nilai,
                    ];
                })->toArray();

                $avg = collect($detail)->pluck('nilai')->avg();

                return [
                    'indikator' => $indikator['indikator'],
                    'detail' => $detail,
                    'nilai' => round($avg, 2),
                ];
            });

            $progressPersen = $finalDetailProgress->pluck('nilai')->avg();

            MonitoringDeskel::create([
                'master_deskel_id' => $desa->id,
                'progress_persen' => round($progressPersen, 2),
                'detail_progress' => $finalDetailProgress,
                'catatan' => $progressPersen < 50 ? 'Perlu intervensi' : ($progressPersen < 75 ? 'Perlu percepatan' : 'Berjalan baik'),
            ]);
        }
    }
}
