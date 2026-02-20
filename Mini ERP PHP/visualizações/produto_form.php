<form method="POST" action="index.php?c=produto&a=store" class="mb-4">
    <div class="mb-3">
        <h1>Cadastro de Produto</h1>
        <label>Nome do Produto</label>
        <input type="text" name="nome" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Preço</label>
        <input type="text" name="preco" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Cadastrar</button>
</form>

<h2>Produtos</h2>
<table class="table">
    <tr>
        <th>ID</th><th>Nome</th><th>Preço</th>
    </tr>
    <?php foreach ($produtos as $p): ?>
    <tr>
        <td><?= $p['id'] ?></td>
        <td><?= $p['nome'] ?></td>
        <td>R$ <?= $p['preco'] ?></td>
    </tr>
    <?php endforeach; ?>
</table>