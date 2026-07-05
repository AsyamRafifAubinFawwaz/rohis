<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$organizers = \App\Models\organizer::withTrashed()->get();
foreach ($organizers as $o) {
    $o->periode = str_replace('-', '/', $o->periode);
    $o->save();
}
echo "Done";
