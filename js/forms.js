$(document).ready(function() {
    
    function inicializar_form_publicacao() {
        var pagina_publicacao_veiculos = $("#pag-publicar")[0];
        
        if( pagina_publicacao_veiculos !== undefined ) {
            var select_tipo_veiculo = $(".js-select-tipo-veiculo")[0];
            var select_fabricante = $(".js-select-fabricante")[0];
            var select_veiculo = $(".js-select-veiculo")[0];
            var select_combustivel = $(".js-select-combustivel")[0];
            var select_transmissao = $(".js-select-transmissao")[0];
            
            $(select_tipo_veiculo).change(function() {
                var id_tipo_veiculo = select_tipo_veiculo.value;
                
                var dados_api = new FormData();
                dados_api.append( "idTipoVeiculo", id_tipo_veiculo );
                
                var ajax = new Ajax();
                ajax.transferir_dados_para_api("apis/get_fabricantes.php", "POST", dados_api, function(resultado) {
                    select_fabricante.innerHTML = resultado;
                                                            
                    $(select_fabricante).trigger("change");
                });
                
                ajax.transferir_dados_para_api("apis/get_combustiveis.php", "POST", dados_api, function(resultado) {                   
                    select_combustivel.innerHTML = resultado;                                                                                
                    $(select_combustivel).trigger("change");
                });
                
                ajax.transferir_dados_para_api("apis/get_transmissoes.php", "POST", dados_api, function(resultado) {
                    select_transmissao.innerHTML = resultado;                                                            
                    
                    $(select_transmissao).trigger("change");
                });                
            });
            
            $(select_fabricante).change(function() {                                
                var id_fabricante = select_fabricante.value;
                
                var dados_api = new FormData();
                dados_api.append( "idFabricante", id_fabricante );
                
                var ajax = new Ajax();
                ajax.transferir_dados_para_api("apis/get_veiculos.php", "POST", dados_api, function(resultado) {
                     select_veiculo.innerHTML = resultado;
                });
            });
        }
    }
    
    inicializar_form_publicacao();
});