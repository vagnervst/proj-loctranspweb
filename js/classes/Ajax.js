function Ajax() {
        
    this.transferir_dados_para_api = function(url, metodo, dados, callback) {
        $.ajax({
            url: url,
            method: metodo,
            data: dados,
            contentType: false,
            processData: false,            
            success: function(dados_retorno) {                        
                if( callback !== undefined ) callback(dados_retorno);
            }
        });
    };
    
    this.conectar = function(url, callback) {
        $.ajax({
            url: url,
            method: "GET",
            contentType: false,
            processData: false,
            success: function(retorno) {
                if( callback !== undefined ) callback( retorno );
            }
        })
    };
}