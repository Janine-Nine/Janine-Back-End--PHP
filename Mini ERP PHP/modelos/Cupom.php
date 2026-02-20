<?php
// Model Cupom: utiliza global $pdo para acesso ao banco de dados.
class Cupom {
    public static function all() {
        global $pdo;
        try {
            $stmt = $pdo->query("SELECT * FROM cupons");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

    public static function find($id) {
        global $pdo;
        try {
            $stmt = $pdo->prepare("SELECT * FROM cupons WHERE id = ?");
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return null;
        }
    }

    public static function create($codigo, $desconto, $validade, $minimo) {
        global $pdo;
        if (!$codigo || !$desconto || !$validade || !$minimo) return false;
        try {
            $stmt = $pdo->prepare("INSERT INTO cupons (codigo, desconto, validade, minimo) VALUES (?, ?, ?, ?)");
            $stmt->execute([$codigo, $desconto, $validade, $minimo]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public static function update($id, $codigo, $desconto, $validade, $minimo) {
        global $pdo;
        if (!$id || !$codigo || !$desconto || !$validade || !$minimo) return false;
        try {
            $stmt = $pdo->prepare("UPDATE cupons SET codigo=?, desconto=?, validade=?, minimo=? WHERE id=?");
            $stmt->execute([$codigo, $desconto, $validade, $minimo, $id]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public static function delete($id) {
        global $pdo;
        try {
            $stmt = $pdo->prepare("DELETE FROM cupons WHERE id=?");
            $stmt->execute([$id]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}