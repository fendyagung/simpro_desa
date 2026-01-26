<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Desa;
use Illuminate\Support\Facades\DB;

echo "Total Desas in DB: " . Desa::count() . "\n";

$duplicates = DB::table('desas')
    ->select('nama_desa', DB::raw('count(*) as total'))
    ->groupBy('nama_desa')
    ->having('total', '>', 1)
    ->get();

if ($duplicates->isEmpty()) {
    echo "No duplicates found by name.\n";
} else {
    echo "Duplicates found:\n";
    foreach ($duplicates as $dup) {
        echo "- {$dup->nama_desa}: {$dup->total} times\n";
    }
}

$sample = Desa::take(5)->get();
echo "\nSample Data:\n";
foreach ($sample as $s) {
    echo "- ID: {$s->id}, Name: {$s->nama_desa}, Kecamatan: {$s->kecamatan}\n";
}
