<?php
class CupomController {
    public function index() {
        $cupons = Cupom::all();
        include __DIR__ . '/../views/header.php';
        include __DIR__ . '/../views/cupom.php';
        include __DIR__ . '/../views/footer.php';
    }

    public function create() {
        include __DIR__ . '/../views/header.php';
        include __DIR__ . '/../views/cupons_form.php';
        include __DIR__ . '/../views/footer.php';
    }

    public function store() {
        Cupom::create($_POST['codigo'], $_POST['desconto'], $_POST['validade'], $_POST['minimo']);
        header("Location: index.php?c=cupom&a=index");
    }

    public function edit() {
        $cupom = Cupom::find($_GET['id']);
        include __DIR__ . '/../views/header.php';
        include __DIR__ . '/../views/cupons_form.php';
        include __DIR__ . '/../views/footer.php';
    }

    public function update() {
        Cupom::update($_POST['id'], $_POST['codigo'], $_POST['desconto'], $_POST['validade'], $_POST['minimo']);
        header("Location: index.php?c=cupom&a=index");
    }

    public function delete() {
        Cupom::delete($_GET['id']);
        header("Location: index.php?c=cupom&a=index");
    }
}