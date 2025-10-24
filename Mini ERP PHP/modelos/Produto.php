<?php
class Produto {
    public static function all() {
        global $pdo;
        try {
            $stmt = $pdo->query("SELECT * FROM produtos");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

    public static function create($nome, $preco) {
        global $pdo;
        if (!$nome || !$preco) return false;
        try {
            $stmt = $pdo->prepare("INSERT INTO produtos (nome, preco) VALUES (?, ?)");
            $stmt->execute([$nome, $preco]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}