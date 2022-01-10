(function(w, d, u) {

    // Define duas queues para os handlers
    w.readyQ = [];
    w.bindReadyQ = [];

    // Insere um handler na queues correta
    function pushToQ(x, y) {
        if (x == "ready") {
            w.bindReadyQ.push(y);
        } else {
            w.readyQ.push(x);
        }
    }

    // Define um objeto alias (para uso posterior)
    var alias = {
        ready: pushToQ,
        bind: pushToQ
    }

    // Definir a função jQuery "fake" para capturar os handlers
    w.$ = w.jQuery = function(handler) {
        if (handler === d || handler === u) {
            // Coloca na queue $(document).ready(handler), $().ready(handler)
            // e $(document).bind("ready", handler), retornando um objeto com
            // os métodos de "alias" para pushToQ
            return alias;
        } else {
            // Queue $(handler)
            pushToQ(handler);
        }
    }

})(window, document);