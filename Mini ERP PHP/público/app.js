$(document).ready(function () {
    // 📝 Máscara para CEP
    $('#cep').on('input', function () {
        let v = $(this).val().replace(/\D/g, '');
        if (v.length > 5) {
            $(this).val(v.substring(0, 5) + '-' + v.substring(5, 8));
        } else {
            $(this).val(v);
        }
    });

    // 📬 Consulta ViaCEP
    $('#cep').on('blur', function () {
        let cep = $(this).val().replace(/\D/g, '');
        if (cep.length !== 8) {
            alert('CEP inválido! Use apenas números.');
            return;
        }

        $.getJSON(`https://viacep.com.br/ws/${cep}/json/`, function (data) {
            if (data.erro) {
                alert('CEP não encontrado!');
                return;
            }
            $('#rua').val(data.logradouro);
            $('#bairro').val(data.bairro);
            $('#cidade').val(data.localidade);
            $('#uf').val(data.uf);
        }).fail(function () {
            alert('Erro ao consultar o CEP.');
        });
    });

    // 🌗 Switch Light/Dark
    $('#theme-toggle').click(function () {
        // Removido: não aplicar fundo preto. Alterna apenas o texto do botão.
        if ($(this).data('mode') === 'light') {
            $(this).text('🌙 Dark');
            $(this).data('mode', 'dark');
        } else {
            $(this).text('☀️ Light');
            $(this).data('mode', 'light');
        }
    });

    // Renderizar produtos na tabela (com atributos data-label para mobile)
    function renderProducts(products) {
        const $tbody = $('#tabelaProdutos');
        $tbody.empty();
        products.forEach(function(p, idx) {
            const tr = $('<tr></tr>');
            tr.append($('<td data-label="#">' + (idx+1) + '</td>'));
            tr.append($('<td data-label="Nome"><div class="d-flex align-items-center"><img src="'+p.img+'" class="product-img me-3" alt=""><div><div>'+p.nome+'</div><div class="text-muted small">'+p.sku+'</div></div></div></td>'));
            tr.append($('<td data-label="Preço" class="price-cell">R$ '+p.preco+'</td>'));
            const stockClass = p.estoque <= 5 ? 'stock-low' : 'stock-ok';
            tr.append($('<td data-label="Estoque" class="'+stockClass+'">'+p.estoque+'</td>'));
            tr.append($('<td data-label="Variações">'+(p.variacoes || '-')+'</td>'));
            const actions = '<td data-label="Ações" class="action-buttons">'
                +'<button class="btn btn-sm btn-outline-primary">Editar</button>'
                +'<button class="btn btn-sm btn-outline-danger">Remover</button>'
                +'</td>';
            tr.append($(actions));
            $tbody.append(tr);
        });
    }

    // Dados de exemplo (substitua pelo fetch da API se necessário)
    const sampleProducts = [
        {nome:'Camiseta Estampada', sku:'SKU-001', preco:'89,90', estoque:35, variacoes:'P,M,G', img:'https://via.placeholder.com/56'},
        {nome:'Caneca Personalizada', sku:'SKU-002', preco:'29,90', estoque:3, variacoes:'Único', img:'https://via.placeholder.com/56'},
        {nome:'Boné Trucker', sku:'SKU-003', preco:'59,90', estoque:12, variacoes:'Único', img:'https://via.placeholder.com/56'}
    ];

    // Se não houver conteúdo na tabela, renderiza amostras
    if ($('#tabelaProdutos').children().length === 0) {
        renderProducts(sampleProducts);
    }
});