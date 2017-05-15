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

$(document).ready(function() {

    function definirBotaoSelecaoImagem(botao, inputFile) {
        $(botao).click(function() {
            inputFile.click();

            $(inputFile).off("change");
            $(inputFile).change(function() {
                var tamanho_limite_mb = 2;
                var arquivo = this.files[0];
                var tamanho_arquivo_mb = Math.floor(( arquivo.size / 1024 )/1024);
                var extensao_arquivo = arquivo.type.substr( arquivo.type.indexOf("/")+1, arquivo.type.length );

                var extensoes_permitidas = ["jpg", "png", "jpeg", "gif"];

                if( tamanho_arquivo_mb >= tamanho_limite_mb ) {
                    alert("O arquivo selecionado excede o tamanho maximo de 2MB!");
                    return;
                }

                if( extensoes_permitidas.indexOf( extensao_arquivo ) === -1 ) {
                    alert("Tipo de arquivo invalido!");
                    return;
                }

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

    //-------------------------------------------- SCRIPT DE RELAÇÃO DE SELECTS        

    function inicializarBotoesAnalisePublicacao() {
        var botao_aceitar = $(".js-btn-aprovar")[0];
        var botao_recusar = $(".js-btn-recusar")[0];

        if( botao_aceitar !== undefined ) {
            $(botao_aceitar).click(function(e) {
                var idPublicacao = window.location.search;
                idPublicacao = idPublicacao.substr( idPublicacao.indexOf("?id=")+4, idPublicacao.length );

                var data = new FormData();
                data.append("idPublicacao", idPublicacao);
                data.append("modo", "aceitar");

                var ajax = new Ajax();
                ajax.transferir_dados_para_api("apis/analise_publicacao.php", "POST", data );
            });
        }

        if( botao_recusar !== undefined ) {
            $(botao_recusar).click(function(e) {
                var idPublicacao = window.location.search;
                idPublicacao = idPublicacao.substr( idPublicacao.indexOf("?id=")+4, idPublicacao.length );

                var data = new FormData();
                data.append("idPublicacao", idPublicacao);
                data.append("modo", "recusar");

                var ajax = new Ajax();
                ajax.transferir_dados_para_api("apis/analise_publicacao.php", "POST", data );
            });
        }
    }
    //--------------------------------------------

    function inicializarFormularioCadastroPercentual() {
        var pag_percentual_lucro = $("#pag-percentual-lucro")[0];

        if( pag_percentual_lucro !== undefined ) {
            var select_tipo_veiculo = $("#slTipoVeiculo")[0];
            var select_categoria_veiculo = $("#slCategoriaVeiculo")[0];
            
            $(select_tipo_veiculo).change(function() {
                relacionar_selects( select_tipo_veiculo, select_categoria_veiculo, "../apis/get_categorias.php", "idTipoVeiculo");
            });
        }
    }

    function inicializarFormularioCadastroVeiculo() {
        var pag_modelo_veiculo = $("#pag-adm-veiculos")[0];

        if( pag_modelo_veiculo !== undefined ) {
            var select_fabricantes = $("#slFabricante")[0];
            var select_combustivel = $("#slCombustivel")[0];
            var select_transmissao = $("#slTransmissao")[0];
            var select_tipo = $("#slTipoVeiculo")[0];
            var select_categoria = $("#slCategoriaVeiculo")[0];
            
            $(select_tipo).change(function() {
                relacionar_selects(select_tipo, select_fabricantes, "../apis/get_fabricantes.php", "idTipoVeiculo");
                relacionar_selects(select_tipo, select_categoria, "../apis/get_categorias.php", "idTipoVeiculo");
                relacionar_selects(select_tipo, select_combustivel, "../apis/get_combustiveis_tipo_veiculo.php", "idTipoVeiculo");
                relacionar_selects(select_tipo, select_transmissao, "../apis/get_transmissoes_tipo_veiculo.php", "idTipoVeiculo");
            });            
        }
    }

    inicializarBotoesAnalisePublicacao();
    inicializarAJAXPerguntas();
    inicializarBotoesSelecaoImagem();
    inicializar_painel_info_usuario();
    inicializarFormularioCadastroPercentual();
    inicializarFormularioCadastroVeiculo();
});
