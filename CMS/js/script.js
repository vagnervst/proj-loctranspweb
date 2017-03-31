function get_input_by_name(nome, lista_input) {
    for(var i = 0; i < lista_input.length; ++i) {
        if( lista_input[i].name == nome ) return lista_input[i];
    }
    
    return null;
}

function set_campos_formulario(formulario, lista_chave_valor) {
    var campos = formulario.elements;
    get_input_by_name('', campos);
    
    for(var nome_campo in lista_chave_valor) {
        var campo = get_input_by_name(nome_campo, campos);
        
        campo.value = lista_chave_valor[nome_campo];
    }
}

function definir_acao_botao_edicao_veiculos(botao, registro, lista_registros_tabela, json_lista_veiculos) {
    $(botao).click(function() {
        var indice_registro_selecionado = lista_registros_tabela.index(registro);
        
        var json_registro_selecionado = json_lista_veiculos[indice_registro_selecionado];
        
        var formInfoVeiculo = $("#form-info-veiculo")[0];
        $(formInfoVeiculo).data("idVeiculo", json_registro_selecionado.id);
        
        console.log(json_registro_selecionado);
        
        var lista_dados = {}; 
        lista_dados['txtNome'] = json_registro_selecionado.nome;
        lista_dados['txtPortas'] = json_registro_selecionado.qtdPortas;
        lista_dados['txtMotor'] = json_registro_selecionado.tipoMotor;
        lista_dados['txtAno'] = json_registro_selecionado.ano;
        lista_dados['slTransmissao'] = json_registro_selecionado.idTransmissao;
        lista_dados['txtPrecoMedio'] = json_registro_selecionado.precoMedio;
        lista_dados['slFabricante'] = json_registro_selecionado.idFabricante;
        lista_dados['slCombustivel'] = json_registro_selecionado.idTipoCombustivel;
        lista_dados['slTipo'] = json_registro_selecionado.idTipoVeiculo;
        lista_dados['slCategoria'] = json_registro_selecionado.idCategoriaVeiculo;
        
        set_campos_formulario(formInfoVeiculo, lista_dados);
        $("html, body").animate({ scrollTop: $(formInfoVeiculo).offset().top-50 }, 0);
        $(formInfoVeiculo).removeClass("js-modo-insercao");
        $(formInfoVeiculo).addClass("js-modo-edicao");
    });
}

function inicializar_botao_edicao_veiculos(json_lista_veiculos) {
    var pagina_veiculos = $("#pag-adm-veiculos")[0];

    if( pagina_veiculos !== undefined ) {            
        var formInfoVeiculo = $("#form-info-veiculo")[0];

        var registros_veiculos = $(pagina_veiculos).find(".registro-veiculo");
        
        for( var i = 0; i < registros_veiculos.length; ++i ) {                
            var box_registro = registros_veiculos[i];
            var botao_edicao = $(box_registro).find(".botao-editar")[0];

            definir_acao_botao_edicao_veiculos(botao_edicao, box_registro, registros_veiculos, json_lista_veiculos);
        }
    }
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
            
    inicializarAJAXPerguntas();
    inicializarBotoesSelecaoImagem();            
});