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
            var select_combustivel = $(".js-select-combustivel")[0];
            var select_transmissao = $(".js-select-transmissao")[0];
            var select_portas = $(".js-select-portas")[0];
            var select_veiculo = $(".js-select-veiculo")[0];
            
            var box_acessorio = $(".box-acessorios")[0];
            
            var ajaxFabricante;
            var ajaxCombustivel;
            var ajaxTransmissao;
            var ajaxAcessorios;
            $(select_tipo_veiculo).change(function() {                
                ajaxFabricante = relacionar_selects(this, select_fabricante, "apis/get_fabricantes.php", "idTipoVeiculo");
                ajaxCombustivel = relacionar_selects(this, select_combustivel, "apis/get_combustiveis.php", "idTipoVeiculo");
                ajaxTransmissao = relacionar_selects(this, select_transmissao, "apis/get_transmissoes.php", "idTipoVeiculo");                                
                
                ajaxAcessorios = new Ajax();
                var data = new FormData();
                data.append("idTipoVeiculo", this.value);
                
                ajaxAcessorios.transferir_dados_para_api("apis/get_acessorios.php", "POST", data, function(resultado) {
                    box_acessorio.innerHTML = resultado;    
                });
                
            });
            
            $( ".js-select-tipo-veiculo, .js-select-fabricante, .js-select-combustivel, .js-select-transmissao, .js-select-portas" ).change( function(e) {
                
                var lista_ajax = [ajaxFabricante, ajaxCombustivel, ajaxTransmissao];
                
                $.when( lista_ajax ).done(function() {
                
                    var data = new FormData();
                    if( !Number.isNaN( Number.parseInt(select_tipo_veiculo.value) ) ) {                    
                        data.append("idTipo", select_tipo_veiculo.value);
                    }

                    if( !Number.isNaN( Number.parseInt(select_fabricante.value) ) ) {                    
                        data.append("idFabricante", select_fabricante.value);
                    }

                    if( !Number.isNaN( Number.parseInt(select_combustivel.value) ) ) {                    
                        data.append("idCombustivel", select_combustivel.value);
                    }

                    if( !Number.isNaN( Number.parseInt(select_transmissao.value) ) ) {                    
                        data.append("idTransmissao", select_transmissao.value);
                    }

                    if( !Number.isNaN( Number.parseInt(select_portas.value) ) ) {                    
                        data.append("qtdPortas", select_portas.value);
                    }

                    var ajax = new Ajax();
                    ajax.transferir_dados_para_api("apis/get_veiculos.php", "POST", data, function(resultado) {
                        $(select_veiculo).removeAttr("disabled");
                        select_veiculo.innerHTML = resultado;                    

                        if( $(select_veiculo).children().length === 1 ) {
                            $(select_veiculo).attr("disabled", "true");
                        }

                    });
                    
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