$(document).ready(function() {       
    var tamanhoTela = window.getComputedStyle(document.body, ':after').getPropertyValue('content');
    
    if( tamanhoTela.indexOf("mobile") != -1 ) {
            
        function controlarPainelMobile(botaoInteracao, painel, elementoClicado, elemento_a_ocultar = undefined) {
            
            if( elementoClicado != painel && elementoClicado != botaoInteracao ) {
                //Evita o fechamento do painel caso o clique ocorra em um de seus elementos filho
                elementoClicado = $(elementoClicado).parents(".painel-mobile")[0];
            }                                            
            
            if( isPainelExibido(painel) && elementoClicado != painel ) {
                //Fecha o painel
                toggleExibicaoPainel(painel);
                
                if( elemento_a_ocultar != undefined ) elemento_a_ocultar.style.display = "block";
            } else if( !isPainelExibido(painel) && elementoClicado == botaoInteracao ) {
                //Abre o painel
                toggleExibicaoPainel(painel);
                
                if( elemento_a_ocultar != undefined ) elemento_a_ocultar.style.display = "none";
            }
        }
        
        function mudarStatusExibicaoPainel(painel) {
            //Altera a classe que define o status de exibicao do painel
            //de acordo com seu status atual
            var classePainelAtivo = "js-popup-painel-ativo";
            var classePainelInativo = "js-popup-painel";
            
            if( $(painel).hasClass(classePainelAtivo) ) {
                $(painel).removeClass(classePainelAtivo);
                $(painel).addClass(classePainelInativo);
            } else {
                $(painel).removeClass(classePainelInativo);
                $(painel).addClass(classePainelAtivo);
            }
        }
        
        function isPainelExibido(painel) {
            //Verifica se o painel em questao contem a classe de status ativo
            //Caso positivo, retorna true. Retorna false caso o contrario
            
            var nao_encontrado = -1;            
            var painelExibido = ( painel.id.indexOf("-ativo") !== nao_encontrado )? true : false;
            
            return painelExibido;
        }
        
        function toggleExibicaoPainel(painel) {
            //Exibe ou oculta o painel de acordo com seus estado atual
                        
            if( isPainelExibido(painel) ) { 
                console.log("Ocultando: " + painel.id);
                var idPainelInativo = painel.id.substr(0, painel.id.indexOf("-ativo"));                
                $(painel).attr("id", idPainelInativo);                
                mudarStatusExibicaoPainel(painel);
                
            } else {
                var idPainelAtivo = painel.id + "-ativo";                
                $(painel).attr("id", idPainelAtivo);                
                mudarStatusExibicaoPainel(painel);                                
            }
                        
            return isPainelExibido(painel);
        }                
        
        function inicializarManusMobile() {
            //Inicializa os menus e seus respectivos botoes de ativacao
            
            var botaoMenuPaginas = document.getElementById("mobile-botao-menu");       
            var painelMenuPaginas = document.getElementById("box-mobile-menu");                

            var botaoMenuPerfil = document.getElementById("imagem-perfil").getElementsByTagName("img")[0];
            var boxMenuPerfil = document.getElementById("box-menu-usuario");                

            var botaoFiltragemVeiculos = document.getElementById("mobile-botao-filtragem");        
            var painelFiltragemVeiculos = document.getElementById("box-mobile-filtragem");
            
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
            //Inicializa as sessoas de cadastro de usuario
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