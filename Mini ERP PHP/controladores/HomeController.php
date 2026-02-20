<?php
require_once __DIR__ . '/../modelos/Dashboard.php';

class HomeController {

    public function index() {
        $totalVendas = Dashboard::totalVendas();
        $totalPedidos = Dashboard::totalPedidos();
        $totalProdutos = Dashboard::totalProdutos();

        require __DIR__ . '/../visualizações/dashboard.php';
    }
}