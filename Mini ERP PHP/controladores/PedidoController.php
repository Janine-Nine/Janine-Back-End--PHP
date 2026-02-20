<?php
require_once __DIR__ . '/../modelos/Pedido.php';
require_once __DIR__ . '/../modelos/Cupom.php';
require_once __DIR__ . '/../configuração/bootstrap.php';

class PedidoController {

    public function adicionar() {
        $id = $_GET['id'];
        $_SESSION['carrinho'][$id] =
            ($_SESSION['carrinho'][$id] ?? 0) + 1;

        header("Location: index.php");
    }

    public function carrinho() {
        require __DIR__ . '/../visualizações/carrinho.php';
    }

    public function aplicarCupom() {
        $cupom = Cupom::validar($_POST['codigo']);
        if ($cupom) {
            $_SESSION['desconto'] = $cupom['desconto'];
        }
        header("Location: index.php?c=pedido&a=carrinho");
    }

    public function finalizar() {
        $carrinho = $_SESSION['carrinho'] ?? [];
        $desconto = $_SESSION['desconto'] ?? 0;

        if (!$carrinho) {
            flash_set('erro', 'Carrinho vazio');
            header("Location: index.php?c=pedido&a=carrinho");
            exit;
        }

        $pedidoId = Pedido::criar($carrinho, $desconto);

        unset($_SESSION['carrinho']);
        unset($_SESSION['desconto']);

        require __DIR__ . '/../visualizações/pedido_sucesso.php';
    }
}