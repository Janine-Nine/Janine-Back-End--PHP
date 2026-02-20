<?php
require_once __DIR__ . '/../configuração/db.php';

class Produto {

    public static function listar() {
        return DB::conectar()
            ->query("SELECT * FROM produtos")
            ->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function buscar($id) {
        $stmt = DB::conectar()->prepare("SELECT * FROM produtos WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function reduzirEstoque($id, $qtd) {
        $stmt = DB::conectar()->prepare(
            "UPDATE produtos SET estoque = estoque - ? WHERE id = ?"
        );
        $stmt->execute([$qtd, $id]);
    }
}