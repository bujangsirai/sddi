<?php

namespace Database\Seeders;

use App\Models\MasterDeskel;
use App\Models\MonitoringDeskel;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProgresDesaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $desaList = MasterDeskel::all();
        $kegiatanContoh = [
            'Pendataan Penduduk',
            'Validasi Data',
            'Pembangunan Jalan',
            'Program Kesehatan',
            'Penyuluhan Pertanian',
            'Bantuan Sosial'
        ];

        foreach ($desaList as $desa) {
            // Buat 3-5 kegiatan contoh per desa
            $kegiatan = [];
            $jumlahKegiatan = rand(3, 5);

            for ($i = 0; $i < $jumlahKegiatan; $i++) {
                $progress = rand(10, 100);
                $kegiatan[] = [
                    'nama' => $kegiatanContoh[array_rand($kegiatanContoh)],
                    'target' => 100,
                    'progress' => $progress,
                    'status' => $progress < 50 ? 'Terlambat' : ($progress < 80 ? 'Berjalan' : 'On Track')
                ];
            }

            // Hitung progress rata-rata
            $totalProgress = array_sum(array_column($kegiatan, 'progress')) / $jumlahKegiatan;

            MonitoringDeskel::create([
                'master_deskel_id' => $desa->id,
                'progress_persen' => round($totalProgress, 2),
                'detail_progress' => [
                    'kegiatan' => $kegiatan,
                    'last_update' => now()->format('Y-m-d'),
                    'penanggung_jawab' => 'Tim Desa ' . $desa->desa_kelurahan
                ],
                'catatan' => $totalProgress < 50 ? 'Perlu intervensi' : ($totalProgress < 75 ? 'Perlu percepatan' : 'Berjalan baik')
            ]);
        }
    }
}
