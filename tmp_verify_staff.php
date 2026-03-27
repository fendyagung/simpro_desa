<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\DpmdStaff;

$staffs = DpmdStaff::all();
foreach ($staffs as $s) {
    echo $s->nama . ' - ' . $s->jabatan . PHP_EOL;
}
