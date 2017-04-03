function AjaxForm() {
    this.jsonRegistros;
    this.infoPaginas;
    this.formulario;
    this.formularioPesquisa;
    this.urlApi;
    this.modoCRUD = "insert";
    this.colunas_tabela_propriedades_json;    
    this.containerTabela;
    this.relacao_campo_propriedade;
    this.relacao_campo_propriedade_pesquisa;
                    
    //--------------------------------- METODOS UTILITARIOS
    
    this.exibirIconeCarregamento = function() {        
        this.containerTabela.innerHTML = "";
        var icone_carregamento = document.createElement("img");
        icone_carregamento.src = "../img/loading_cityshare_black.gif";
        icone_carregamento.style.display = "block";
        icone_carregamento.style.margin = "0 auto";        
        
        $(this.containerTabela).append( icone_carregamento );
    }        
    
    this.atualizar_info_json = function(string_lista_json) {
        console.log(string_lista_json);
        this.jsonRegistros = $.parseJSON(string_lista_json);
        
        this.infoPaginas = this.jsonRegistros.pop();
        this.infoPaginas["totalPaginas"] = this.get_total_paginas();
    }
    
    this.ir_para_pagina = function(pagina_alvo) {
        this.exibirIconeCarregamento();
        
        var dados_para_api = new FormData();
        dados_para_api.append("numeroPagina", pagina_alvo);
        
        var ajax = new Ajax();
        
        var objeto_ajaxform = this;
        ajax.transferir_dados_para_api(objeto_ajaxform.urlApi, "POST", dados_para_api, function(dados_api) {                        
            objeto_ajaxform.atualizar_info_json( dados_api );
            objeto_ajaxform.inicializar(false);
        });
    }     
    
    this.get_input_by_name = function(nome, lista_input) {
        for(var i = 0; i < lista_input.length; ++i) {
            if( lista_input[i].name == nome ) return lista_input[i];
        }

        return null;
    }
    
    this.set_campos_formulario = function() {        
        var campos = this.formulario.elements;    
        
        console.log(this);
        for(var nome_campo in this.lista_chave_valor_formulario) {            
            var campo = this.get_input_by_name(nome_campo, campos);

            campo.value = this.lista_chave_valor_formulario[nome_campo];
        }
    }
    
    this.exibirTabela = function() {
        this.containerTabela.innerHTML = "";
        $(this.containerTabela).append( this.prepararTabela() );        
    };
    
    this.alterar_modo_crud_para = function(modo_crud) {
        if( modo_crud === "insert" ) {
            this.modoCRUD = modo_crud;
            
            $(this.formulario).removeClass("js-modo-update");
            $(this.formulario).addClass("js-modo-insert");
            
            
        } else if( modo_crud === "update" ) {
            this.modoCRUD = modo_crud;
            
            $(this.formulario).removeClass("js-modo-insert");
            $(this.formulario).addClass("js-modo-update");
            
            $('html, body').animate({
                scrollTop: $(this.formulario).offset().top-50 + 'px'
            }, 300);
        }
    }
    
    this.get_total_paginas = function() {        
        var total_paginas = this.infoPaginas["totalRegistros"]/this.infoPaginas["registrosPorPagina"];
                
        if( !Number.isInteger(total_paginas) ) {
            total_paginas = Math.ceil(total_paginas);
        }
        
        return total_paginas;
    };
    
    //--------------------------------- METODOS DE PREPARACAO
    
    this.prepararTabela = function() {        
        var conteudo_tabela = '<table class="ajax-form-table">';
        conteudo_tabela += '<tr id="head-line">';
        
        for( var i = 0; i < this.colunas_tabela_propriedades_json.length; ++i ) {
            var coluna = this.colunas_tabela_propriedades_json[i];
            conteudo_tabela += '<td class="form-coluna' + Number(i+1) + '">' + coluna.nome + '</td>';
        }
        
        conteudo_tabela += '<td class="form-coluna-acoes">Ações</td>';
        
        for( var i = 0; i < this.jsonRegistros.length; ++i ) {
            var registro = this.jsonRegistros[i];
            
            conteudo_tabela += '<tr class="registro">';
            
            var x = 0;
            for( x; x < this.colunas_tabela_propriedades_json.length; ++x ) {
                var campo = this.colunas_tabela_propriedades_json[x];
                
                conteudo_tabela += '<td class="form-campo' + Number(x+1) + '">' + registro[campo.propriedadeJson] + '</td>';
            }            
            
            conteudo_tabela += '<td class="form-campo' + Number(x+1) + '">'
            conteudo_tabela += '<span class="preset-botao botao-editar js-botao-editar">Editar</span>';
            conteudo_tabela += '</td>'
            conteudo_tabela += '</tr>';
        }
        
        conteudo_tabela += '</table>';
        
        var total_paginas = this.infoPaginas["totalPaginas"];
        conteudo_tabela += '<div id="box-table-paginas">';
                
        conteudo_tabela += '<span class="preset-botao botao-paginas" id="btn-prev">Anterior</span>';        
        conteudo_tabela += '<p id="info-pagina">' + this.infoPaginas["paginaAtual"] + ' - ' + total_paginas  + '</p>';
        conteudo_tabela += '<span class="preset-botao botao-paginas" id="btn-next">Próxima</span>';        
        
        var container_tabela = document.createElement("div");
        container_tabela.id = "container-ajax-form-table";
        
        container_tabela.innerHTML = conteudo_tabela;
        
        this.tabela = container_tabela;
        this.prepararBotoesPaginacao();
        return this.tabela;
    };
    
    this.prepararBotoesPaginacao = function() {
        var botao_proxima_pagina = $(this.tabela).find("#btn-next")[0];
        var botao_pagina_anterior = $(this.tabela).find("#btn-prev")[0];
        
        var proxima_pagina = this.infoPaginas["paginaAtual"] + 1;        

        var pagina_anterior = this.infoPaginas["paginaAtual"] - 1;        
                
        var objeto_ajaxform = this;
        
        if( this.infoPaginas["paginaAtual"] < this.infoPaginas["totalPaginas"] ) {
            $(botao_proxima_pagina).click(function() {

                objeto_ajaxform.ir_para_pagina(proxima_pagina);            
            });
        }
        
        if( pagina_anterior > 0 ) {
            $(botao_pagina_anterior).click(function() {

                objeto_ajaxform.ir_para_pagina(pagina_anterior);
            });
        }
    };
    
    this.prepararBotoesEdicao = function() {
        
        var self = this;
        $(this.tabela).off("click", ".bota-editar");
        $(this.tabela).on("click", ".botao-editar", function() {
            var registro_selecionado = $(this).parents(".registro")[0];            
            
            var lista_registros_tabela = $(self.tabela).find(".registro");
            
            var indice_registro_selecionado = lista_registros_tabela.index(registro_selecionado);
            
            var json_registro_selecionado = self.jsonRegistros[ indice_registro_selecionado ];
            
            $( self.formulario ).data( "id", json_registro_selecionado.id );
            
            var lista_dados_para_form = [];
            
            for( var i = 0; i < self.relacao_campo_propriedade.length; ++i ) {
                var campo_propriedade = self.relacao_campo_propriedade[i];
                
                lista_dados_para_form[ campo_propriedade.nomeCampo ] = json_registro_selecionado[ campo_propriedade.propriedade ];
            }
            
            self.lista_chave_valor_formulario = lista_dados_para_form;
            self.set_campos_formulario();
            self.alterar_modo_crud_para( "update" );
        });
    }
    
    this.prepararFormulario = function() {
        var botao_remocao = $(this.formulario).find(".js-botao-remocao")[0];
        
        var self = this;
        $(this.formulario).submit(function(e) {
            e.preventDefault();
            self.exibirIconeCarregamento();
            
            var dados_formulario = new FormData(this);            
            dados_formulario.append( "modo", self.modoCRUD );
                        
            if( self.modoCRUD === "update" ) {
                var id_registro_selecionado = $(self.formulario).data( "id" );                
                
                dados_formulario.append( "id", id_registro_selecionado );
            }
            
            var ajax = new Ajax();
            ajax.transferir_dados_para_api( self.urlApi, "POST", dados_formulario, function(dados_api) {
                $(self.formulario).trigger("reset");                                
                
                self.atualizar_info_json(dados_api);
                self.inicializar(false);
                
                if( self.modoCRUD === "update" ) {
                    $(self.formulario).removeData( "id" );
                    
                    self.alterar_modo_crud_para( "insert" );
                } 
            });            
        });
                
        $(this.formulario).on("reset", function() {
            $(self).removeData("id");            
            self.alterar_modo_crud_para( "insert" );
        });
                
        if( botao_remocao !== undefined ) {            
            $(botao_remocao).click(function() {
                self.exibirIconeCarregamento();
                
                var id_registro = $(self.formulario).data( "id" );                
                
                var dados_para_api = new FormData();
                dados_para_api.append( "id", id_registro );
                
                self.modoCRUD = "delete";
                dados_para_api.append( "modo", self.modoCRUD );
                
                var ajax = new Ajax();
                ajax.transferir_dados_para_api( self.urlApi, "POST", dados_para_api, function(dados_api) {
                    $(self.formulario).trigger("reset");
                    
                    self.atualizar_info_json(dados_api);
                    self.inicializar(false);
                });
            });
        }
    };
    
    this.prepararFormularioPesquisa = function() {
        
        if( this.formularioPesquisa !== undefined ) {
            var self = this;
            $(this.formularioPesquisa).submit(function(e){
                e.preventDefault();
                self.exibirIconeCarregamento();

                var dados_para_api = new FormData(this);
                dados_para_api.append( "modo", "pesquisa" );

                var ajax = new Ajax();            
                ajax.transferir_dados_para_api( self.urlApi, "POST", dados_para_api, function(dados_api) {                                
                    self.atualizar_info_json(dados_api);
                    self.inicializar(false);
                });
            });
        }
    }        
        
    this.inicializar = function(prepararFormularios=true) {
        this.exibirIconeCarregamento();        
        
        var self = this;
        $.ajax({url: this.urlApi, success: function(string_dados_api) {            
            if( prepararFormularios ) {
                self.atualizar_info_json( string_dados_api );            
                
                self.prepararFormulario();
                self.prepararFormularioPesquisa();                
            }                        
                                    
            self.exibirTabela();            
            self.prepararBotoesEdicao();
        }});
    }
}