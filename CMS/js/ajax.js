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
    
    function construir_tabela_from_json(classe_tabela, id_colunas, lista_colunas, classes_registro, lista_dados_json, lista_botoes_operacao, info_paginacao) {        
        var conteudo_tabela = "<table";
        
        if( classe_tabela !== undefined ) {
            conteudo_tabela += ' class="' + classe_tabela + '"';
        }
        
        conteudo_tabela += ">";
        conteudo_tabela += '<tr id="' + id_colunas + '">';
        
        for( var i = 0; i < lista_colunas.length; ++i ) {
            conteudo_tabela += '<td class="' + lista_colunas[i].classes + '">' + lista_colunas[i].nome + '</td>';
        }
        
        for( var i = 0; i < lista_dados_json.length; ++i ) {
            var registro = lista_dados_json[i];
            
            conteudo_tabela += '<tr class="' + classes_registro + '">';
            for( var x = 0; x < lista_colunas.length; ++x ) {
                var campo = lista_colunas[x];                
                conteudo_tabela += '<td';
                
                if( campo.classes !== undefined ) {
                    conteudo_tabela += ' class="' + campo.classes + '"';
                }
                
                conteudo_tabela += '>' + registro[campo.campo] + '</td>';                                                
            }
            
            for( var z = 0; z < lista_botoes_operacao.length; ++z ) {
                var botao_operacao = lista_botoes_operacao[z];
                
                conteudo_tabela += '<td>';
                conteudo_tabela += '<span';
                
                if( botao_operacao.classes !== undefined ) {
                    conteudo_tabela += ' class="' + botao_operacao.classes + '"';
                }
                
                conteudo_tabela += '>' + botao_operacao.titulo + '</span>';
                conteudo_tabela += '</td>';                                
            }
            
            conteudo_tabela += '</tr>';
        }                
        
        conteudo_tabela += "</table>";
        
        var total_paginas = get_total_paginas(info_paginacao["totalRegistros"], info_paginacao["registrosPorPagina"]);
        conteudo_tabela += '<div id="box-paginas">';
        conteudo_tabela += '<span class="preset-botao botao-paginas" id="btn-prev">Anterior</span>';
        conteudo_tabela += '<p id="info-pagina">' + info_paginacao["paginaAtual"] + ' - ' + total_paginas + '</p>';
        conteudo_tabela += '<span class="preset-botao botao-paginas" id="btn-next">Próxima</span>';
        conteudo_tabela += '</div>';
        
        var container_tabela = document.createElement("div");
        container_tabela.id = "container_tabela_registros";        
        
        container_tabela.innerHTML = conteudo_tabela;        
        return container_tabela;
    }
                    
    function inicializar_ajax_modificacao_registro(formulario, url_api, nome_id_registro, callback) {                
        $(formulario).submit(function(e) {
            e.preventDefault();
            
            var dados_formulario = new FormData(this);
            
            var modo_crud_formulario = ( $(formulario).hasClass( "js-modo-insercao" ) )? "insert" : "update";
            dados_formulario.append( "modo", modo_crud_formulario );
            
            if( modo_crud_formulario === "update" ) {
                var id_registro_selecionado = $(formulario).data( nome_id_registro );
                dados_formulario.append( nome_id_registro, id_registro_selecionado );
            }
            
            ajax_transferir_dados_para_api(url_api, "POST", dados_formulario, function(dados_api) {
                if( callback !== undefined ) callback(dados_api);
                
                $(formulario).trigger("reset");
                
                if( modo_crud_formulario === "update" ) {
                    $(formulario).removeData( nome_id_registro );
                    
                    alterar_modo_formulario_para("insercao");
                }
            });
        });
        
        $(formulario).on("reset", function(e) {
            $(formulario).removeData( nome_id_registro );
        });
    }
    
    function inicializar_ajax_remocao_registro(form, botao_remocao, url_api, nome_id_registro, callback) {
        $(botao_remocao).click(function() {
            var id_registro = $(form).data( nome_id_registro );
            
            var dados_para_api = new FormData();
            dados_para_api.append( nome_id_registro, id_registro );
            dados_para_api.append( "modo", "delete" );
            
            ajax_transferir_dados_para_api(url_api, "POST", dados_para_api, function(dados_api) {
                if( callback !== undefined ) callback(dados_api);
                
                $(form).trigger( "reset" );
            });
        });
    }
    
    function exibir_tabela_registros(box_tabela, tabela) {
        box_tabela.innerHTML = "";
        $(box_tabela).append( tabela );
    }
    
    function get_pagina_registros( url_api, pagina_alvo, callback ) {
        var dados_para_api = new FormData();
        dados_para_api.append("numeroPagina", pagina_alvo);
        
        ajax_transferir_dados_para_api( url_api, "POST", dados_para_api, function(dados_api) {
            callback(dados_api);
        });
    }

    function capturar_info_paginacao(json_lista_veiculos) {
        var info_paginacao = json_lista_veiculos[ json_lista_veiculos.length-1 ];
        json_lista_veiculos.pop();
        
        return info_paginacao;
    }
    
    //------------------------------------------------------- FUNCOES AJAX        
    
    function ir_para_pagina_veiculo( pagina_alvo ) {
                
        get_pagina_registros( "apis/crud_veiculos.php", pagina_alvo, function(dados_api) {
            var pagina_veiculos = $("#pag-adm-veiculos")[0];
            exibir_lista_veiculos(pagina_veiculos, dados_api);
        });
    }
    
    function construir_tabela_veiculos(info_paginacao, lista_veiculos_json) {
        
        var lista_colunas = [
            {classes: "coluna-nome", nome: "Nome", campo: "nome"},
            {nome: "Tipo", campo: "tipo"},
            {nome: "Categoria", campo: "categoria"},
            {nome: "Fabricante", campo: "fabricante"},
            {nome: "Ano", campo: "ano"},
            {nome: "Preço", campo: "precoMedio"},
        ];
        
        var lista_botoes_operacao = [
            {classes: "preset-botao botao-editar", titulo: "Editar"}
        ];
        
        var tabela = construir_tabela_from_json("tabela-veiculos", "colunas-label", lista_colunas, "registro-veiculo", lista_veiculos_json, lista_botoes_operacao, info_paginacao);
        
        return tabela;
    }
    
    function inicializar_ajax_modificacao_veiculos() {                
        var pagina_veiculos = $("#pag-adm-veiculos")[0];
        
        if( pagina_veiculos !== undefined ) {            
            var formInfoVeiculo = $("#form-info-veiculo")[0];
                                    
            inicializar_ajax_modificacao_registro(formInfoVeiculo, "apis/crud_veiculos.php", "idVeiculo", function(string_json_lista_veiculos) {
                exibir_lista_veiculos(pagina_veiculos, string_json_lista_veiculos);
            });
        }
    }
            
    function inicializar_ajax_remocao_veiculos() {
        var pagina_veiculos = $("#pag-adm-veiculos")[0];
        
        if( pagina_veiculos !== undefined ) { 
            var formInfoVeiculo = $("#form-info-veiculo")[0];
            
            var botao_remocao = $(formInfoVeiculo).find("#botao-remover")[0];
                        
            inicializar_ajax_remocao_registro( formInfoVeiculo, botao_remocao, "apis/crud_veiculos.php", "idVeiculo", function(string_json_lista_veiculos) {
                exibir_lista_veiculos(pagina_veiculos, string_json_lista_veiculos);
            });
        }
    }        
            
    function exibir_lista_veiculos(pagina_veiculos, string_json_lista_veiculos) {        
        var box_listagem_veiculos = $(pagina_veiculos).find("#box-listagem-veiculos")[0];
                                        
        var json_lista_veiculos = JSON.parse(string_json_lista_veiculos);
        
        var info_paginacao = capturar_info_paginacao(json_lista_veiculos)
                        
        var pagina_atual = info_paginacao["paginaAtual"];
        var registros_por_pagina = info_paginacao["registrosPorPagina"];
        var total_registros = info_paginacao["totalRegistros"];                
        
        var tabela = construir_tabela_veiculos(info_paginacao, json_lista_veiculos);
        
        exibir_tabela_registros( box_listagem_veiculos, tabela );
        
        inicializar_botao_edicao_veiculos(json_lista_veiculos);        
        inicializar_botoes_paginacao_veiculos(pagina_atual, registros_por_pagina, total_registros, ir_para_pagina_veiculo);
    }
            
    function inicializar_lista_veiculos() {
        var pagina_veiculos = $("#pag-adm-veiculos")[0];
        
        if( pagina_veiculos !== undefined ) {
            $.ajax({url: 'apis/crud_veiculos.php', success: function(dados_api) {                
                exibir_lista_veiculos(pagina_veiculos, dados_api);
            }});
        }
    }
    
    //------------------------------------------------------- FUNCOES ADM VEICULOS        
    
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
            
            ajax_transferir_dados_para_api("apis/crud_tipo_veiculo.php", "POST", null, function(dados_api) {
                exibir_lista_tipo(pagina_tipo, dados_api);
            });
            
            /*$.ajax({url: 'apis/crud_tipo_veiculo.php', success: function(dados_api) {                
                
            }});*/
        }
    }
    
    //------------------------------------------------------- FUNCOES ADM TIPO DE VEICULOS
    
    inicializar_lista_veiculos();
    inicializar_ajax_modificacao_veiculos();
    preparar_formulario_edicao_veiculos();
    inicializar_ajax_remocao_veiculos();
    inicializar_ajax_modificacao_tipo();
    inicializar_ajax_remocao_tipo();
    inicializar_lista_tipos();
});