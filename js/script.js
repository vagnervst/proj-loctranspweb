$(document).ready(function() {       
    var tamanhoTela = window.getComputedStyle(document.body, ':after').getPropertyValue('content');
    
    if( tamanhoTela.indexOf("mobile") != -1 ) {
        var botaoMenuPaginas = document.getElementById("mobile-botao-menu");       
        var boxMenuPaginas = document.getElementById("box-mobile-menu");
        
        var botaoMenuPerfil = document.getElementById("imagem-perfil").getElementsByTagName("img")[0];
        var boxMenuPerfil = document.getElementById("box-menu-usuario");                
        
        var menuPaginasExibido = false;
        var menuPerfilExibido = false;
        $(document.body).click(function(e) {
            var elementoClicado = e.target;
            
            
            if( elementoClicado === botaoMenuPaginas && !menuPaginasExibido ) {
                boxMenuPaginas.style.display = "block";
                boxMenuPaginas.style.width = "250px";
                menuPaginasExibido = true;
                /*----------------------------------------------- EXIBICAO MENU PAGINAS*/
            } else if( elementoClicado === botaoMenuPerfil && !menuPerfilExibido ) {
                boxMenuPerfil.style.display = "block";
                menuPerfilExibido = true;
                /*----------------------------------------------- EXIBICAO MENU PERFIL*/
            } else if( elementoClicado !== botaoMenuPaginas && menuPaginasExibido ) {
                boxMenuPaginas.style.display = "none";
                menuPaginasExibido = false;
                /*----------------------------------------------- OCULTACAO MENU PAGINAS*/
            } else if( elementoClicado !== botaoMenuPerfil && menuPerfilExibido ) {
                boxMenuPerfil.style.display = "none";
                menuPerfilExibido = false;
                /*----------------------------------------------- OCULTACAO MENU PERFIL*/
            }
        });
    }
});