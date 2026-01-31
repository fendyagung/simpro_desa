<?php

use App\Models\Desa;
use Illuminate\Support\Facades\DB;

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Check for exact name duplicates across Desa only
$duplicates = Desa::where('jenis', 'desa')
    ->select('nama_desa', DB::raw('count(*) as total'))
    ->groupBy('nama_desa')
    ->having('total', '>', 1)
    ->get();

echo "--- Duplicate Desa Names ---\n";
foreach ($duplicates as $d) {
    echo "{$d->nama_desa}\n";
    $records = Desa::where('nama_desa', $d->nama_desa)->get();
    foreach ($records as $r) {
        echo " - ID: {$r->id} | Kec: {$r->kecamatan} | Jenis: {$r->jenis}\n";
    }
}
