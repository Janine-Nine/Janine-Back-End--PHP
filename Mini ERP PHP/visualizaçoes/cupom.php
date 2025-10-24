<h2>Cupons</h2>
<a href="index.php?c=cupom&a=create" class="btn btn-primary mb-3">Novo Cupom</a>

<?php if (empty($cupons)): ?>
    <div class="alert alert-info">Nenhum cupom cadastrado.</div>
<?php else: ?>
<table class="table">
    <tr>
        <th>ID</th><th>Código</th><th>Desconto</th><th>Validade</th><th>Mínimo</th><th>Ações</th>
    </tr>
    <?php foreach ($cupons as $c): ?>
    <tr>
        <td><?= $c['id'] ?></td>
        <td><?= $c['codigo'] ?></td>
        <td><?= $c['desconto'] ?></td>
        <td><?= $c['validade'] ?></td>
        <td><?= $c['minimo'] ?></td>
        <td>
            <a href="index.php?c=cupom&a=edit&id=<?= $c['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
            <a href="index.php?c=cupom&a=delete&id=<?= $c['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Confirma excluir?')">Excluir</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?php endif; ?>