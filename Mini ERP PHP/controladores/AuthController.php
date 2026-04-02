<?php
require_once __DIR__ . '/../modelos/Usuario.php';
require_once __DIR__ . '/../configuração/bootstrap.php';

class AuthController {

    public function login() {
        require __DIR__ . '/../visualizações/login.php';
    }

    public function autenticar() {
        $user = Usuario::autenticar($_POST['email'], $_POST['senha']);

        if ($user) {
            $_SESSION['usuario'] = $user;
            header("Location: index.php");
        } else {
            echo "Login inválido";
        }
    }

    public function logout() {
        session_destroy();
        header("Location: index.php?c=auth&a=login");
    }
}