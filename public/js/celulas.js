$('#anexar').click(function() {
    if ($(this).prop('checked')) {
        $('#fministracao').show();
    } else {
        $('#fministracao').hide();
    }
});

//DataTable de células
//Grid de Celulas
const tableSiscell = $('#siscell-list').DataTable({
    language: {
        processing: "Processando informações...",
        search: "Procurar:",
        emptyTable: "DADOS INDISPONÍVEIS",
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

function defineValorBtn(tipo) {
    let url = window.location.pathname;
    let url_arr = url.split('/');
    url = url_arr[url_arr.length - 1];
    if (url === 'lixeira') {
        return 'Restaurar';
    } else if (url === 'inativos') {
        return 'Publicar';
    } else if (tipo === 2){
        return 'Editar';
    } else if (tipo === 1) {
        return 'Novo';
    }
}


$('#siscell-list tbody').on('click', 'tr', function() {
    let id = $('#siscell-list tr > input').val();

    if (id !== undefined) {
        if ($(this).hasClass('success')) {
            $(this).removeClass('success');
            let btnText = defineValorBtn(1);
            $('.siscell-edit').text(btnText);
            $('.siscell-ministracao').prop('disabled', true);
            $('.siscell-delete').prop('disabled', true);
            valueTable = null;
            nameTable = null;
        } else {
            let btnText = defineValorBtn(2);
            tableSiscell.$('tr.success').removeClass('success');
            $(this).addClass('success');
            $('.siscell-edit').text(btnText);
            $('.siscell-ministracao').removeAttr('disabled');
            $('.siscell-delete').removeAttr('disabled');
            valueTable = $('#siscell-list tr.success > input').val();
            nameTable = $('#siscell-list tr.success > #'+valueTable).text();
        }
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
    } else if (modal === 'ministracoes') {
        editarMinistracoes(idModal);
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
        $('#form-celula').each(function () {
            this.reset();
        });
        $('#idMembro').val('');
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
        console.log('Item não encontrado');
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
    } else if (event.target.idMinistracao !== undefined) {
        let formData = new FormData(this);
        criarMinistracao(formData);        
    }

});

  
