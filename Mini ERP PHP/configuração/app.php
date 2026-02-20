<?php
// Ler configuração a partir de variáveis de ambiente, com valores padrão
$dbHost = getenv('DB_HOST') !== false ? getenv('DB_HOST') : 'localhost';
$dbName = getenv('DB_NAME') !== false ? getenv('DB_NAME') : 'mini_erp';
$dbUser = getenv('DB_USER') !== false ? getenv('DB_USER') : 'root';
$dbPass = getenv('DB_PASS') !== false ? getenv('DB_PASS') : '';

define('DB_HOST', $dbHost);
define('DB_NAME', $dbName);
define('DB_USER', $dbUser);
define('DB_PASS', $dbPass);

// Conexão PDO
try {
    $dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8mb4";
    $pdo = new PDO($dsn, DB_USER, DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (PDOException $e) {
    // registrar em arquivo via logger e retornar mensagem genérica
    if (file_exists(__DIR__ . '/logger.php')) {
        require_once __DIR__ . '/logger.php';
        log_error('DB connection error: ' . $e->getMessage());
    } else {
        error_log('DB connection error: ' . $e->getMessage());
    }
    http_response_code(500);
    echo 'Erro de conexão. Contate o administrador.';
    exit;
}