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
