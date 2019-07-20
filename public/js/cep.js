//Funcoes CEP
//Funcoes para cep
$('#cep').tooltip({
    trigger: 'manual'
});

//Funcao para limpar o formulário do cep
function limpa_formulario_cep() {
    $('#rua').val("");
    $('#bairro').val("");
    $('#cidade').val("");
    $('#estado').val("");
}

//Quando campo cep perde o foco
$('#cep').blur(function() {
    //Cria váriavel com valor do cep somente com numeros
    var cep = $(this).val().replace(/\D/g, '');

    //Verifica se campo está vazio
    if (cep != "") {

        //Expressão regular para verificar se cep é válido
        var validaCep = /^[0-9]{8}$/;

        //Valida Cep
        if (validaCep.test(cep)) {
            //Preenche campos durante pesquisa do webservice
            $('#rua').val("...");
            $('#bairro').val("...");
            $('#cidade').val("...");
            $('#estado').val("...");


            //Consulta webservice
            $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                if (!("erro" in dados)) {
                    //Atualiza os campos
                    $('#rua').val(dados.logradouro);
                    $('#bairro').val(dados.bairro);
                    $('#cidade').val(dados.localidade);
                    $('#estado').val(dados.uf);
                } else {
                    //Cep pesquisado não foi encontrado
                    limpa_formulario_cep();
                    $('#cep').tooltip('show');
                }
            });
        } else {
            //CEP não é válido
            limpa_formulario_cep();
        }
    } else {
        //Campo está vazio
        limpa_formulario_cep();
    }
});

$('#cep').click(function() {
    $(this).tooltip('hide');
});
