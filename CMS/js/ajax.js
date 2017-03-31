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
                                <span class="preset-botao botao-paginas" href="#">Anterior</span>\
                                <p id="info-pagina">1 - 5</p>\
                                <span class="preset-botao botao-paginas" href="#">Próxima</span>\
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
                
                transferir_dados_formulario_ajax("apis/crud_veiculos.php", "POST", dados_formulario, function(dados) {
                    var box_listagem_veiculos = $(pagina_veiculos).find("#box-listagem-veiculos")[0];
                                        
                    var json = JSON.parse(dados);
                    var tabela = construir_tabela_veiculos(json);
                    box_listagem_veiculos.innerHTML = "";
                    $(box_listagem_veiculos).append( tabela );
                    
                    $(formInfoVeiculo).trigger("reset");
                    
                    if( modo_formulario === "update" ) {
                        $(formInfoVeiculo).removeData("idVeiculo");
                    }
                });
            });
            
        }
    }
    
    function inicializar_lista_veiculos() {
        var pagina_veiculos = $("#pag-adm-veiculos")[0];
        
        if( pagina_veiculos !== undefined ) {
            $.ajax({url: 'apis/crud_veiculos.php', success: function(dados_api) {
                var box_listagem_veiculos = $(pagina_veiculos).find("#box-listagem-veiculos")[0];
                
                var json = JSON.parse(dados_api);                
                $(box_listagem_veiculos).append(construir_tabela_veiculos(json));
                inicializar_botao_edicao_veiculos(json);
            }});
        }
    }
    
    inicializar_lista_veiculos();
    inicializar_ajax_modificacao_veiculos();
});