const produtos = [
  { id: 1, nome: 'Camiseta Estampada', preco: 89.90, estoque: 35, variacao: 'P, M, G', img: 'https://via.placeholder.com/56' },
  { id: 2, nome: 'Caneca Personalizada', preco: 29.90, estoque: 3, variacao: 'Único', img: 'https://via.placeholder.com/56' },
  { id: 3, nome: 'Boné Trucker', preco: 59.90, estoque: 12, variacao: 'Único', img: 'https://via.placeholder.com/56' }
];

let carrinho = [];
let desconto = 0;

const formProduto = document.getElementById('formProduto');
const nomeProduto = document.getElementById('nomeProduto');
const precoProduto = document.getElementById('precoProduto');
const estoqueProduto = document.getElementById('estoqueProduto');
const variacaoProduto = document.getElementById('variacaoProduto');
const tabelaProdutos = document.getElementById('tabelaProdutos');
const listaCarrinho = document.getElementById('listaCarrinho');
const subtotalEl = document.getElementById('subtotal');
const freteEl = document.getElementById('frete');
const descontoEl = document.getElementById('desconto');
const totalEl = document.getElementById('total');
const cupomInput = document.getElementById('cupom');
const cupomAtivo = document.getElementById('cupomAtivo');
const cepCliente = document.getElementById('cepCliente');
const enderecoCliente = document.getElementById('enderecoCliente');
const btnCupom = document.getElementById('btnCupom');
const btnBuscarCep = document.getElementById('btnBuscarCep');
const btnFinalizar = document.getElementById('btnFinalizar');

function formatMoney(value) {
  return value.toFixed(2).replace('.', ',');
}

function atualizarTabela() {
  tabelaProdutos.innerHTML = '';

  produtos.forEach(p => {
    const stockClass = p.estoque <= 5 ? 'stock-low' : 'stock-ok';
    tabelaProdutos.innerHTML += `
      <tr>
        <td data-label="#">${p.id}</td>
        <td data-label="Nome">
          <div class="d-flex align-items-center">
            <img src="${p.img}" class="product-img me-3" alt="${p.nome}">
            <div>
              <div>${p.nome}</div>
              <div class="text-muted small">SKU-${String(p.id).padStart(3, '0')}</div>
            </div>
          </div>
        </td>
        <td data-label="Preço" class="price-cell">R$ ${formatMoney(p.preco)}</td>
        <td data-label="Estoque" class="${stockClass}">${p.estoque}</td>
        <td data-label="Variações">${p.variacao || '-'}</td>
        <td data-label="Ações" class="action-buttons">
          <button class="btn btn-sm btn-outline-primary" type="button" onclick="adicionarCarrinho(${p.id})">Comprar</button>
        </td>
      </tr>`;
  });
}

function adicionarProduto(event) {
  event.preventDefault();

  const nome = nomeProduto.value.trim();
  const preco = parseFloat(precoProduto.value.replace(',', '.'));
  const estoque = parseInt(estoqueProduto.value, 10);
  const variacao = variacaoProduto.value.trim();

  if (!nome || isNaN(preco) || isNaN(estoque)) {
    alert('Preencha todos os campos obrigatórios!');
    return;
  }

  const novoProduto = {
    id: produtos.length + 1,
    nome,
    preco,
    estoque,
    variacao: variacao || 'Único',
    img: 'https://via.placeholder.com/56'
  };

  produtos.push(novoProduto);
  atualizarTabela();
  formProduto.reset();
}

function adicionarCarrinho(id) {
  const produto = produtos.find(p => p.id === id);
  if (!produto || produto.estoque <= 0) {
    alert('Produto sem estoque!');
    return;
  }

  produto.estoque -= 1;
  carrinho.push({ ...produto });
  atualizarTabela();
  atualizarCarrinho();
}

function removerDoCarrinho(index) {
  const itemRemovido = carrinho.splice(index, 1)[0];
  if (itemRemovido) {
    const produto = produtos.find(p => p.id === itemRemovido.id);
    if (produto) {
      produto.estoque += 1;
    }
  }
  atualizarTabela();
  atualizarCarrinho();
}

function atualizarCarrinho() {
  listaCarrinho.innerHTML = '';
  let subtotal = 0;

  carrinho.forEach((item, index) => {
    subtotal += item.preco;
    listaCarrinho.innerHTML += `
      <li class="list-group-item d-flex justify-content-between align-items-center">
        <span>${item.nome} - R$ ${formatMoney(item.preco)}</span>
        <button class="btn btn-sm btn-outline-danger" type="button" onclick="removerDoCarrinho(${index})">Remover</button>
      </li>`;
  });

  let frete = 0;
  if (subtotal === 0) {
    frete = 0;
  } else if (subtotal < 200) {
    frete = 20;
    if (subtotal >= 52 && subtotal <= 166.59) {
      frete = 15;
    }
  }

  let total = subtotal + frete - desconto;
  if (total < 0) total = 0;

  subtotalEl.textContent = formatMoney(subtotal);
  freteEl.textContent = formatMoney(frete);
  descontoEl.textContent = formatMoney(desconto);
  totalEl.textContent = formatMoney(total);
}

function aplicarCupom() {
  const cupom = cupomInput.value.trim().toUpperCase();
  if (!cupom) {
    alert('Digite um cupom de desconto.');
    return;
  }

  if (cupom === 'DESCONTO10') {
    desconto = 10;
    cupomAtivo.textContent = 'Cupom DESCONTO10 aplicado!';
    cupomAtivo.classList.remove('d-none');
  } else if (cupom === 'FRETEGRATIS') {
    desconto = 20;
    cupomAtivo.textContent = 'Cupom FRETEGRATIS aplicado!';
    cupomAtivo.classList.remove('d-none');
  } else {
    desconto = 0;
    cupomAtivo.classList.add('d-none');
    alert('Cupom inválido! Use DESCONTO10 ou FRETEGRATIS.');
  }

  atualizarCarrinho();
}

async function buscarCep() {
  const cep = cepCliente.value.replace(/\D/g, '');
  if (cep.length !== 8) {
    alert('CEP inválido! Use apenas números.');
    return;
  }

  try {
    const resposta = await fetch(`https://viacep.com.br/ws/${cep}/json/`);
    const dados = await resposta.json();

    if (dados.erro) {
      throw new Error('CEP não encontrado');
    }

    enderecoCliente.textContent = `${dados.logradouro}, ${dados.bairro}, ${dados.localidade} - ${dados.uf}`;
  } catch (err) {
    enderecoCliente.textContent = 'Endereço não encontrado.';
  }
}

function finalizarPedido() {
  if (carrinho.length === 0) {
    alert('Carrinho vazio! Adicione produtos antes de finalizar.');
    return;
  }

  const emailSimulado = `Pedido confirmado! 🛍️\nTotal: R$ ${totalEl.textContent}\nEndereço: ${enderecoCliente.textContent || 'Não informado'}\nCupom aplicado: ${cupomInput.value || 'Nenhum'}`;
  alert(emailSimulado);
  carrinho = [];
  desconto = 0;
  cupomInput.value = '';
  cupomAtivo.classList.add('d-none');
  atualizarCarrinho();
}

formProduto.addEventListener('submit', adicionarProduto);
btnCupom.addEventListener('click', aplicarCupom);
btnBuscarCep.addEventListener('click', buscarCep);
btnFinalizar.addEventListener('click', finalizarPedido);

window.adicionarCarrinho = adicionarCarrinho;
window.removerDoCarrinho = removerDoCarrinho;

atualizarTabela();
atualizarCarrinho();