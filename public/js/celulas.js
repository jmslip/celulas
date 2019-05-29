$(document).ready(function() {
    //Mascaras
    // $('#calendario').inputmask('dd/mm/yyyy');
    // $('#cep').inputmask('99999-999');
    // $('#telefone').inputmask('(99)9999-9999');
    // $('#celular').inputmask('(99)99999-9999');

    //Função ToDo List
    //$

    // //Tornar os widgets móveis
    // $('.connectedSortable').sortable({
    //     placeholder: 'sort-highlight',
    //     connectWith: '.connectedSortable',
    //     handle: '.box-header',
    //     forcePlaceholderSize: true,
    //     zIndex: 99999
    // });
    // $('.connectedSortable .box-header').css('cursor', 'move');

    // //Gráfico
    // var gCellCanvas = $('#graphCell');
    // var gCell = new Chart(gCellCanvas, {
    //     type: 'bar',
    //     data: {
    //         labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
    //         datasets: [{
    //             label: '# of Votes',
    //             data: [12, 19, 3, 5, 2, 3],
    //             backgroundColor: [
    //                 'rgba(255, 99, 132, 0.2)',
    //                 'rgba(54, 162, 235, 0.2)',
    //                 'rgba(255, 206, 86, 0.2)',
    //                 'rgba(75, 192, 192, 0.2)',
    //                 'rgba(153, 102, 255, 0.2)',
    //                 'rgba(255, 159, 64, 0.2)'
    //             ],
    //             borderColor: [
    //                 'rgba(255,99,132,1)',
    //                 'rgba(54, 162, 235, 1)',
    //                 'rgba(255, 206, 86, 1)',
    //                 'rgba(75, 192, 192, 1)',
    //                 'rgba(153, 102, 255, 1)',
    //                 'rgba(255, 159, 64, 1)'
    //             ],
    //             borderWidth: 1
    //         }]
    //     },
    //     options: {
    //         scales: {
    //             yAxes: [{
    //                 ticks: {
    //                     beginAtZero:true
    //                 }
    //             }]
    //         }
    //     }
    // });

    //Calendário
    $('#calendario').datepicker({
        format: 'dd/mm/yyyy',
       language: 'pt-BR',
    });

    //Select2
    $('#select-lider-celula').select2({
        maximumSelectionLength: 3,
        allowClear: true,
        language: "pt-BR"
    });

    //DataTable
    $('#lista-celulas').DataTable({
        language: {
            processing: "Processando informações...",
            search: "Procurar:",
            lengthMenu: "Mostrar _MENU_ registros",
            info: "Monstrando de _START_ a _END_ de _TOTAL_ registros",
            infoEmpty: "Mostrando de 0 a 0 de 0 registros",
            infoFiltered: "(Filtrado de _MAX_ resgistros)",
            infoPostFix: "",
            loadingRecords: "Carregando informações...",
            paginate: {
                first: "Primeiro",
                previous: "Anterior",
                next: "Próximo",
                last: "Último"
            }
        },
    });

    //Funcoes para Modal
    function cria_modal(title, content) {
        var id = '#celula-modal';
        //Chama o modal
        $(id).modal();

        //Prenche o modal
        $(id).on('shown.bs.modal', function() {
            $('#celula-modal-title').text(title);
            $('#celula-modal-content').text(content);
        });

        //Limpa modal
        $(id).on('hidden.bs.modal', function() {
            $('#celula-modal-title').text("");
            $('#celula-modal-content').text("");
        });
    }

    //Funcao para liberar campos para preenchimento
    //@params id Array, attr
    function remove_atributos(id, attr) {
        var i;
        for (i = 0; i < id.length; i++) {
            $(id[i]).removeAttr(attr);
        }
    }

    //Funcoes para cep
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
                $('#bairro').val("...");$(document).ready(function() {
    //Mascaras
    $('#calendario').inputmask('dd/mm/yyyy');
    $('#cep').inputmask('99999-999');
    $('#telefone').inputmask('(99)9999-9999');
    $('#celular').inputmask('(99)99999-9999');

    //Função ToDo List
    //$

    //Tornar os widgets móveis
    $('.connectedSortable').sortable({
        placeholder: 'sort-highlight',
        connectWith: '.connectedSortable',
        handle: '.box-header',
        forcePlaceholderSize: true,
        zIndex: 99999
    });
    $('.connectedSortable .box-header').css('cursor', 'move');

    //Gráfico
    var gCellCanvas = $('#graphCell');
    var gCell = new Chart(gCellCanvas, {
        type: 'bar',
        data: {
            labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
            datasets: [{
                label: '# of Votes',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        }
    });

    //Calendário
    $('#calendario').datepicker({
        format: 'dd/mm/yyyy',
       language: 'pt-BR',
    });

    //Select2
    $('#select-lider-celula').select2({
        maximumSelectionLength: 3,
        allowClear: true,
        language: "pt-BR"
    });

    //DataTable
    $('#lista-celulas').DataTable({
        language: {
            processing: "Processando informações...",
            search: "Procurar:",
            lengthMenu: "Mostrar _MENU_ registros",
            info: "Monstrando de _START_ a _END_ de _TOTAL_ registros",
            infoEmpty: "Mostrando de 0 a 0 de 0 registros",
            infoFiltered: "(Filtrado de _MAX_ resgistros)",
            infoPostFix: "",
            loadingRecords: "Carregando informações...",
            paginate: {
                first: "Primeiro",
                previous: "Anterior",
                next: "Próximo",
                last: "Último"
            }
        },
    });

    //Funcoes para Modal
    function cria_modal(title, content) {
        var id = '#celula-modal';
        //Chama o modal
        $(id).modal();

        //Prenche o modal
        $(id).on('shown.bs.modal', function() {
            $('#celula-modal-title').text(title);
            $('#celula-modal-content').text(content);
        });

        //Limpa modal
        $(id).on('hidden.bs.modal', function() {
            $('#celula-modal-title').text("");
            $('#celula-modal-content').text("");
        });
    }

    //Funcao para liberar campos para preenchimento
    //@params id Array, attr
    function remove_atributos(id, attr) {
        var i;
        for (i = 0; i < id.length; i++) {
            $(id[i]).removeAttr(attr);
        }
    }

    //Funcoes para cep
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
                        cria_modal("CEP não encontrado", "Desculpe, mas o CEP digitado não foi encontrado na base de dados!");
                        $('#rua').removeAttr('readonly');
                        var id = ["#rua", "#bairro", "#cidade", "#estado"];
                        var attr = "readonly";
                        remove_atributos(id, attr);
                    }
                });
            } else {
                //CEP não é válido
                limpa_formulario_cep();
                cria_modal("CEP inválido", "Favor digitar um cep válido!");
                var id = ["#rua", "#bairro", "#cidade", "#estado"];
                var attr = "readonly";
                remove_atributos(id, attr);
            }
        } else {
            //Campo está vazio
            limpa_formulario_cep();
            cria_modal("CEP não preenchido", "Favor preencher o cep!");
        }
    });
});
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
                        cria_modal("CEP não encontrado", "Desculpe, mas o CEP digitado não foi encontrado na base de dados!");
                        $('#rua').removeAttr('readonly');
                        var id = ["#rua", "#bairro", "#cidade", "#estado"];
                        var attr = "readonly";
                        remove_atributos(id, attr);
                    }
                });
            } else {
                //CEP não é válido
                limpa_formulario_cep();
                cria_modal("CEP inválido", "Favor digitar um cep válido!");
                var id = ["#rua", "#bairro", "#cidade", "#estado"];
                var attr = "readonly";
                remove_atributos(id, attr);
            }
        } else {
            //Campo está vazio
            limpa_formulario_cep();
            cria_modal("CEP não preenchido", "Favor preencher o cep!");
        }
    });
});
