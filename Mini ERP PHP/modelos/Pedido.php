<?php
require_once __DIR__ . '/../configuração/db.php';
require_once __DIR__ . '/Produto.php';

class Pedido {

    public static function criar($carrinho, $descontoPercent) {

        $conn = DB::conectar();
        $conn->beginTransaction();

        $subtotal = 0;
        foreach ($carrinho as $id => $qtd) {
            $produto = Produto::buscar($id);
            $subtotal += $produto['preco'] * $qtd;
        }

        $desconto = ($subtotal * $descontoPercent) / 100;
        $total = $subtotal - $desconto;

        $stmt = $conn->prepare(
            "INSERT INTO pedidos (subtotal, desconto, total)
             VALUES (?, ?, ?)"
        );
        $stmt->execute([$subtotal, $desconto, $total]);
        $pedidoId = $conn->lastInsertId();

        foreach ($carrinho as $id => $qtd) {
            $produto = Produto::buscar($id);

            $stmt = $conn->prepare(
                "INSERT INTO pedido_itens
                (pedido_id, produto_id, quantidade, preco)
                VALUES (?, ?, ?, ?)"
            );
            $stmt->execute([$pedidoId, $id, $qtd, $produto['preco']]);

            Produto::reduzirEstoque($id, $qtd);
        }

        $conn->commit();
        return $pedidoId;
    }
}