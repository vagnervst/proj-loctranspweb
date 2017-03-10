$(document).ready(function() {       
    var tamanhoTela = window.getComputedStyle(document.body, ':after').getPropertyValue('content');
    
    if( tamanhoTela.indexOf("mobile") != -1 ) {
        var botaoMenuPaginas = document.getElementById("mobile-botao-menu");       
        var painelMenuPaginas = document.getElementById("box-mobile-menu");                
        
        var botaoMenuPerfil = document.getElementById("imagem-perfil").getElementsByTagName("img")[0];
        var boxMenuPerfil = document.getElementById("box-menu-usuario");                
        
        var botaoFiltragemVeiculos = document.getElementById("mobile-botao-filtragem");        
        var painelFiltragemVeiculos = document.getElementById("box-mobile-filtragem");
        
        var menuPaginasExibido = false;
        var menuPerfilExibido = false;
        $(document.body).click(function(e) {
            var elementoClicado = e.target;
            
            controlarPainelMobile(botaoMenuPaginas, painelMenuPaginas, elementoClicado);
            controlarPainelMobile(botaoMenuPerfil, boxMenuPerfil, elementoClicado, botaoFiltragemVeiculos);
            controlarPainelMobile(botaoFiltragemVeiculos, painelFiltragemVeiculos, elementoClicado);            
        });
        
        function controlarPainelMobile(botaoInteracao, painel, elementoClicado, elementoOculto = undefined) {
            var painelExibido = (painel.style.display == "block")? true : false;
            
            if( elementoClicado != painel && elementoClicado != botaoInteracao ) {            
                elementoClicado = $(elementoClicado).parents(".painel-mobile")[0];
            }                                            
            
            if( painelExibido && elementoClicado != painel ) {
                togglePainelMobile(painel);
                
                if( elementoOculto != undefined ) elementoOculto.style.display = "block";
            } else if( !painelExibido && elementoClicado == botaoInteracao ) {
                togglePainelMobile(painel);
                
                if( elementoOculto != undefined ) elementoOculto.style.display = "none";
            }
        }
        
        function togglePainelMobile(painel) {
            var tamanhoPainelAtivo = "250px";
            
            var painelExibido = ( painel.style.width == tamanhoPainelAtivo )? true : false;
            
            if( painelExibido ) {
                painel.style.display = "none";
                painel.style.width = "0px";                                                
            } else {
                painel.style.display = "block";                
                painel.style.width = tamanhoPainelAtivo;
                
                //Oculta todos os paineis exibidos
                var paineis = document.getElementsByClassName("js-popup-painel");
                for( var i = 0; i < paineis.length; ++i) {
                    if( paineis[0].style.display == "block" && paineis[0] != painel ) {
                        paineis[0].style.display == "block";
                        paineis[0].style.width == "0px";
                    }
                }
            }
        }
    }
});