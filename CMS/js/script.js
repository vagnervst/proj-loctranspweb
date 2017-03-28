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