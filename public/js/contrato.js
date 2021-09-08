function buscaImovel() {
    var id = $('#id_proprietario').val();
    $.ajax({
        url: '../ajax/imovel',
        dataType: 'json',
        method: 'POST',
        data: { 'id_proprietario': id },
        success: function (retorno) {
            var append = '<option value="0">Selecione</option>';
            $.each(retorno, function (key, value) {
                append += '<option value="' + value.id + '">' + value.rua + ", Nº" + value.numero + " - " + value.bairro + " - " + value.cidade + '</option>';
            });
            $('#id_imovel').html(append);
        }
    });
};
$(document).ready(function () {
    buscaImovel();
});
$(document).on('change', '#id_proprietario', function () {
    buscaImovel();
});