<?php
$dir = new RecursiveDirectoryIterator(__DIR__ . '/resources/views');
$ite = new RecursiveIteratorIterator($dir);
$files = new RegexIterator($ite, '/.*\.blade\.php$/', RegexIterator::GET_MATCH);

$count = 0;
foreach($files as $file) {
    $path = $file[0];
    $content = file_get_contents($path);

    $newContent = preg_replace('/onclick="setDeleteData\(\'\{\s*(\$.*?)\s*\}\'/', 'onclick="setDeleteData(\'{{ $1 }}\'', $content);
    
    if ($content !== $newContent) {
        file_put_contents($path, $newContent);
        $count++;
        echo "Fixed curly braces in: $path\n";
    }
}
echo "Total files fixed: $count\n";
