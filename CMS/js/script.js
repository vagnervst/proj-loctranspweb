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
    
    inicializarBotoesSelecaoImagem();
        
});