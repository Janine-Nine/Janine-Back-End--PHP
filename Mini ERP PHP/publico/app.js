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
        if ($('body').hasClass('light-theme')) {
            $('body').removeClass('light-theme').css({
                'background-color': '#121212',
                'color': '#f1f1f1'
            });
            $(this).text('🌙 Dark');
        } else {
            $('body').addClass('light-theme').css({
                'background-color': '#fff',
                'color': '#000'
            });
            $(this).text('☀️ Light');
        }
    });
});
