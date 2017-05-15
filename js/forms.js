$(document).ready(function() {
    
    function relacionar_selects(selectBase, selectAlvo, url_api, nome_campo, callback) {
        var ajax = new Ajax();

        var valor = selectBase.value;
        var dados = new FormData();
        dados.append(nome_campo, valor);

        var jqueryAjax = ajax.transferir_dados_para_api(url_api, 'POST', dados, function(resultado) {
            $(selectAlvo).removeAttr("disabled");
            selectAlvo.innerHTML = resultado;

            if( $(selectAlvo).children().length == 1 ) {
                $(selectAlvo).attr("disabled", "true");
            }

            if( callback !== undefined ) callback();
        });

        return jqueryAjax;
    }
    
    function inicializar_form_publicacao() {
        var pagina_publicacao_veiculos = $("#pag-publicar")[0];
        
        if( pagina_publicacao_veiculos !== undefined ) {
            var select_tipo_veiculo = $(".js-select-tipo-veiculo")[0];
            var select_fabricante = $(".js-select-fabricante")[0];
            var select_veiculo = $(".js-select-veiculo")[0];
            var select_combustivel = $(".js-select-combustivel")[0];
            var select_transmissao = $(".js-select-transmissao")[0];            
            var box_acessorio = $(".box-acessorios")[0];
            
            $(select_tipo_veiculo).change(function() {                
                relacionar_selects(this, select_fabricante, "apis/get_fabricantes.php", "idTipoVeiculo");                
            });
            
            $(select_fabricante).change(function() {
                relacionar_selects(this, select_veiculo, "apis/get_veiculos.php", "idFabricante");                                
            });
            
            $( select_veiculo ).change(function(e) {            
                var id_veiculo = select_veiculo.value;
                
                var dados_api = new FormData();
                dados_api.append("idVeiculo", id_veiculo);
                
                var ajax = new Ajax();                
                ajax.transferir_dados_para_api("apis/get_combustiveis.php", "POST", dados_api, function(resultado) {                   
                    select_combustivel.innerHTML = resultado;
                    $(select_combustivel).trigger("change");
                });
            });
            
            $( select_combustivel ).change(function() {
                var id_veiculo = select_veiculo.value;
                var id_combustivel = select_combustivel.value;
                
                var dados_api = new FormData();
                dados_api.append( "idVeiculo", id_veiculo );
                dados_api.append( "idTipoCombustivel", id_combustivel );
                
                var ajax = new Ajax();
                ajax.transferir_dados_para_api("apis/get_transmissoes.php", "POST", dados_api, function(resultado) {                    
                    select_transmissao.innerHTML = resultado;
                });
            });
        }
    }
    
    function inicializar_form_cadastro() {
        var pagina_cadastro_usuario = $("#pag-cadastro")[0];
        
        if ( pagina_cadastro_usuario !== undefined ) {
            var select_estado = $(".js-select-estado")[0];
            var select_cidade = $(".js-select-cidade")[0];
            
            $(select_estado).change(function() {
                var id_estado = select_estado.value;
                
                var dados_api = new FormData();
                
                dados_api.append( "idEstado", id_estado );
                
                var ajax = new Ajax();
                ajax.transferir_dados_para_api("apis/get_cidades.php", "POST", dados_api, function(resultado) {
                    select_cidade.innerHTML = resultado;
                    
                    $(select_cidade).trigger("change");
                });
            });
        }
    }
    
    inicializar_form_cadastro();
    inicializar_form_publicacao();
});