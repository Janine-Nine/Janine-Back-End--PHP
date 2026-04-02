<h2>Carrinho</h2>
<?php $flashErro = function_exists('flash_get') ? flash_get('erro') : null; ?>
<?php if ($flashErro): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($flashErro) ?></div>
<?php endif; ?>
<?php if (empty($_SESSION['carrinho'])): ?>
    <div class="alert alert-info">Seu carrinho está vazio.</div>
<?php else: ?>
<table class="table">
    <tr><th>Produto</th><th>Quantidade</th><th>Subtotal</th></tr>
    <?php
    $subtotal = 0;
    foreach ($_SESSION['carrinho'] as $id => $qtd):
        $stmt = $pdo->prepare("SELECT nome, preco FROM produtos WHERE id = ?");
        $stmt->execute([$id]);
        $p = $stmt->fetch();
        $linha = $p['preco'] * $qtd;
        $subtotal += $linha;
    ?>
    <tr>
        <td><?= $p['nome'] ?></td>
        <td><?= $qtd ?></td>
        <td>R$ <?= number_format($linha,2,',','.') ?></td>
    </tr>
    <?php endforeach; ?>
</table>

<form method="POST" action="index.php?c=pedido&a=finalizar">
    <div class="mb-3">
        <label>CEP para entrega</label>
        <input type="text" name="cep" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-success">Finalizar Pedido</button>
</form>
<?php endif; ?>