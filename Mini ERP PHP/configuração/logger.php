<?php
// Logger com rotação por tamanho em ./logs/app.log
function configuração_logs_dir() {
    $dir = __DIR__ . '/../logs';
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
    return $dir;
}

function configuração_rotate_logs($file, $maxBytes = 5242880, $maxFiles = 7) {
    if (!file_exists($file)) return;
    clearstatcache(true, $file);
    $size = filesize($file);
    if ($size === false) return;
    if ($size < $maxBytes) return;

    // Rotacionar: renomear com timestamp
    $dir = dirname($file);
    $timestamp = date('Ymd_His');
    $rotated = $dir . '/app_' . $timestamp . '.log';
    @rename($file, $rotated);

    // Remover arquivos antigos além do limite
    $files = glob($dir . '/app_*.log');
    usort($files, function($a, $b){ return filemtime($b) - filemtime($a); });
    if (count($files) > $maxFiles) {
        $old = array_slice($files, $maxFiles);
        foreach ($old as $f) {
            @unlink($f);
        }
    }
}

function log_error($message, $maxBytes = 5242880, $maxFiles = 7) {
    $dir = configuração_logs_dir();
    $file = $dir . '/app.log';

    // Rotacionar se necessário
    configuração_rotate_logs($file, $maxBytes, $maxFiles);

    $line = date('Y-m-d H:i:s') . " ERROR: " . trim($message) . PHP_EOL;
    file_put_contents($file, $line, FILE_APPEND | LOCK_EX);

    // Ajustar permissões (não garante em Windows, mas tenta)
    @chmod($file, 0644);
}

?>
?>
