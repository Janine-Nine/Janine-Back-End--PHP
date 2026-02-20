<?php
require_once '../modelos/Produto.php';

header('Content-Type: application/json');

switch ($_SERVER['REQUEST_METHOD']) {

    case 'GET':
        echo json_encode(Produto::listar());
        break;

    case 'POST':
        $dados = json_decode(file_get_contents("php://input"), true);
        Produto::salvar($dados);
        echo json_encode(["status" => "Produto criado"]);
        break;

    default:
        http_response_code(405);
}