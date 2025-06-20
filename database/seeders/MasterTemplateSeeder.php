<?php

namespace Database\Seeders;

use App\Models\MasterTemplate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MasterTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MasterTemplate::insert([
            [
                "detail_progress" => json_encode([
                    [
                        "indikator" => "Profil Desa",
                        "detail" => [
                            ["nama" => "Visi Misi Desa"],
                            ["nama" => "Sejarah Desa"],
                            ["nama" => "Struktur Pemerintahan Desa"],
                            ["nama" => "Produk Hukum Desa"],
                        ],
                    ],
                    [
                        "indikator" => "Ketersediaan Data Penduduk",
                        "detail" => [
                            ["nama" => "Data Penduduk Terupdate"],
                            ["nama" => "Data Penduduk Terorganisir"],
                            ["nama" => "Data Penduduk Berkualitas Bagus"],
                        ],
                    ],
                ]),
            ],
        ]);
    }
}
