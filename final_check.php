<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$profile = \App\Models\DpmdProfile::first();
if ($profile) {
    if (str_contains($profile->sambutan_teks, 'Nusa Bunga')) {
        echo "RESULT: STILL_FOUND\n";
        // Final attempt to fix it if found
        $profile->sambutan_teks = str_replace('bumi Nusa Bunga', 'Kabupaten Manggarai Timur', $profile->sambutan_teks);
        $profile->save();
        echo "FIX_APPLIED: " . $profile->sambutan_teks;
    } else {
        echo "RESULT: CLEAN\n";
    }
} else {
    echo "No profile found.";
}
