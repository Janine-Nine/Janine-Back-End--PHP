 let produtos = [];
    let carrinho = [];
    let desconto = 0;

    document.getElementById('btnSalvar').addEventListener('click', () => {
      const nome = nomeProduto.value.trim();
      const preco = parseFloat(precoProduto.value);
      const estoque = parseInt(estoqueProduto.value);
      const variacao = variacaoProduto.value.trim();

      if (!nome || isNaN(preco) || isNaN(estoque)) {
        alert('Preencha todos os campos obrigatórios!');
        return;
      }

      const novoProduto = { id: produtos.length + 1, nome, preco, estoque, variacao };
      produtos.push(novoProduto);
      atualizarTabela();
      formProduto.reset();
    });

    function atualizarTabela() {
      const tabela = document.getElementById('tabelaProdutos');
      tabela.innerHTML = '';
      produtos.forEach(p => {
        tabela.innerHTML += `
        <tr>
            <td>${p.id}</td>
            <td>${p.nome}</td>
            <td>R$ ${p.preco.toFixed(2)}</td>
            <td>${p.estoque}</td>
            <td>${p.variacao || '-'}</td>
            <td>
              <button class="btn btn-sm btn-outline-primary" onclick="adicionarCarrinho(${p.id})">Comprar</button>
            </td>
          </tr>`;
      });
    }
         function adicionarCarrinho(id) {
      const produto = produtos.find(p => p.id === id);
      if (!produto || produto.estoque <= 0) {
        alert('Produto sem estoque!');
        return;
      }
      produto.estoque--;
      carrinho.push(produto);
      atualizarTabela();
      atualizarCarrinho();
    }

    function atualizarCarrinho() {
      const lista = document.getElementById('listaCarrinho');
      lista.innerHTML = '';
      let subtotal = 0;
      carrinho.forEach(p => {
        subtotal += p.preco;
        lista.innerHTML += `<li class="list-group-item">${p.nome} - R$ ${p.preco.toFixed(2)}</li>`;
      });

      let frete = 0;
      if (subtotal >= 52 && subtotal <= 166.59) frete = 15;
      else if (subtotal >= 200) frete = 0;
      else frete = 20;

      let total = subtotal + frete - desconto;
      document.getElementById('subtotal').textContent = subtotal.toFixed(2);
      document.getElementById('frete').textContent = frete.toFixed(2);
      document.getElementById('desconto').textContent = desconto.toFixed(2);
      document.getElementById('total').textContent = total.toFixed(2);
    }

    // CUPOM
    document.getElementById('btnCupom').addEventListener('click', () => {
      const cupom = document.getElementById('cupom').value.trim().toUpperCase();
      if (cupom === 'DESCONTO10') {
        desconto = 10;
        document.getElementById('cupomAtivo').classList.remove('d-none');
      } else if (cupom === 'FRETEGRATIS') {
        desconto = 20; // simula valor do frete
        document.getElementById('cupomAtivo').classList.remove('d-none');
      } else {
        desconto = 0;
        alert('Cupom inválido!');
      }
      atualizarCarrinho();
    });

    // VIA CEP
    document.getElementById('btnBuscarCep').addEventListener('click', async () => {
      const cep = cepCliente.value.replace(/\D/g, '');
      if (cep.length !== 8) {
        alert('CEP inválido!');
        return;
      }
      try {
        const resposta = await fetch(`https://viacep.com.br/ws/${cep}/json/`);
        const dados = await resposta.json();
        if (dados.erro) throw new Error('CEP não encontrado!');
        enderecoCliente.textContent = `${dados.logradouro}, ${dados.bairro}, ${dados.localidade} - ${dados.uf}`;
      } catch (err) {
        enderecoCliente.textContent = 'Endereço não encontrado.';
      }
    });

    // FINALIZAR PEDIDO (simula envio de e-mail)
    document.getElementById('btnFinalizar').addEventListener('click', () => {
      if (carrinho.length === 0) {
        alert('Carrinho vazio!');
        return;
      }
      const emailSimulado = `
        Pedido confirmado! 🛍️
        Total: R$${document.getElementById('total').textContent}
        Endereço: ${document.getElementById('enderecoCliente').textContent || 'Não informado'}
        Cupom aplicado: ${document.getElementById('cupom').value || 'Nenhum'}
      `;
      alert(emailSimulado);
      carrinho = [];
      desconto = 0;
      atualizarCarrinho();
    });