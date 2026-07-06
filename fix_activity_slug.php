<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

App\Models\Activities::all()->each(function($a) { 
    $a->slug = \Illuminate\Support\Str::slug($a->title); 
    $a->save(); 
});
echo "Done";
