<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// Update existing organizer periods to use '-' instead of '/'
$count = 0;
App\Models\organizer::withTrashed()->get()->each(function ($org) use (&$count) {
    if (strpos($org->periode, '/') !== false) {
        $org->periode = str_replace('/', '-', $org->periode);
        $org->save();
        $count++;
    }
});

echo "Fixed $count organizer periods.\n";
