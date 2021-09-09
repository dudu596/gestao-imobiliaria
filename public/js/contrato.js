function buscaImovel() {
    var id = $('#id_proprietario').val();
    $.ajax({
        url: '/gestao-imobiliaria/ajax/imovel',
        dataType: 'json',
        method: 'POST',
        data: { 'id_proprietario': id },
        success: function (retorno) {
            var append = '<option value="">Selecione</option>';
            var selected;
            $.each(retorno, function (key, value) {
                selected = '';
                if ($('#imovel').val() == value.id) {
                    selected = 'selected';
                }
                append += '<option ' + selected + ' value="' + value.id + '">' + value.rua + ", Nº" + value.numero + " - " + value.bairro + " - " + value.cidade + '</option>';
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