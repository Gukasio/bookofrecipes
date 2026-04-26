<?php
function write_log($login, $action) {
    $dir = __DIR__ . '/logs'; 
    
    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
    }
    
    $file = $dir . '/auth.log';
    $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
    $time = date('Y-m-d H:i:s');
    
    $line = "$time | ip=$ip | login=$login | action=$action" . PHP_EOL;
    
    file_put_contents($file, $line, FILE_APPEND);
}
?>