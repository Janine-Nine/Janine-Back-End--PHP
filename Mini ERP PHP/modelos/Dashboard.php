<?php
require_once __DIR__ . '/../configuração/db.php';

class Dashboard {

    public static function totalVendas() {
        return DB::conectar()
            ->query("SELECT SUM(total) as total FROM pedidos")
            ->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;
    }

    public static function totalPedidos() {
        return DB::conectar()
            ->query("SELECT COUNT(*) as total FROM pedidos")
            ->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public static function totalProdutos() {
        return DB::conectar()
            ->query("SELECT COUNT(*) as total FROM produtos")
            ->fetch(PDO::FETCH_ASSOC)['total'];
    }
}