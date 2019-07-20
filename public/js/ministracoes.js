$('#fministracao').hide();
$('.downloadMinistracao').hide();
$('.fileInformations').hide();

function editarMinistracoes(idModal) {
    let idMinistracao = $('#siscell-list tr.success > input').val();
    if (idMinistracao != null) {
        $('#form-celula-modal-title').text('Editar Ministração');
        $.getJSON('/siscell/ministracoes/' + idMinistracao, function (data) {
            if (data !== null || data !== undefined) {
                $('#idMinistracao').val(data[0].id);
                $('#numeroMinistracao').val(data[0].number);
                $('#nome').val(data[0].number+'.'+data[0].name);
                $('#ministracao').val(data[0].description);
                $('#usuarioMinistracao').val(data[0].nameUser);
                if (data[0].attachment == 1) {
                    $('#anexar').prop('checked', true);
                    $('#anexar').prop('disabled', true);
                    $('.downloadMinistracao').show();
                    $('#downloadMinistracao').prop('href', data[0].path)
                    $('.fileInformations').show();
                    $('#fileName').text('Nome: '+data[0].fileName);
                    $('#fileSize').text('Tamanho: ' + (data[0].size / 1000).toFixed(1) + ' KB');
                    $('#fileType').text('Tipo: '+data[0].type);
                } else {
                    $('#anexar').prop('checked', false);                    
                    $('.fileInformations').hide();
                    $('.downloadMinistracao').hide();
                }
            }
        });
    } else {
        $('#form-celula-modal-title').text('Nova Ministração');
    }

    $(idModal).on('hidden.bs.modal', function() {
        $('#form-celula').each(function () {
            this.reset();
        });
        $('#idMinistracao').val('');
        $('#fministracao').hide();
        $('.fileInformations').hide();
        $('.downloadMinistracao').hide();
        $('#anexar').removeAttr('disabled');
    });
}

function criarMinistracao(formData) {
    $.ajax({
        url: '/siscell/ministracoes',
        type: 'POST',
        data: formData,
        success: function(data) {
            if (data != null) {
                $('#form-celula').each(function() {
                    this.reset();
                });
                location.reload();
            }
            $('#form-celula-modal').modal('hide');
        },
        cache: false,
        contentType: false,
        processData: false,
        xhr: function() {
            var myXhr = $.ajaxSettings.xhr();
            if(myXhr.upload) {
                myXhr.upload.addEventListener('progress', function() {

                }, false);
            }
            return myXhr;
        }
    });
}

function apagaArquivo() {
    let ok = confirm('Tem certeza que deseja excluir essa Ministração? ESTA AÇÃO NÃO TEM VOLTA!');
    
    if (ok) {
        let idMinistracao = $('#idMinistracao').val();    
    
        $.ajax({
            url: '/siscell/ministracoes/' + idMinistracao,
            type: 'PUT',
            context: this,
            data: {'tipo': 'fileDelete'}
        }).done(function (data) {
            if (data != null) {
                alert('Arquivo excluído com sucesso!');

                $('#anexar').prop('checked', false);
                $('.fileInformations').hide();
                $('.downloadMinistracao').hide();
                $('#anexar').removeAttr('disabled');
            }

        }).fail(function (jqXHR, textStatus) {
            alert('Erro ao apagar o arquivo! '+ textStatus);
        });
    }
}
