<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $kelurahans = [
            'Borong' => ['Rana Loba', 'Kota Ndora', 'Satar Peot'],
            'Elar' => ['Tiwu Kondo'],
            'Elar Selatan' => ['Lempang Paji'],
            'Kota Komba' => ['Rongga Koe', 'Tanah Rata', 'WatuNggene'],
            'Lamba Leda Selatan' => ['Mandosawu', 'Nggalak Leleng', 'Bangka Leleng'],
            'Sambi Rampas' => ['Golo Wangkung', 'Golo Wangkung Barat', 'Golo Wangkung Utara', 'Nanga Baras', 'Pota', 'Ulung Baras'],
        ];

        foreach ($kelurahans as $kecamatan => $names) {
            foreach ($names as $name) {
                // Update or Insert the Kelurahan
                DB::table('desas')->updateOrInsert(
                    ['nama_desa' => $name],
                    [
                        'kecamatan' => $kecamatan,
                        'jenis' => 'kelurahan',
                        'updated_at' => now(),
                        'created_at' => DB::raw('IFNULL(created_at, NOW())')
                    ]
                );
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reverting would involve deleting these specific names or setting them back to 'desa'
    }
};
