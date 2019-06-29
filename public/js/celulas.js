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

$('#select-celula').select2();

//Funcoes para Modal
function cria_modal(title, content, button) {
    var id = '#celula-modal';

    //Chama o modal
    $(id).modal({
        backdrop: false
    });

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
const tableSiscell = $('#siscell-list').DataTable({
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

var valueTable = null;
var nameTable = null;


$('#siscell-list tbody').on('click', 'tr', function() {
    if ($(this).hasClass('success')) {
        $(this).removeClass('success');
        $('.siscell-edit').text('Novo');
        $('.siscell-delete').prop('disabled', true);
        valueTable = null;
        nameTable = null;
    } else {
        tableSiscell.$('tr.success').removeClass('success');
        $(this).addClass('success');
        $('.siscell-edit').text('Editar');
        $('.siscell-delete').removeAttr('disabled');
        valueTable = $('#siscell-list tr.success > input').val();
        nameTable = $('#siscell-list tr.success > #'+valueTable).text();
    }
});

function editModal(modal) {
    var idModal = $('#form-celula-modal');

    $(idModal).modal({
        backdrop: 'static'
    });

    if (modal === 'celula') {
        editarCelula(idModal);
    } else if (modal === 'membro') {
        editarMembro(idModal);
    }
}

function editarMembro(idModal) {
    let idMembro = $('#siscell-list tr.success > input').val();
    if (idMembro != null) {
        $('#form-celula-modal-title').text('Editar Membro');
        $.getJSON('/siscell/membros/' + idMembro, function (data) {
            if (data !== null || data !== undefined) {

                let celulaId = null;
                if (data[0].celulas !== null) {
                    if (data[0].celulas.length > 0) {
                        celulaId = data[0].celulas[0].id;
                    }
                }

                $('#idMembro').val(data[0].id);
                $('#nome').val(data[0].name);
                $('#sobrenome').val(data[0].lastname);
                $('#dtnascimento').val(data[0].birthday);
                $('#telefone').val(data[0].phone);
                $('#celular').val(data[0].cellphone);
                $('#email').val(data[0].email);
                $('#cep').val(data[0].cep);
                $('#rua').val(data[0].street);
                $('#bairro').val(data[0].neiborhood);
                $('#numero').val(data[0].number);
                $('#cidade').val(data[0].city);
                $('#estado').val(data[0].state);
                if (celulaId !== null && celulaId !== undefined) {
                    $('#select-celula').val(celulaId).trigger('change');
                }

                if (data[0].leader == 1) {
                    $('#lider').prop('checked', true);
                } else {
                    $('#lider').prop('checked', false);
                }
            } else {
                console.log('Erro ao tentar recuparar informações dos membros');
            }
        });
    } else {
        $('#form-celula-modal-title').text('Novo Membro');
    }

    $(idModal).on('hidden.bs.modal', function() {
        $('#lider').prop('checked', false);
        $('#select-celula').val('').trigger('change');
    });
}

function editarCelula(idModal) {

    let idCelula = $('#siscell-list tr.success > input').val();
    if (idCelula != null) {
        $('#form-celula-modal-title').text('Editar Célula');
        $.getJSON('/siscell/celulas/' + idCelula, function (data) {
            if (data !== null || data !== undefined) {

                $('#idCelula').val(data[0].id);
                $('#nome').val(data[0].description);
                $('#cep').val(data[0].cep);
                $('#rua').val(data[0].street);
                $('#bairro').val(data[0].neiborhood);
                $('#numero').val(data[0].number);
                $('#cidade').val(data[0].city);
                $('#estado').val(data[0].state);

                $('#select-lider-celula').empty();
                if (!($.isEmptyObject(data[0].pessoas))) {
                    fillSelectLeader(data[0].pessoas, true);
                }

                let namePessoa = null;
                let newOption = null;
                for(let i = 1; i < data.length; i++) {
                    if (!($('#select-lider-celula').find("option[value='" + data[i].id + "']").length)) {
                        namePessoa = data[i].name + ' ' + data[i].lastname;
                        newOption = new Option(namePessoa, data[i].id, false, false);
                        $('#select-lider-celula').append(newOption).trigger('change');
                    }
                }
            } else {
                console.log('Erro ao tentar encontrar dados');
            }

        });
    } else {
        $('#form-celula-modal-title').text('Nova Célula');
        $('#select-lider-celula').empty();
        $.getJSON('/siscell/lideres', function(data) {
            fillSelectLeader(data, false);
        });
    }

    $(idModal).on('hidden.bs.modal', function() {
        $('#form-celula').each(function () {
            this.reset();
        });
        $('#idCelula').val('');
        $('#select-lider-celula').val('').trigger('change');
        $('#select-lider-celula').empty();
    });
}

function fillSelectLeader(data, edit) {
    $('#select-lider-celula').empty();
    let lideresCelula = new Array();
    data.forEach(function(pessoa) {
        let namePessoa = pessoa.name + ' ' + pessoa.lastname;
        let newOption = new Option(namePessoa, pessoa.id, false, false);
        $('#select-lider-celula').append(newOption).trigger('change');
        lideresCelula.push(pessoa.id);
    });

    if (edit) {
        // Seleciona líderes somente se for edição
        $('#select-lider-celula').val(lideresCelula).trigger('change');
    }
}

function confirmaExlusao(url) {
    let item = $('#siscell-list tr.success > #'+valueTable).text();
    let title = "EXCLUIR";
    let content = "ATENÇÃO!!! Confirma exclusão? "+ item;
    let buttons = "<button type='button' class='btn btn-success confirma-delete' data-dismiss='modal' onClick='apagarItem(\""+url+"\")'>Confirma</button>\
        <button class='btn btn-danger confirma-delete' data-dismiss='modal' value='cancela'>Cancela</button>";

    cria_modal(title, content, buttons);
};

function apagarItem(url) {
    let id = valueTable;

    $.ajax({
        type: 'PUT',
        url: url+id,
        context: this
    })
    .done(function (resp) {
        if (resp != null) {
            tableSiscell.row('.success').remove().draw(false);
            $('.siscell-edit').text('Novo');
            $('.siscell-delete').prop('disabled', true);
        }
    })
    .fail(function() {
        console.log('Item não encontrada');
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

function criarMembro() {
    membro = {
        idMembro: $('#idMembro').val(),
        nome: $('#nome').val(),
        sobrenome: $('#sobrenome').val(),
        dtNascimento: $('#dtnascimento').val(),
        telefone: $('#telefone').val(),
        celular: $('#celular').val(),
        email: $('#email').val(),
        lider: $('#lider').is(':checked'),
        cep: $('#cep').val(),
        rua: $('#rua').val(),
        numero: $('#numero').val(),
        bairro: $('#bairro').val(),
        cidade: $('#cidade').val(),
        estado: $('#estado').val(),
        celula: $('#select-celula :selected').val()
    };

    $.post("/siscell/membros", membro, function(data) {
        if (data != null) {
            $('#form-celula').each(function() {
                this.reset();
            });
            $('#select-celula :selected').val("");
            location.reload();
        }
        $('#form-celula-modal').modal('hide');
    });
}

//Formulário de celulas
$('#form-celula').submit(function(event) {
    event.preventDefault();
    if (event.target.idCelula !== undefined) {
        criarCelula();
    } else if (event.target.idMembro !== undefined) {
        criarMembro();
    }

});

  
