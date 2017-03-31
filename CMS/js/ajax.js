$(document).ready(function() {
    
    function ajax_transferir_dados_para_api(url, metodo, dados, callback) {
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
    
    function construir_tabela_veiculos(lista_veiculos_json) {
    
        var conteudo_tabela = "";
        for( var i = 0; i < lista_veiculos_json.length; ++i ) {
            var registro = lista_veiculos_json[i];
            
            conteudo_tabela += '<tr class="registro-veiculo">\
                            <td class="coluna-nome">' + registro.nome + '</td>\
                            <td>' + registro.tipo + '</td>\
                            <td>' + registro.categoria + '</td>\
                            <td>' + registro.fabricante + '</td>\
                            <td>' + registro.ano + '</td>\
                            <td>' + registro.precoMedio + '</td>\
                            <td><span class="preset-botao botao-editar">Editar</span></td>\
                        </tr>';
        }                
        
        
        conteudo_tabela += '<div id="box-paginas">\
                                <span class="preset-botao botao-paginas" id="btn-prev">Anterior</span>\
                                <p id="info-pagina">1 - 5</p>\
                                <span class="preset-botao botao-paginas" id="btn-next">Próxima</span>\
                            </div>'
        
        var tabela = document.createElement("table");
            tabela.className = "tabela-veiculos";
            tabela.innerHTML = '<tr id="colunas-label">\
                                    <td class="coluna-nome">Nome</td>\
                                    <td>Tipo</td>\
                                    <td>Categoria</td>\
                                    <td>Fabricante</td>\
                                    <td>Ano</td>\
                                    <td>Preço</td>\
                                    <td>Operações</td>\
                                </tr>' + conteudo_tabela;
        
                
        return tabela;
    }
    
    function ir_para_pagina( pagina_alvo ) {
        var dados = new FormData();
        dados.append("numeroPagina", pagina_alvo);
        
        ajax_transferir_dados_para_api("apis/crud_veiculos.php", "POST", dados, function(dados_api) {
            
            var pagina_veiculos = $("#pag-adm-veiculos")[0];
            exibir_lista_veiculos(pagina_veiculos, dados_api)
        });
    }
    
    function inicializar_ajax_modificacao_veiculos() {                
        var pagina_veiculos = $("#pag-adm-veiculos")[0];
        
        if( pagina_veiculos !== undefined ) {            
            var formInfoVeiculo = $("#form-info-veiculo")[0];
            
            $(formInfoVeiculo).submit(function(e) {
                e.preventDefault();
                                                
                var dados_formulario = new FormData(this);
                
                var modo_formulario = ( $(formInfoVeiculo).hasClass("js-modo-insercao") )? "insert" : "update";
                dados_formulario.append("modo", modo_formulario);
                
                if( modo_formulario === "update" ) {
                    var id_registro_selecionado = $(formInfoVeiculo).data("idVeiculo");
                    dados_formulario.append("idVeiculo", id_registro_selecionado);
                }
                
                ajax_transferir_dados_para_api("apis/crud_veiculos.php", "POST", dados_formulario, function(dados_api) {
                    exibir_lista_veiculos(pagina_veiculos, dados_api);
                    
                    $(formInfoVeiculo).trigger("reset");
                    
                    if( modo_formulario === "update" ) {
                        $(formInfoVeiculo).removeData("idVeiculo");
                    }
                });
            });            
        }
    }
    
    function inicializar_ajax_remocao_veiculos() {
        var pagina_veiculos = $("#pag-adm-veiculos")[0];
        
        if( pagina_veiculos !== undefined ) { 
            var formInfoVeiculo = $("#form-info-veiculo")[0];
            
            var botao_remocao = $(formInfoVeiculo).find("#botao-remover")[0];
            
            $(botao_remocao).click(function() {
                var idVeiculo = $(formInfoVeiculo).data("idVeiculo");
                
                var dados = new FormData();
                dados.append("idVeiculo", idVeiculo);
                dados.append("modo", "delete");
                
                ajax_transferir_dados_para_api("apis/crud_veiculos.php", "POST", dados, function(dados_api) {
                    exibir_lista_veiculos(pagina_veiculos, dados_api);                    
                    
                    $(formInfoVeiculo).trigger("reset");
                });
            });
        }
    }
    
    function capturar_info_paginacao(json_lista_veiculos) {
        var info_paginacao = json_lista_veiculos[ json_lista_veiculos.length-1 ];
        json_lista_veiculos.pop();
        
        return info_paginacao;
    }
    
    function exibir_lista_veiculos(pagina_veiculos, string_json_lista_veiculos) {
        var box_listagem_veiculos = $(pagina_veiculos).find("#box-listagem-veiculos")[0];
                                        
        var json_lista_veiculos = JSON.parse(string_json_lista_veiculos);        
        
        var info_paginacao = capturar_info_paginacao(json_lista_veiculos);        
        
        var tabela = construir_tabela_veiculos(json_lista_veiculos);
        box_listagem_veiculos.innerHTML = "";
        $(box_listagem_veiculos).append( tabela );        
        
        inicializar_botao_edicao_veiculos(json_lista_veiculos);        
        inicializar_botoes_paginacao(info_paginacao["paginaAtual"], info_paginacao["registrosPorPagina"], info_paginacao["totalRegistros"], ir_para_pagina);
    }
            
    function inicializar_lista_veiculos() {
        var pagina_veiculos = $("#pag-adm-veiculos")[0];
        
        if( pagina_veiculos !== undefined ) {
            $.ajax({url: 'apis/crud_veiculos.php', success: function(dados_api) {                
                exibir_lista_veiculos(pagina_veiculos, dados_api);
            }});
        }
    }
    
    //-------------------------------------------- TIPO DE VEICULO
    
    function construir_tabela_tipo_veiculo(json_lista_tipo) {
        
        var conteudo_tabela = "";        
        for(var i = 0; i < json_lista_tipo.length; ++i) {
            conteudo_tabela += '<tr class="registro-tipo">'
            conteudo_tabela += '<td>' + json_lista_tipo[i].titulo + '</td>'
            conteudo_tabela += '<td><span class="preset-botao botao-editar">Editar</span></td>'
            conteudo_tabela += '</tr>'
        }
        
        var tabela = document.createElement("table");
        tabela.className = "tabela-tipo";
        
        tabela.innerHTML = '<tr id="colunas-label">\
                                <td class="coluna-tipo">Tipo</td>\
                                <td>Operações</td>\
                            </tr>' + conteudo_tabela;                
        
        return tabela;
    }
    
    function exibir_lista_tipo(pagina, json_lista_tipo) {        
        var json = JSON.parse(json_lista_tipo);
        
        var tabela_resultante = construir_tabela_tipo_veiculo(json);
        var box_listagem_tipo = $(".box-listagem-tipo")[0];
        
        box_listagem_tipo.innerHTML = "";
        $(box_listagem_tipo).append(tabela_resultante);
        
        inicializar_botao_edicao_tipo(json);
    }
    
    function inicializar_ajax_modificacao_tipo() {
        var pagina_tipo = $("#pag-tipo-veiculo")[0];
        
        if( pagina_tipo !== undefined ) {
            var form = $(pagina_tipo).find("#form-modificacao")[0];
            
            $(form).submit(function(e) {
                e.preventDefault();
                
                var modo_formulario = ( $(this).hasClass("js-modo-insercao") )? "insert" : "update";
                
                var dados_formulario = new FormData(this);
                dados_formulario.append("modo", modo_formulario);
                
                if( modo_formulario === "update" ) {
                    var idTipo =  $(form).data("idTipo");
                    dados_formulario.append("idTipo", idTipo);
                }
                
                ajax_transferir_dados_para_api("apis/crud_tipo_veiculo.php", "POST", dados_formulario, function(dados_api) {                    
                    exibir_lista_tipo(pagina_tipo, dados_api);
                    
                    if( modo_formulario === "update" ) {
                        $(form).removeData("idTipo");
                        $(form).addClass("js-modo-insercao");
                        $(form).removeClass("js-modo-edicao");
                    }
                });
            });
        }
    }
    
    function inicializar_ajax_remocao_tipo() {
        var pagina_tipo = $("#pag-tipo-veiculo")[0];
        
        if( pagina_tipo !== undefined ) { 
            var form = $(pagina_tipo).find("#form-modificacao")[0];
            
            var botao_remocao = $(form).find("#botao-remover")[0];
            
            $(botao_remocao).click(function() {                
                var idTipo =  $(form).data("idTipo");
                
                var dados = new FormData();
                dados.append("idTipo", idTipo);
                dados.append("modo", "delete");
                
                ajax_transferir_dados_para_api("apis/crud_tipo_veiculo.php", "POST", dados, function(dados_api) {                    
                    exibir_lista_tipo(pagina_tipo, dados_api);
                    
                    $(form).trigger("reset");
                    $(form).removeData("idTipo");
                    $(form).addClass("js-modo-insercao");
                    $(form).removeClass("js-modo-edicao");
                });
            });
        }
    }
    
    function inicializar_lista_tipos() {
        var pagina_tipo = $("#pag-tipo-veiculo")[0];
        
        if( pagina_tipo !== undefined ) {
            $.ajax({url: 'apis/crud_tipo_veiculo.php', success: function(dados_api) {                
                exibir_lista_tipo(pagina_tipo, dados_api);
            }});
        }
    }
    
    //--------------------------------------------
    
    inicializar_lista_veiculos();
    inicializar_ajax_modificacao_veiculos();
    preparar_formulario_edicao_veiculos();
    inicializar_ajax_remocao_veiculos();
    inicializar_ajax_modificacao_tipo();
    inicializar_ajax_remocao_tipo();
    inicializar_lista_tipos();
});