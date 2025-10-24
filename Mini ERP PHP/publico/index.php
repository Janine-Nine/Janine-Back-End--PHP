<?php
require_once __DIR__ . '/../config/app.php';

echo 'Mini ERP';

$controller = isset($_GET['c']) ? preg_replace('/[^a-zA-Z0-9_]/', '', $_GET['c']) : 'produto';
$action = isset($_GET['a']) ? preg_replace('/[^a-zA-Z0-9_]/', '', $_GET['a']) : 'index';

$controllerName = ucfirst($controller) . 'Controller';
$controllerFile = __DIR__ . '/../controllers/' . $controllerName . '.php';

if (!file_exists($controllerFile)) {
    die('Controller não encontrado.');
}

require_once $controllerFile;

if (!class_exists($controllerName)) {
    die('Classe do controller não encontrada.');
}

$ctrl = new $controllerName();
if (!method_exists($ctrl, $action)) {
    die('Ação não encontrada.');
}
$ctrl->$action();