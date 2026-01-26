<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Desa;
use App\Models\Laporan;
use Illuminate\Support\Facades\DB;

echo "Starting cleanup...\n";

// 1. Backup laporan data with village names
$laporans = Laporan::with('desa')->get()->map(function ($l) {
    return [
        'laporan_data' => $l->getAttributes(),
        'old_desa_nama' => $l->desa ? $l->desa->nama_desa : null,
        'old_desa_kecamatan' => $l->desa ? $l->desa->kecamatan : null,
    ];
});

echo "Backed up " . count($laporans) . " reports.\n";

// 2. Clear tables (Disable FK checks for safety during mass delete)
DB::statement('SET FOREIGN_KEY_CHECKS=0;');
Laporan::truncate();
Desa::truncate();
DB::statement('SET FOREIGN_KEY_CHECKS=1;');

echo "Tables truncated.\n";

// 3. Run updated seeder
$seeder = new \Database\Seeders\DaftarDesaSeeder();
$seeder->run();

echo "Seeder finished. Total Villages: " . Desa::count() . "\n";

// 4. Restore reports and link to new village IDs
foreach ($laporans as $item) {
    $data = $item['laporan_data'];
    unset($data['id']); // Let DB auto-increment

    if ($item['old_desa_nama']) {
        // Try to find the new ID based on name and kecamatan
        $newDesa = Desa::where('nama_desa', $item['old_desa_nama'])
            ->where('kecamatan', $item['old_desa_kecamatan'])
            ->first();

        if ($newDesa) {
            $data['desa_id'] = $newDesa->id;
            echo "Re-linking report '{$data['judul']}' to {$newDesa->nama_desa}\n";
        } else {
            echo "Warning: Could not find new village for report '{$data['judul']}' ({$item['old_desa_nama']})\n";
        }
    }

    Laporan::create($data);
}

echo "Cleanup successfully completed!\n";
