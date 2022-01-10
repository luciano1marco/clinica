$(document).ready(function() {

    $('#datatable').DataTable({
        'language': { 'url': '../assets/plugins/datatables/portugues-br.json' },
        'paging': true,
        'ordering': true,
        'info': true,
        'searching': true,
        'autoWidth': true,
        //'scrollX': true,
        "columnDefs": [
            { "width": "20%", "targets": 3 }
        ]
    });

    $(".alert").delay(2000).slideUp(200, function() {
        $(this).alert('close');
    });

    $('.icheck').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '40%' // optional
    });

    if ($('#cor').length) {
        var elem = $('#cor');

        elem.ColorPickerSliders({
            size: 'lg',
            placement: 'auto bottom',
            previewformat: 'hex',
            color: elem.attr('data-src'),
            swatches: ['#FFFFFF', '#F44336', '#E91E63', '#9C27B0', '#673AB7', '#3F51B5', '#2196F3', '#009688', '#FF5722', '#795548', '#607D8B', '#000000'],
            //swatches: getColorNames(),
            customswatches: false,
            order: {}
        });

        $('button[type="reset"]').on('click', function(e) {
            elem.trigger('colorpickersliders.updateColor', elem.attr('data-src'));
        });
    }

});