function get_input_by_name(nome, lista_input) {
    for(var i = 0; i < lista_input.length; ++i) {
        if( lista_input[i].name == nome ) return lista_input[i];
    }
    
    return null;
}

function alterar_modo_formulario_para(formulario, modo) {    
    if( modo === "edicao" ) {
        console.log("ALTERANDO PARA EDICAO");
        $( formulario ).addClass( "js-modo-edicao" );
        $( formulario ).removeClass( "js-modo-insercao" );
    } else if( modo === "insercao" ) {
        console.log("ALTERANDO PARA INSERCAO");
        $( formulario ).addClass( "js-modo-insercao" );
        $( formulario ).removeClass( "js-modo-edicao" );
    }
}

function set_campos_formulario(formulario, lista_chave_valor) {
    var campos = formulario.elements;    
    
    for(var nome_campo in lista_chave_valor) {
        var campo = get_input_by_name(nome_campo, campos);
        
        campo.value = lista_chave_valor[nome_campo];
    }
}

function get_campos_formulario(formulario) {
    var campos_formulario = formulario.elements;
    
    var name_campos = [];
    for( var i = 0; i < campos_formulario.length; ++i ) {
        var campo = campos_formulario[i];
                
        if( campo.name !== undefined && campo.name.length > 0 && campo.type !== "submit" && campo.type !== "reset" ) name_campos.push(campo.name);
    }
    
    return name_campos;
}

function inicializar_botao_edicao_registro(pagina_listagem_registros, formulario_edicao_registro, nome_campo_id_registro, classe_botao_edicao, classe_tr_registro, lista_relacao_campo_propriedade, lista_tr_registros, json_lista_registros) {
    $(pagina_listagem_registros).off("click", classe_botao_edicao);
    
    $(pagina_listagem_registros).on("click", classe_botao_edicao, function() {
        var registro = $(this).parents(classe_tr_registro)[0];
        
        var indice_registro_selecionado = lista_tr_registros.index(registro);
        
        var json_registro_selecionado = json_lista_registros[ indice_registro_selecionado ];
        
        $(formulario_edicao_registro).data(nome_campo_id_registro, json_registro_selecionado.id);
                
        var lista_dados_para_form = {};
        
        for( var i = 0; i < lista_relacao_campo_propriedade.length; ++i ) {
            var campo_propriedade = lista_relacao_campo_propriedade[i];
            
            lista_dados_para_form[ campo_propriedade.nomeCampo ] = json_registro_selecionado[campo_propriedade.propriedade];
        }
                
        set_campos_formulario( formulario_edicao_registro, lista_dados_para_form );
        
        $("html, body").animate({ scrollTop: $(formulario_edicao_registro).offset().top-50 }, 100);
        
        alterar_modo_formulario_para(formulario_edicao_registro, "edicao");
    });
}

function get_total_paginas(total_itens, itens_por_pagina) {
    var total_paginas = total_itens/itens_por_pagina;
        
    if( !Number.isInteger(total_paginas) ) {
        total_paginas = Math.ceil(total_paginas);
    }
    
    return total_paginas;
}

function inicializar_botoes_paginacao(botao_pagina_anterior, botao_proxima_pagina, pagina_atual, itens_por_pagina, total_itens, callback) {
    var total_paginas = get_total_paginas(total_itens, itens_por_pagina);            

    var proxima_pagina = pagina_atual + 1;        

    if( proxima_pagina >= total_paginas ) {
        proxima_pagina = total_paginas;        
    }

    var pagina_anterior = pagina_atual - 1;

    if( pagina_anterior < 1 ) {
        pagina_anterior = 1;        
    }

    $(botao_proxima_pagina).click(function() {
        callback( proxima_pagina );
    });

    $(botao_pagina_anterior).click(function() {
        callback( pagina_anterior );
    });
}

function inicializar_botoes_paginacao_veiculos(pagina_atual, itens_por_pagina, total_itens, callback) {
    var pagina_veiculos = $("#pag-adm-veiculos")[0];
    
    if( pagina_veiculos !== undefined ) {        
        var botao_anterior = $("#btn-prev")[0];
        var botao_proxima = $("#btn-next")[0];
        
        inicializar_botoes_paginacao(botao_anterior, botao_proxima, pagina_atual, itens_por_pagina, total_itens, callback);
    }
}

function inicializar_botao_edicao_veiculos(json_lista_veiculos) {
    var pagina_veiculos = $("#pag-adm-veiculos")[0];

    if( pagina_veiculos !== undefined ) {
        
        var formInfoVeiculo = $("#form-info-veiculo")[0];
        
        var relacao_campo_propriedade = [
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
        
        var lista_registros_tabela = $(pagina_veiculos).find(".registro-veiculo");
        
        inicializar_botao_edicao_registro( pagina_veiculos, formInfoVeiculo, "idVeiculo", ".botao-editar", ".registro-veiculo", relacao_campo_propriedade, lista_registros_tabela, json_lista_veiculos);
    }
}

//-------------------------------------------- TIPO DE VEICULO

function inicializar_botao_edicao_tipo(json_lista_tipo) {
    var pagina_tipo = $("#pag-tipo-veiculo")[0];

    if( pagina_tipo !== undefined ) {
        
        $(pagina_tipo).on("click", ".botao-editar", function() {
            var registro = $(this).parents(".registro-tipo")[0];
            
            var lista_registros_tabela = $(pagina_tipo).find(".registro-tipo");
            
            var indice_registro_selecionado = lista_registros_tabela.index(registro);
            var registro_selecionado = json_lista_tipo[indice_registro_selecionado];
            
            console.log(json_lista_tipo);
            console.log(lista_registros_tabela);
            return;
            
            var form = $(pagina_tipo).find("#form-modificacao")[0];
            $(form).data("idTipo", registro_selecionado.id);                        
            
            var lista_dados = {};
            lista_dados['txtTipoVeiculo'] = registro_selecionado.titulo;
            
            set_campos_formulario(form, lista_dados);
            $(form).removeClass("js-modo-insercao");
            $(form).addClass("js-modo-edicao");
        });
    }
}

//--------------------------------------------

function preparar_formulario_edicao_veiculos() {
    var formInfoVeiculo = $("#form-info-veiculo")[0];
    
    $(formInfoVeiculo).on("reset", function(e) {            
        $(this).removeData("idVeiculo");
        $(this).addClass("js-modo-insercao");
        $(this).removeClass("js-modo-edicao");
    });
}

$(document).ready(function() {
    
    function definirBotaoSelecaoImagem(botao, inputFile) {
        $(botao).click(function() {            
            inputFile.click();

            $(inputFile).change(function() {            
                var reader = new FileReader();
                
                reader.onload = function(e) {
                    $(this).attr("src", e.target.result);
                }

                reader.onloadend = function(e) {
                    if( reader.readyState === 2 ) {
                        $(botao).css("background-image", "url(" + reader.result + ")");                
                    }
                }

                reader.readAsDataURL( this.files[0] );                    
            });
        });
    }
    
    function inicializarBotoesSelecaoImagem() {
        var boxInputImagem = $(".box-input-imagem");
        
        if( boxInputImagem.length > 0 ) {
            
            for( var i = 0; i < boxInputImagem.length; ++i ) {
                var botaoImagem = $( boxInputImagem[i] ).find(".botao-imagem")[0];
                var fileInput = $( boxInputImagem[i] ).find(".input")[0];
                
                definirBotaoSelecaoImagem( botaoImagem, fileInput );
            }
        }
    }
    
    function inicializarAJAXPerguntas() {
        var form = $("#form-add-pergunta")[0];
        var formPergunta = $(".form-pergunta");
        var botaoRemoverPergunta = $(formPergunta).find(".botao-remover");
        
        if( form !== undefined ) {            
            $(form).submit(function(e) {
                e.preventDefault();
                
                var formData = new FormData(this);                
                                
                $.ajax({
                    url: "apis/crud_perguntas.php?modo=insert",
                    method: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(data) {                        
                        var wrapper_perguntas = $("#wrapper-perguntas")[0];                        
                        wrapper_perguntas.innerHTML = data;
                        
                        $(form).trigger("reset");
                    }
                });
            });
            
            $( document ).on("submit", ".pergunta .form-pergunta", function(e) {
                e.preventDefault();
                
                var formData = new FormData(this);                
                var boxPergunta = $(this).parents(".pergunta")[0];
                
                var id = $(boxPergunta).attr("data-id");
                formData.append("id", id);
                
                $.ajax({
                    url: "apis/crud_perguntas.php?modo=update",
                    method: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        var wrapper_perguntas = $("#wrapper-perguntas")[0];
                        
                        wrapper_perguntas.innerHTML = data;
                    }
                });
            });
            
            $( document ).on("click", ".form-pergunta .botao-remover", function() {
                var boxPergunta = $(this).parents(".pergunta")[0];
                var id = $(boxPergunta).attr("data-id");
                
                var formData = new FormData();
                formData.append("id", id);
                
                $.ajax({
                    url: "apis/crud_perguntas.php?modo=delete",
                    method: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(data) {                        
                        var wrapper_perguntas = $("#wrapper-perguntas")[0];
                        
                        wrapper_perguntas.innerHTML = data;
                    }
                });
            });
        }
    }

    function inicializar_painel_info_usuario() {
        var pagina_info_usuarios = $("#pag-info-usuarios")[0];
        
        if( pagina_info_usuarios !== undefined ) {
            var botao_informacoes = $("#botao-informacoes")[0];
            var botao_publicacao = $("#botao-publicacoes")[0];
            var botao_pedidos = $("#botao-pedidos")[0];                        
            
            var box_info_pessoais = $(".box-info-pessoais")[0];
            var box_conteudo_painel = $("#container-publicacoes-pedidos")[0];
            
            var id = window.location.toString();
            id = id.substr( id.indexOf("id=")+3, id.length );
            id = Number(id);
            
            var dados_api = new FormData();
            dados_api.append("idUsuario", id);
            
            var imagem_carregamento = document.createElement("img");
            imagem_carregamento.src = "../img/loading_cityshare_black.gif";                        
            imagem_carregamento.style.display = "block";
            imagem_carregamento.style.margin = "auto";
            imagem_carregamento.style.marginTop = "200px";
            
            $(botao_informacoes).click(function() {
                box_conteudo_painel.innerHTML = "";
                box_conteudo_painel.style.display = "none";
                box_info_pessoais.style.display = "block";                
            });
            
            $(botao_publicacao).click(function() {
                
                box_info_pessoais.style.display = "none";
                box_conteudo_painel.innerHTML = "";
                
                box_conteudo_painel.style.display = "block";
                box_conteudo_painel.appendChild( imagem_carregamento );
                
                var ajax = new Ajax();
                ajax.transferir_dados_para_api("apis/get_publicacoes_usuario.php", "POST", dados_api, function(resultado) {                    
                    box_conteudo_painel.innerHTML = resultado;
                })
                
            });
            
            $(botao_pedidos).click(function() {
                
                box_info_pessoais.style.display = "none";
                box_conteudo_painel.innerHTML = "";
                
                box_conteudo_painel.style.display = "block";
                box_conteudo_painel.appendChild( imagem_carregamento );
                
                var ajax = new Ajax();
                ajax.transferir_dados_para_api("apis/get_pedidos_usuario.php", "POST", dados_api, function(resultado) {
                    box_conteudo_painel.innerHTML = resultado;
                })
                
            });
        }
    }
    
    //--------------------------------------------
    
    inicializarAJAXPerguntas();
    inicializarBotoesSelecaoImagem();
    inicializar_painel_info_usuario();
});