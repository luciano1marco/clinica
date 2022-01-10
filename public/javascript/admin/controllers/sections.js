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

});