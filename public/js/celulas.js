
//Mascaras
$('#calendario').mask('dd/mm/yyyy');
$('#telefone').mask('(99)9999-9999');
$('#celular').mask('(99)99999-9999');
$('#cep').mask('99999-999');

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

//Funcoes para Modal
function cria_modal(title, content, button) {
    var id = '#celula-modal';

    //Chama o modal
    $(id).modal();

    //Prenche o modal
    $(id).on('shown.bs.modal', function() {
        $('#celula-modal-title').text(title);
        $('#celula-modal-content').text(content);
        $('.modal-footer').html(button);
    });

    //Limpa modal
    $(id).on('hidden.bs.modal', function() {
        $('#celula-modal-title').text("");
        $('#celula-modal-content').text("");
        $('.modal-footer').empty();
        $('#cep').tooltip('hide');
        nameCelula = null;
    });
}

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



//DataTable de células
//Grid de Celulas
const tableCelulas = $('#lista-celulas').DataTable({
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
    responsive: true
});

var valueCelula = null;
var nameCelula = null;


$('#lista-celulas tbody').on('click', 'tr', function() {
    if ($(this).hasClass('success')) {
        $(this).removeClass('success');
        $('.edit-celula').text('Novo');
        $('.delete-celula').prop('disabled', true);
        valueCelula = null;
        nameCelula = null;
    } else {
        tableCelulas.$('tr.success').removeClass('success');
        $(this).addClass('success');
        $('.edit-celula').text('Editar');
        $('.delete-celula').removeAttr('disabled');
        valueCelula = $('#lista-celulas tr.success > input').val();
        nameCelula = $('#lista-celulas tr.success > #'+valueCelula).text();
    }
});

function editarCelula() {
    var idCelula = valueCelula;
    var idModal = $('#form-celula-modal');

    $(idModal).modal();

    $(idModal).on('shown.bs.modal', function() {
        if (idCelula != null) {
            $.getJSON('/siscell/celulas/' + idCelula, function (data) {
                if (data !== null || data !== undefined) {
                    $('#form-celula-modal-title').text('Editar Célula');

                    $('#idCelula').val(data.id);
                    $('#nome').val(data.description);
                    $('#cep').val(data.cep);
                    $('#rua').val(data.street);
                    $('#bairro').val(data.neiborhood);
                    $('#numero').val(data.number);
                    $('#cidade').val(data.city);
                    $('#estado').val(data.state);

                    const arr_lideres = [];
                    for (let i = 0; i < data.quantidadeLideres; i++) {
                        arr_lideres.push(data['pessoa-' + i]);
                    }
                    $('#select-lider-celula').val(arr_lideres).trigger('change');
                } else {
                    console.log('Erro ao tentar encontrar dados');
                }

            });
        } else {
            $('#form-celula-modal-title').text('Nova Célula');
        }
    });

    $(idModal).on('hidden.bs.modal', function() {
        $('#form-celula').each(function () {
            this.reset();
        });
        $('#idCelula').val('');
        $('#select-lider-celula').val('').trigger('change');
        idCelula = null;
    });
}

function confirmaExlusao() {
    let celula = nameCelula;
    let title = "Exclusão de Célula";
    let content = "ATENÇÃO!!! Confirma exclusão da "+ celula +"?";
    let buttons = "<button type='button' class='btn btn-success confirma-delete' data-dismiss='modal' onClick='apagarCelula()'>Confirma</button>\
        <button class='btn btn-danger confirma-delete' data-dismiss='modal' value='cancela'>Cancela</button>";

    cria_modal(title, content, buttons);
};

function apagarCelula() {
    let id = valueCelula;

    $.ajax({
        type: 'PUT',
        url: "/siscell/celulas/"+id,
        context: this
    })
    .done(function (resp) {
        if (resp != null) {
            tableCelulas.row('.success').remove().draw(false);
            $('.edit-celula').text('Novo');
            $('.delete-celula').prop('disabled', true);
        }
    })
    .fail(function() {
        console.log('Celula não encontrada');
    });
}

function criarCelula() {
    celula = {
        idCelula: $('#idCelula').val(),
        nome: $('#nome').val(),
        cep: $('#cep').val(),
        rua: $('#rua').val(),
        numero: $('#numero').val(),
        bairro: $('#bairro').val(),
        cidade: $('#cidade').val(),
        estado: $('#estado').val(),
        lideres: $('#select-lider-celula').val()
    };
    
    $.post("/siscell/celulas", celula, function(data) {
        if (data != null) {
            $('#form-celula').each(function() {
                this.reset();
            });
            $('#select-lider-celula :selected').val("");
            location.reload();
        }
        $('#form-celula-modal').modal('hide');
    });
}

//Formulário de celulas
$('#form-celula').submit(function(event) {
    event.preventDefault();
    
    criarCelula();
});

  
