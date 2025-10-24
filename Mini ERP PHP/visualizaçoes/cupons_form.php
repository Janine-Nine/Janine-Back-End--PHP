<?php
$isEdit = isset($cupom);
?>

<h2><?= $isEdit ? 'Editar' : 'Novo' ?> Cupom</h2>

<form method="POST" action="index.php?c=cupom&a=<?= $isEdit ? 'update' : 'store' ?>">
    <?php if ($isEdit): ?>
        <input type="hidden" name="id" value="<?= $cupom['id'] ?>">
    <?php endif; ?>

    <div class="mb-3">
        <label>Código</label>
        <input type="text" name="codigo" class="form-control" value="<?= $isEdit ? $cupom['codigo'] : '' ?>" required>
    </div>

    <div class="mb-3">
        <label>Desconto (R$)</label>
        <input type="text" name="desconto" class="form-control" value="<?= $isEdit ? $cupom['desconto'] : '' ?>" required>
    </div>

    <div class="mb-3">
        <label>Validade</label>
        <input type="date" name="validade" class="form-control" value="<?= $isEdit ? $cupom['validade'] : '' ?>" required>
    </div>

    <div class="mb-3">
        <label>Valor mínimo para aplicar</label>
        <input type="text" name="minimo" class="form-control" value="<?= $isEdit ? $cupom['minimo'] : '' ?>" required>
    </div>

    <button type="submit" class="btn btn-success">Salvar</button>
</form>