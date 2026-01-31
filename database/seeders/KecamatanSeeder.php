<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KecamatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kecamatans = [
            'Borong',
            'Kota Komba',
            'Kota Komba Utara',
            'Lamba Leda',
            'Lamba Leda Selatan',
            'Lamba Leda Utara',
            'Poco Ranaka',
            'Poco Ranaka Timur',
            'Rana Mese',
            'Sambi Rampas',
            'Elar',
            'Elar Selatan',
        ];

        foreach ($kecamatans as $kecamatan) {
            DB::table('kecamatans')->updateOrInsert(
                ['nama' => $kecamatan],
                ['created_at' => now(), 'updated_at' => now()]
            );
        }
    }
}
