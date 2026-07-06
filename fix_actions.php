<?php
$dir = new RecursiveDirectoryIterator(__DIR__ . '/resources/views');
$ite = new RecursiveIteratorIterator($dir);
$files = new RegexIterator($ite, '/.*\.blade\.php$/', RegexIterator::GET_MATCH);

$count = 0;
foreach($files as $file) {
    $path = $file[0];
    $content = file_get_contents($path);
    $newContent = preg_replace('/form\.action\s*=\s*(.*?);/s', 'form.setAttribute(\'action\', $1);', $content);
    if ($content !== $newContent) {
        file_put_contents($path, $newContent);
        $count++;
        echo "Updated: $path\n";
    }
}
echo "Total files updated: $count\n";
