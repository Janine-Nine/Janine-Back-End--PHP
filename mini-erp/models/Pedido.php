<?php
class Pedido {
    public static function calcularSubtotal() {
        global $pdo;
        $total = 0;
        try {
            foreach ($_SESSION['carrinho'] as $id => $qtd) {
                $stmt = $pdo->prepare("SELECT preco FROM produtos WHERE id = ?");
                $stmt->execute([$id]);
                $preco = $stmt->fetchColumn();
                $total += $preco * $qtd;
            }
            return $total;
        } catch (PDOException $e) {
            return 0;
        }
    }

    public static function calcularFrete($subtotal) {
        if ($subtotal > 200) return 0;
        if ($subtotal >= 52 && $subtotal <= 166.59) return 15;
        return 20;
    }

    public static function salvar($subtotal, $frete, $total, $cep, $endereco) {
        global $pdo;
        try {
            $stmt = $pdo->prepare("INSERT INTO pedidos (subtotal, frete, total, status, cep, endereco) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$subtotal, $frete, $total, 'pendente', $cep, $endereco]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}
    

