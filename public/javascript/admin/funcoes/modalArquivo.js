$("#modalArquivo").bind("click", function (event) {
    $("#modal_arquivo").modal();
});

$("#modalArquivoEtapa").bind("click", function (event) {
    $("#modal_arquivo_etapa").modal();
});

$("#btExcluirConfirmar").bind("click", function (event) {
    if ($("#base_url").val() != undefined &&
    $("#controlador").val() != undefined &&
    $("input[name = id]")[0].value != undefined) {
        window.location.href =  ($("#base_url").val() + "admin/" + $("#controlador").val() + "/delete/?id=" + $("input[name = id]")[0].value);
    }
});

$("#btExcluirConfirmarEtapa").bind("click", function (event) {
    if ($("#base_url").val() != undefined &&
    $("#controlador").val() != undefined &&
    $("input[name = id]")[0].value != undefined) {
        window.location.href =  ($("#base_url").val() + "admin/" + $("#controlador").val() + "/deleteetapa/?id=" + $("input[name = id]")[0].value);
    }
});
