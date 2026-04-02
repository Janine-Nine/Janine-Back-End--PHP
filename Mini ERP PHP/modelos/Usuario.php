<?php
require_once __DIR__ . '/../configuração/db.php';

class Usuario {

    public static function autenticar($email, $senha) {
        $stmt = DB::conectar()->prepare(
            "SELECT * FROM usuarios WHERE email = ?"
        );
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($senha, $user['senha'])) {
            return $user;
        }

        return false;
    }
}