<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'mini_erp');
define('DB_USER', 'root');
define('DB_PASS', '');

// Conexão PDO
try {
    $pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}