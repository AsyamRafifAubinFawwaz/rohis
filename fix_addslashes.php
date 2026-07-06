<?php
$dir = new RecursiveDirectoryIterator(__DIR__ . '/resources/views');
$ite = new RecursiveIteratorIterator($dir);
$files = new RegexIterator($ite, '/.*\.blade\.php$/', RegexIterator::GET_MATCH);

$count = 0;
foreach($files as $file) {
    $path = $file[0];
    $content = file_get_contents($path);
    
    $newContent = preg_replace_callback('/onclick="setDeleteData\(\s*\'{{(.*?)}}\'\s*,\s*\'{{(.*?)}}\'(.*?)\)"/', function($matches) {
        $idStr = $matches[1];
        $titleStr = trim($matches[2]);
        $rest = $matches[3];
        
        if (strpos($titleStr, 'addslashes') === false) {
            $titleStr = ' addslashes(' . $titleStr . ') ';
        }
        
        return "onclick=\"setDeleteData('{{$idStr}}', '{{" . $titleStr . "}}'$rest)\"";
    }, $content);
    
    if ($content !== $newContent) {
        file_put_contents($path, $newContent);
        $count++;
        echo "Updated setDeleteData in: $path\n";
    }
}
echo "Total files updated: $count\n";
