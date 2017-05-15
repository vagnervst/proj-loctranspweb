function Ajax() {

    this.transferir_dados_para_api = function(url, metodo, dados, callback) {
        var ajax = $.ajax({
            url: url,
            method: metodo,
            data: dados,
            contentType: false,
            processData: false,
            success: function(dados_retorno) {
                if( callback !== undefined ) callback(dados_retorno);
            }
        });
        
        return ajax;
    }
}
