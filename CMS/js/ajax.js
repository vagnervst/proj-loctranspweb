$(document).ready(function() {
             
    function inicializar_lista_veiculos() {
        var pagina_veiculos = $("#pag-adm-veiculos")[0];
        
        if( pagina_veiculos !== undefined ) {            
            
            var formulario_veiculos = new AjaxForm();            

            formulario_veiculos.colunas_tabela_propriedades_json = [
                {nome: "Nome", propriedadeJson: "nome"},
                {nome: "Tipo", propriedadeJson: "tipo"},
                {nome: "Categoria", propriedadeJson: "categoria"},
                {nome: "Fabricante", propriedadeJson: "fabricante"},
                {nome: "Ano", propriedadeJson: "ano"},
                {nome: "Preço", propriedadeJson: "precoMedio"},
            ];                                               

            var box_listagem_veiculos = $(pagina_veiculos).find("#box-listagem-veiculos")[0];

            formulario_veiculos.urlApi = "apis/crud_veiculos.php";                
            formulario_veiculos.containerTabela = box_listagem_veiculos;
            formulario_veiculos.formulario = $("#form-info-veiculo")[0];
            formulario_veiculos.formularioPesquisa = $("#box-filtragem-veiculos form")[0];

            formulario_veiculos.relacao_campo_propriedade = [
                { nomeCampo : 'txtNome', propriedade : 'nome' },
                { nomeCampo : 'txtPortas', propriedade : 'qtdPortas' },
                { nomeCampo : 'txtMotor', propriedade : 'tipoMotor' },
                { nomeCampo : 'txtAno', propriedade : 'ano' },
                { nomeCampo : 'slTransmissao', propriedade : 'idTransmissao' },
                { nomeCampo : 'txtPrecoMedio', propriedade : 'precoMedio' },
                { nomeCampo : 'slFabricante', propriedade : 'idFabricante' },
                { nomeCampo : 'slCombustivel', propriedade : 'idTipoCombustivel' },
                { nomeCampo : 'slTipo', propriedade : 'idTipoVeiculo' },
                { nomeCampo : 'slCategoria', propriedade : 'idCategoriaVeiculo' },
            ];

            formulario_veiculos.relacao_campo_propriedade_pesquisa = [
                { nomeCampo : 'txtCod', propriedade: 'id' },
                { nomeCampo : 'txtPrecoMinimo', propriedade: 'precoMedio' },
                { nomeCampo : 'slTipo', propriedade: 'idTipoVeiculo' },
                { nomeCampo : 'slFabricante', propriedade: 'idFabricante' },
                { nomeCampo : 'txtNome', propriedade: 'nome' },
                { nomeCampo : 'slCategoria', propriedade: 'idCategoriaVeiculo' },
                { nomeCampo : 'slCombustivel', propriedade: 'idTipoCombustivel' }
            ];

            formulario_veiculos.inicializar();
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
            
            var formulario_tipos_veiculo = new AjaxForm();            

            formulario_tipos_veiculo.colunas_tabela_propriedades_json = [
                {nome: "Titulo", propriedadeJson: "titulo"}                
            ];                                               

            var box_listagem_tipos = $(pagina_tipo).find(".box-listagem-tipo")[0];
            console.log(box_listagem_tipos);
            
            formulario_tipos_veiculo.urlApi = "apis/crud_tipo_veiculo.php";                
            formulario_tipos_veiculo.containerTabela = box_listagem_tipos;
            formulario_tipos_veiculo.formulario = $("#form-modificacao")[0];
            //formulario_tipos_veiculo.formularioPesquisa = null;

            formulario_tipos_veiculo.relacao_campo_propriedade = [
                { nomeCampo : 'txtTipoVeiculo', propriedade : 'titulo' }
            ];

            /*formulario_tipos_veiculo.relacao_campo_propriedade_pesquisa = [
                { nomeCampo : 'txtCod', propriedade: 'id' },
                { nomeCampo : 'txtPrecoMinimo', propriedade: 'precoMedio' },
                { nomeCampo : 'slTipo', propriedade: 'idTipoVeiculo' },
                { nomeCampo : 'slFabricante', propriedade: 'idFabricante' },
                { nomeCampo : 'txtNome', propriedade: 'nome' },
                { nomeCampo : 'slCategoria', propriedade: 'idCategoriaVeiculo' },
                { nomeCampo : 'slCombustivel', propriedade: 'idTipoCombustivel' }
            ];*/

            formulario_tipos_veiculo.inicializar();                                              
        }
    }
    
    //------------------------------------------------------- FUNCOES ADM TIPO DE VEICULOS
    
    inicializar_lista_veiculos();    
    inicializar_lista_tipos();
});