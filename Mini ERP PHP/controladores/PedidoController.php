<?php
require_once __DIR__ . '/../models/Produto.php';
require_once __DIR__ . '/../models/Pedido.php';
require_once __DIR__ . '/../models/Cupom.php';

class PedidoController {
    public function carrinho() {
        include __DIR__ . '/../views/header.php';
        include __DIR__ . '/../views/carrinho.php';
        include __DIR__ . '/../views/footer.php';
    }

    public function adicionar() {
        $id = $_GET['id'];
        if (!isset($_SESSION['carrinho'][$id])) {
            $_SESSION['carrinho'][$id] = 1;
        } else {
            $_SESSION['carrinho'][$id]++;
        }
        header("Location: index.php?c=pedido&a=carrinho");
    }

    public function finalizar() {
        $cep = $_POST['cep'];
        $viaCep = file_get_contents("https://viacep.com.br/ws/{$cep}/json/");
        $endereco = json_decode($viaCep, true);

        $subtotal = Pedido::calcularSubtotal();
        $frete = Pedido::calcularFrete($subtotal);
        $total = $subtotal + $frete;

        Pedido::salvar($subtotal, $frete, $total, $cep, json_encode($endereco));

        $_SESSION['carrinho'] = []; // limpa carrinho
        header("Location: index.php?c=pedido&a=carrinho");
    }
}