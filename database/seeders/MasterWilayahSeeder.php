<?php

namespace Database\Seeders;

use App\Models\MasterDeskel;
use App\Models\MasterKecamatan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MasterWilayahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MasterKecamatan::insert([
            ["kecamatan" => "Sekongkang", "wilkerstat_kecamatan_id" => "5207010"],
            ["kecamatan" => "Jereweh", "wilkerstat_kecamatan_id" => "5207020"],
            ["kecamatan" => "Maluk", "wilkerstat_kecamatan_id" => "5207021"],
            ["kecamatan" => "Taliwang", "wilkerstat_kecamatan_id" => "5207030"],
            ["kecamatan" => "Brang Ene", "wilkerstat_kecamatan_id" => "5207031"],
            ["kecamatan" => "Brang Rea", "wilkerstat_kecamatan_id" => "5207040"],
            ["kecamatan" => "Seteluk", "wilkerstat_kecamatan_id" => "5207050"],
            ["kecamatan" => "Poto Tano", "wilkerstat_kecamatan_id" => "5207051"],
        ]);

        MasterDeskel::insert([
            ["desa_kelurahan" => "Sekongkang Bawah", "wilkerstat_kecamatan_id" => "5207010", "desa_id" => "001"],
            ["desa_kelurahan" => "Sekongkang Atas", "wilkerstat_kecamatan_id" => "5207010", "desa_id" => "002"],
            ["desa_kelurahan" => "Tongo", "wilkerstat_kecamatan_id" => "5207010", "desa_id" => "003"],
            ["desa_kelurahan" => "Ai Kangkung", "wilkerstat_kecamatan_id" => "5207010", "desa_id" => "004"],
            ["desa_kelurahan" => "Tatar", "wilkerstat_kecamatan_id" => "5207010", "desa_id" => "005"],
            ["desa_kelurahan" => "Talonang Baru", "wilkerstat_kecamatan_id" => "5207010", "desa_id" => "006"],
            ["desa_kelurahan" => "Kemuning", "wilkerstat_kecamatan_id" => "5207010", "desa_id" => "007"],
            ["desa_kelurahan" => "Belo", "wilkerstat_kecamatan_id" => "5207020", "desa_id" => "002"],
            ["desa_kelurahan" => "Goa", "wilkerstat_kecamatan_id" => "5207020", "desa_id" => "004"],
            ["desa_kelurahan" => "Beru", "wilkerstat_kecamatan_id" => "5207020", "desa_id" => "005"],
            ["desa_kelurahan" => "Dasan Anyar", "wilkerstat_kecamatan_id" => "5207020", "desa_id" => "006"],
            ["desa_kelurahan" => "Maluk", "wilkerstat_kecamatan_id" => "5207021", "desa_id" => "001"],
            ["desa_kelurahan" => "Benete", "wilkerstat_kecamatan_id" => "5207021", "desa_id" => "002"],
            ["desa_kelurahan" => "Bukit Damai", "wilkerstat_kecamatan_id" => "5207021", "desa_id" => "003"],
            ["desa_kelurahan" => "Mantun", "wilkerstat_kecamatan_id" => "5207021", "desa_id" => "004"],
            ["desa_kelurahan" => "Pasir Putih", "wilkerstat_kecamatan_id" => "5207021", "desa_id" => "005"],
            ["desa_kelurahan" => "Lalar Liang", "wilkerstat_kecamatan_id" => "5207030", "desa_id" => "003"],
            ["desa_kelurahan" => "Labuan Lalar", "wilkerstat_kecamatan_id" => "5207030", "desa_id" => "004"],
            ["desa_kelurahan" => "Kuang", "wilkerstat_kecamatan_id" => "5207030", "desa_id" => "005"],
            ["desa_kelurahan" => "Labuan Kertasari", "wilkerstat_kecamatan_id" => "5207030", "desa_id" => "006"],
            ["desa_kelurahan" => "Bugis", "wilkerstat_kecamatan_id" => "5207030", "desa_id" => "007"],
            ["desa_kelurahan" => "Dalam", "wilkerstat_kecamatan_id" => "5207030", "desa_id" => "008"],
            ["desa_kelurahan" => "Menala", "wilkerstat_kecamatan_id" => "5207030", "desa_id" => "009"],
            ["desa_kelurahan" => "Sampir", "wilkerstat_kecamatan_id" => "5207030", "desa_id" => "010"],
            ["desa_kelurahan" => "Seloto", "wilkerstat_kecamatan_id" => "5207030", "desa_id" => "011"],
            ["desa_kelurahan" => "Tamekan", "wilkerstat_kecamatan_id" => "5207030", "desa_id" => "012"],
            ["desa_kelurahan" => "Banjar", "wilkerstat_kecamatan_id" => "5207030", "desa_id" => "013"],
            ["desa_kelurahan" => "Batu Putih", "wilkerstat_kecamatan_id" => "5207030", "desa_id" => "014"],
            ["desa_kelurahan" => "Telaga Bertong", "wilkerstat_kecamatan_id" => "5207030", "desa_id" => "015"],
            ["desa_kelurahan" => "Sermong", "wilkerstat_kecamatan_id" => "5207030", "desa_id" => "016"],
            ["desa_kelurahan" => "Arab Kenangan", "wilkerstat_kecamatan_id" => "5207030", "desa_id" => "017"],
            ["desa_kelurahan" => "Lamunga", "wilkerstat_kecamatan_id" => "5207030", "desa_id" => "018"],
            ["desa_kelurahan" => "Kalimantong", "wilkerstat_kecamatan_id" => "5207031", "desa_id" => "001"],
            ["desa_kelurahan" => "Mura", "wilkerstat_kecamatan_id" => "5207031", "desa_id" => "002"],
            ["desa_kelurahan" => "Lampok", "wilkerstat_kecamatan_id" => "5207031", "desa_id" => "003"],
            ["desa_kelurahan" => "Manemeng", "wilkerstat_kecamatan_id" => "5207031", "desa_id" => "004"],
            ["desa_kelurahan" => "Mujahiddin", "wilkerstat_kecamatan_id" => "5207031", "desa_id" => "005"],
            ["desa_kelurahan" => "Mataiyang", "wilkerstat_kecamatan_id" => "5207031", "desa_id" => "006"],
            ["desa_kelurahan" => "Sapugara Bree", "wilkerstat_kecamatan_id" => "5207040", "desa_id" => "001"],
            ["desa_kelurahan" => "Desa Beru", "wilkerstat_kecamatan_id" => "5207040", "desa_id" => "002"],
            ["desa_kelurahan" => "Tepas", "wilkerstat_kecamatan_id" => "5207040", "desa_id" => "003"],
            ["desa_kelurahan" => "Bangkat Monteh", "wilkerstat_kecamatan_id" => "5207040", "desa_id" => "004"],
            ["desa_kelurahan" => "Seminar Salit", "wilkerstat_kecamatan_id" => "5207040", "desa_id" => "005"],
            ["desa_kelurahan" => "Tepas Sepakat", "wilkerstat_kecamatan_id" => "5207040", "desa_id" => "006"],
            ["desa_kelurahan" => "Moteng", "wilkerstat_kecamatan_id" => "5207040", "desa_id" => "007"],
            ["desa_kelurahan" => "Lamuntet", "wilkerstat_kecamatan_id" => "5207040", "desa_id" => "008"],
            ["desa_kelurahan" => "Rarak Rongis", "wilkerstat_kecamatan_id" => "5207040", "desa_id" => "009"],
            ["desa_kelurahan" => "Kelanir", "wilkerstat_kecamatan_id" => "5207050", "desa_id" => "002"],
            ["desa_kelurahan" => "Meraran", "wilkerstat_kecamatan_id" => "5207050", "desa_id" => "003"],
            ["desa_kelurahan" => "Air Suning", "wilkerstat_kecamatan_id" => "5207050", "desa_id" => "004"],
            ["desa_kelurahan" => "Rempe", "wilkerstat_kecamatan_id" => "5207050", "desa_id" => "005"],
            ["desa_kelurahan" => "Tapir", "wilkerstat_kecamatan_id" => "5207050", "desa_id" => "006"],
            ["desa_kelurahan" => "Seteluk Atas", "wilkerstat_kecamatan_id" => "5207050", "desa_id" => "007"],
            ["desa_kelurahan" => "Seteluk Tengah", "wilkerstat_kecamatan_id" => "5207050", "desa_id" => "008"],
            ["desa_kelurahan" => "Lamusung", "wilkerstat_kecamatan_id" => "5207050", "desa_id" => "009"],
            ["desa_kelurahan" => "Loka", "wilkerstat_kecamatan_id" => "5207050", "desa_id" => "010"],
            ["desa_kelurahan" => "Seran", "wilkerstat_kecamatan_id" => "5207050", "desa_id" => "011"],
            ["desa_kelurahan" => "Senayan", "wilkerstat_kecamatan_id" => "5207051", "desa_id" => "001"],
            ["desa_kelurahan" => "Mantar", "wilkerstat_kecamatan_id" => "5207051", "desa_id" => "002"],
            ["desa_kelurahan" => "Kiantar", "wilkerstat_kecamatan_id" => "5207051", "desa_id" => "003"],
            ["desa_kelurahan" => "Poto Tano", "wilkerstat_kecamatan_id" => "5207051", "desa_id" => "004"],
            ["desa_kelurahan" => "Upt Tambak Sari", "wilkerstat_kecamatan_id" => "5207051", "desa_id" => "005"],
            ["desa_kelurahan" => "Tua Nanga", "wilkerstat_kecamatan_id" => "5207051", "desa_id" => "006"],
            ["desa_kelurahan" => "Tebo", "wilkerstat_kecamatan_id" => "5207051", "desa_id" => "007"],
            ["desa_kelurahan" => "Kokar Lian", "wilkerstat_kecamatan_id" => "5207051", "desa_id" => "008"],

        ]);
    }
}
