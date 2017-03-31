$(document).ready(function() {
    
    function transferir_dados_formulario_ajax(url, metodo, dados, callback) {
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
    }
    
    function inicializar_ajax_cadastro_veiculos() {                
        var pagina_veiculos = $("#pag-adm-veiculos")[0];
        
        if( pagina_veiculos !== undefined ) {            
            var formInfoVeiculo = $("#form-info-veiculo")[0];
            
            $(formInfoVeiculo).submit(function(e) {
                e.preventDefault();
                
                var dados_formulario = new FormData(this);
                dados_formulario.append("modo", "insert");
                
                transferir_dados_formulario_ajax("apis/crud_veiculos.php", "POST", dados_formulario, function(dados) {
                    console.log(dados);
                });
            });
            
        }
    }
    
    inicializar_ajax_cadastro_veiculos();
});