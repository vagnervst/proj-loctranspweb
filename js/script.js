$(document).ready(function() {       
    var tamanhoTela = window.getComputedStyle(document.body, ':after').getPropertyValue('content');
    
    if( tamanhoTela.indexOf("mobile") != -1 ) {
            
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
        
        function inicializarManusMobile() {
        
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
        
        }
        
        function definirProximaSessao(sessao, botao) {
            //Define para qual sessao de cadastro o botao desejado ira transferir            
            
            $(botao).click(function() {
                if( $(sessao).css("display") === "none" ) {
                    var sessaoAtual = $(botao).parents(".box-cadastro")[0];
                                                            
                    $(sessaoAtual).animate({
                        //Executa animacao de saida
                        right: "300px",
                        opacity: "0"
                    }, 150, function() {
                        //Reseta o CSS da sessao retirada
                        $(sessaoAtual).css("display", "none");
                        $(sessaoAtual).css("right", "0px");
                        $(sessaoAtual).css("opacity", "1");
                        
                        //Prepara o CSS da sessao a ser inserida, para animacao
                        $(sessao).css("opacity", "0");
                        $(sessao).css("position", "relative");
                        $(sessao).css("top", "300px");
                        $(sessao).css("display", "block");
                        $(sessao).animate({
                            opacity: "1",
                            top: "0px"
                        }, 150);
                    });                                                            
                }
            });
        }
        
        function inicializarSessoesCadastro() {
            var paginaCadastro = $("#pag-cadastro")[0];
                        
            if( paginaCadastro != undefined ) {
                
                var infoPessoaisFisico = $("#container-cadastro-fisico #box-info-pessoais")[0];
                var infoContatoFisico = $("#container-cadastro-fisico #box-info-contato")[0];
                var infoCartaoCreditoFisico = $("#container-cadastro-fisico #box-cartao-credito")[0];
                var infoContaBancariaFisico = $("#container-cadastro-fisico #box-conta-bancaria")[0];
                var infoConducaoFisico = $("#container-cadastro-fisico #box-conducao")[0];
                var infoAutenticacaoFisico = $("#container-cadastro-fisico #box-autenticacao")[0];
                
                //Transferencias da sessao de informacoes pessoais
                definirProximaSessao(infoContatoFisico, $(infoPessoaisFisico).children(".button-link")[0]);
                
                //Transferencias da sessap de informacoes de contato                
                definirProximaSessao(infoCartaoCreditoFisico, $(infoContatoFisico).children(".horizontal-input-container").children()[0]);
                definirProximaSessao(infoContaBancariaFisico, $(infoContatoFisico).children(".horizontal-input-container").children()[1]);
                
                //Transferencias da sessao de dados de cartao de credito
                definirProximaSessao(infoConducaoFisico, $(infoCartaoCreditoFisico).children(".button-link")[0]);
                
                //Transferencias da sessao de dados de conta bancaria
                definirProximaSessao(infoAutenticacaoFisico, $(infoContaBancariaFisico).children(".button-link")[0]);
                
                //Transferencias da sessao de dados de conducao0
                definirProximaSessao(infoAutenticacaoFisico, $(infoConducaoFisico).children(".button-link")[0]);
            }
        }
                
        inicializarManusMobile();
        inicializarSessoesCadastro();
    }
});