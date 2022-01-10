$("#btExcluir").bind("click", function (event) {
    $("#modal_delete").modal();
});

$("#btExcluirConfirmar").bind("click", function (event) {
    if ($("#base_url").val() != undefined &&
    $("#controlador").val() != undefined &&
    $("input[name = id]")[0].value != undefined) {
        window.location.href =  ($("#base_url").val() + "admin/" + $("#controlador").val() + "/deleteyes/" + $("input[name = id]")[0].value);
    }
});

$("#btExcluirdiagnostico").bind("click", function (event) {
    if ($("#base_url").val() != undefined &&
    $("#controlador").val() != undefined &&
    $("input[name = id]")[0].value != undefined) {
        window.location.href =  ($("#base_url").val() + "admin/Usuariorede/deletdiagnostico/" + $("input[name = id]")[0].value);
    }
});

$("#btExcluirestrategia").bind("click", function (event) {
    if ($("#base_url").val() != undefined &&
    $("#controlador").val() != undefined &&
    $("input[name = id]")[0].value != undefined) {
        window.location.href =  ($("#base_url").val() + "admin/Usuariorede/deletestrategia/" + $("input[name = id]")[0].value);
    }
});

$("#btExcluirrefer").bind("click", function (event) {
    if ($("#base_url").val() != undefined &&
    $("#controlador").val() != undefined &&
    $("input[name = id]")[0].value != undefined) {
        window.location.href =  ($("#base_url").val() + "admin/Usuariorede/deletrefer/" + $("input[name = id]")[0].value);
    }
});