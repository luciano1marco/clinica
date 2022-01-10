$(document).ready(function() {
    $('#datatable').DataTable({
        'language': { 'url': '../assets/plugins/datatables/portugues-br.json' },
        'paging': true,
        'ordering': true,
        'info': true,
        'searching': true,
        'autoWidth': true,
        //'scrollX': true,
    });

    $(".alert").delay(2000).slideUp(200, function() {
        $(this).alert('close');
    });

    $('.icheck').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '40%' // optional
    });

    if ($(".selectpicker").length) {
        $('.selectpicker').selectpicker({
            iconBase: 'fa',
            tickIcon: 'fa-check'
        });
    }

    $.each($(".selectpicker option"), function(e) {
        var icon = ($(this).attr("value"));
        $(this).attr("data-icon", "fa-" + icon);

        var flag = false;

        if ($(".selectpicker")[0].selectedIndex <= 0) {
            flag = false;
        } else {
            flag = true
        }

        //Se e verdadeiro tem Valor selecionado e tem que dar um render para aparecer o Ícone
        if (flag === true) {
            $('.selectpicker').selectpicker('render');
        }
        //Caso não deixa o titulo padrão
    });

});