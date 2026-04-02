$
<?php
require_once __DIR__ . '/../configuração/bootstrap.php';

$c = strtolower(filter_input(INPUT_GET, 'c', FILTER_SANITIZE_STRING) ?? 'produto');
$a = filter_input(INPUT_GET, 'a', FILTER_SANITIZE_STRING) ?? 'index';

$allowed = ['produto', 'pedido', 'home', 'estoque', 'cupom', 'auth', 'webhook'];
if (!in_array($c, $allowed, true)) {
    $c = 'produto';
}

if (!isset($_SESSION['usuario']) && $c !== 'auth') {
    header('Location: index.php?c=auth&a=login');
    exit;
}

$controllerFile = __DIR__ . "/../controladores/" . ucfirst($c) . "Controller.php";
if (!file_exists($controllerFile)) {
    http_response_code(404);
    echo 'Página não encontrada';
    exit;
}

require_once $controllerFile;

$controllerName = ucfirst($c) . "Controller";
$controller = new $controllerName();

if (!method_exists($controller, $a)) {
    http_response_code(404);
    echo 'Ação não encontrada';
    exit;
}

$controller->$a();