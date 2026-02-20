<?php
class DB {
    public static function conectar() {
        return new PDO(
            "mysql:host=localhost;dbname=mini_erp;charset=utf8",
            "root",
            "",
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
    }
}