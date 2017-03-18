$(document).ready(function() {       
    var tamanhoTela = window.getComputedStyle(document.body, ':after').getPropertyValue('content');
    
    function getIdStatusElemento(elemento, ativo) {
        //captura o id de status de um elemento, sendo estes
        //#id-elemento-active para ativo e somente #id-elemento para inativo
        //o retorno e dependente da variavel booleana ativo, caso true, retorna o id para elemento ativo, e false faz o oposto
        
        var idStatus = undefined;
        if( ativo === true ) {
            //retorna o id para status: ativo
            idStatus = elemento.id.substr(0, elemento.id.indexOf("-ativo")) + "-ativo";          
        } else {
            //retorna o id para status: inativo
            idStatus = elemento.id.substr(0, elemento.id.indexOf("-ativo"));            
        }
        
        return idStatus;
    }
    
    function isElementoDoPainel(elemento, painel) {
        if( $(painel).children( elemento.id ).length > 0 ) return true;
        
        return false;
    }
    
    function controlarPainel(botaoInteracao, painel, elementoClicado, elemento_a_ocultar = undefined) {                
        
        if( elementoClicado != painel && isElementoDoPainel(elementoClicado, painel) ) {
            //Evita o fechamento do painel caso o clique ocorra em um de seus elementos filho
            elementoClicado = $(elementoClicado).parents(".painel-mobile")[0];
        }
        
        if( isPainelExibido(painel) && elementoClicado != painel ) {
            //Fecha o painel
            toggleExibicaoPainel(painel);

            if( elemento_a_ocultar != undefined ) {
                elemento_a_ocultar.id = toggleIdStatusElemento(elemento_a_ocultar, true);
            }
            
        } else if( !isPainelExibido(painel) && elementoClicado == botaoInteracao ) {
            //Abre o painel
            toggleExibicaoPainel(painel);

            if( elemento_a_ocultar != undefined ) {
                var idInativo = toggleIdStatusElemento(elemento_a_ocultar, false);
                elemento_a_ocultar.id = idInativo;
            }
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
        if( painel === null ) return;
        
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
    
    function ocultarEtapa(etapa, duracao, callback = undefined) {
        $(etapa).animate({
            //Executa animacao de saida
            right: "300px",
            opacity: "0"
        }, duracao, function() {
            //Reseta o CSS da sessao retirada
            $(etapa).css("display", "none");
            $(etapa).css("right", "0px");
            $(etapa).css("opacity", "1");
            
            if( callback !== undefined) callback();
        });
    }
    
    function exibirEtapa(etapa, duracao, callback) {
        $(etapa).css("opacity", "0");
        $(etapa).css("position", "relative");
        $(etapa).css("top", "300px");
        $(etapa).css("display", "block");
        
        $(etapa).animate({
            opacity: "1",
            top: "0px"
        }, duracao, callback);
    }
    
    function definirEventoTransicao(botao, etapaAlvo) {
        //Define o evento de transicao para a sessao selecionada, ao botao

        $(botao).click(function() {
            if( $(etapaAlvo).css("display") === "none" ) {
                var etapaAtual = $(botao).parents(".box-cadastro")[0];
                
                ocultarEtapa(etapaAtual, 200, exibirEtapa(etapaAlvo, 300));
            }
        });
    }
    
    function capturarClasseEtapa(elemento) {
        //Retorna, da lista de classes de um elemento, a classe utilizada para identificacao de etapas de cadastro
        if( elemento === undefined ) return null;        
        
        var classe_identificacao_etapa = "js-etapa";
        
        var nao_encontrado = -1;
        var listaClasses = elemento.classList;
        for( var i = 0; i < listaClasses.length; ++i ) {
            
            if( listaClasses[i].indexOf(classe_identificacao_etapa) != nao_encontrado ) {                
                return listaClasses[i];
            }
        }                
        
        return null;
    }
    
    function capturarEtapaAlvo(botao, boxSessaoCadastro) {
        //Captura a etapa para qual o botao deve transferir
        //atraves da classe inserida neste botao, que deve ser a mesma da etapa desejada
        
        var classeEtapaAlvo = capturarClasseEtapa(botao);
        var etapas = capturarEtapas(boxSessaoCadastro);
                        
        for( var i = 0; i < etapas.length; ++i ) {
            var classeEtapa = capturarClasseEtapa(etapas[i]);
            
            if( classeEtapaAlvo === classeEtapa ) return etapas[i];
        }
    }
    
    function definirTransferencia(botao, boxSessaoCadastro) {

        var etapaAlvo = capturarEtapaAlvo(botao, boxSessaoCadastro);        
        
        definirEventoTransicao(botao, etapaAlvo);
    }
    
    function capturarBotoesTransferencia(etapa) {
        //Captura todos os botoes de transferencia de uma etapa
        var botoes = $(etapa).children(".js-botao-transf");
        
        if( botoes.length === 0 ) {
            botoes = $($(etapa).children(".horizontal-input-container")).children(".js-botao-transf");
        }                
        
        return botoes;
    }
    
    function capturarEtapas(boxSessaoCadastro) {
        //Captura todas as etapas de cadastro pertencentes a uma sessao de cadastro
        return $($(boxSessaoCadastro).children("form")[0]).children(".box-cadastro");
    }
    
    function prepararSessaoCadastro(boxSessaoCadastro) {
        //Captura todas as etapas de uma sessao de cadastro, e seus botoes de transferencia
        //para inicializar as transicoes
        var etapas = capturarEtapas(boxSessaoCadastro);                
                
        for( var i = 0; i < etapas.length; ++i ) {
            var listaBotoesTransf = capturarBotoesTransferencia(etapas[i]);            
            
            for( var x = 0; x < listaBotoesTransf.length; ++x ) {                
                definirTransferencia( listaBotoesTransf[x], boxSessaoCadastro );
            }
        }
    }    
    
    function isTipoContaAtivo(boxCadastro) {
        //Retorna true se o formulario de cadastro for o ativo no momento
        
        if( $(boxCadastro).hasClass("js-cadastro-ativo") ) return true;
        
        return false;
    }        
    
    function setStatusFormularioConta(boxCadastro, ativo) {
        //Altera o status do formulario de cadastro para ativo ou inativo
        
        if( ativo ) {
            $(boxCadastro).removeClass("js-cadastro-ativo");
            $(boxCadastro).addClass("js-cadastro-ativo");
        } else {
            $(boxCadastro).removeClass("js-cadastro-ativo");
        }
    }
    
    function getFormularioAtivo(listaFormCadastro) {
        //Retorna o formulario ativo no momento
        
        for( var i = 0; i < listaFormCadastro.length; ++i ) {
            if( isTipoContaAtivo(listaFormCadastro[i]) ) return listaFormCadastro[i];
        }
    }
    
    function getIndiceFormAtivo(listaFormCadastro) {
        var formAtivo = getFormularioAtivo(listaFormCadastro);
        
        var indiceFormAtivo = listaFormCadastro.indexOf(formAtivo);
        return indiceFormAtivo;        
    }
    
    function executarTransicaoIndicador(listaFormCadastro) {
        var indicador = $(".indicador-modo")[0];
        
        var indice = getIndiceFormAtivo(listaFormCadastro);
        
        var direcao_esquerda = 0;
        var direcao_direita = 1;
        if( indice === direcao_esquerda) {
            indicador.id = "indicador-modo-fisico";
        } else {
            indicador.id = "indicador-modo-juridico";
        }
    }
    
    function resetarFormulario(boxFormularioCadastro) {
        //Limpa todas as caixas preenchidas e retorna o formulario a etapa inicial
        var form = $(boxFormularioCadastro).children("form")[0];
        
        $(form).trigger("reset");
        var etapas = capturarEtapas(boxFormularioCadastro);
        
        exibirEtapa( etapas[0], 200 );
        for( var i = 1; i < etapas.length; ++i ) {
            ocultarEtapa( etapas[i], 200 );
        }
    }
    
    function executarTransicaoFormulario(listaFormCadastro) {
        var formAtivo = getFormularioAtivo(listaFormCadastro);
        var formInativo = ( getIndiceFormAtivo(listaFormCadastro) === 0 )? listaFormCadastro[1] : listaFormCadastro[0];
        
        resetarFormulario(formInativo);
        executarTransicaoIndicador( listaFormCadastro );
        
        $(formInativo).animate({
            opacity: 0
        }, 200, function() {
            formInativo.style.display = "none";
        });
        
        $(formAtivo).animate({
            opacity: 1
        }, 200, function() {
            formAtivo.style.display = "block";
        });
    }
    
    function setStatusTipoContaUnico(listaFormCadastro, indice, ativo) {
        //Altera o status dos formularios de cadastro, mantendo somente um deles ativo
                
        for( var i = 0; i < listaFormCadastro.length; ++i ) {
            if( i === indice ) { 
                setStatusFormularioConta(listaFormCadastro[i], ativo);
            } else { 
                setStatusFormularioConta(listaFormCadastro[i], !ativo);
            }
        }
        
        executarTransicaoFormulario(listaFormCadastro);
    }
    
    function inicializarBotoesTipoConta() {
        var botaoCadastroFisico = $("#botao-conta-fisica")[0];
        var botaoCadastroJuridico = $("#botao-conta-juridica")[0];
        
        var boxSessaoCadastroFisico = $("#container-cadastro-fisico")[0];
        var boxSessaoCadastroJuridico = $("#container-cadastro-juridico")[0];
        
        var listaFormCadastro = [];
        listaFormCadastro.push( boxSessaoCadastroFisico );
        listaFormCadastro.push( boxSessaoCadastroJuridico );                
        
        $(botaoCadastroFisico).click(function(){
            setStatusTipoContaUnico(listaFormCadastro, 0, true);
            //executarTransicaoFormulario(listaFormCadastro);
        });
        
        $(botaoCadastroJuridico).click(function(){
            setStatusTipoContaUnico(listaFormCadastro, 1, true);
            //executarTransicaoFormulario(listaFormCadastro);
        });
    }
    
    function inicializarEtapasCadastro() {
        //Inicializa as sessoes de cadastro de usuario fisico e juridico
        var paginaCadastro = $("#pag-cadastro")[0];

        if( paginaCadastro != undefined ) {
            inicializarBotoesTipoConta();
            
            var boxSessaoCadastroFisico = $("#container-cadastro-fisico")[0];
            var boxSessaoCadastroJuridico = $("#container-cadastro-juridico")[0];
            
            prepararSessaoCadastro(boxSessaoCadastroFisico);
            prepararSessaoCadastro(boxSessaoCadastroJuridico);
        }
    }        
    
    if( tamanhoTela.indexOf("mobile") != -1 ) {                                    
        
        function inicializarMenusMobile() {
            //Inicializa os menus mobile e seus respectivos botoes de ativacao
            
            var botaoMenuPaginas = document.getElementById("mobile-botao-menu");       
            var painelMenuPaginas = document.getElementById("box-mobile-menu");                

            var botaoMenuPerfil = document.getElementById("imagem-perfil").getElementsByTagName("img")[0];
            var painelMenuPerfil = document.getElementById("box-menu-usuario");                

            var botaoFiltragemVeiculos = document.getElementById("mobile-botao-filtragem-ativo");                        
            var painelFiltragemVeiculos = document.getElementById("box-mobile-filtragem");
            
            $(document.body).click(function(e) {
                var elementoClicado = e.target;

                controlarPainel(botaoMenuPaginas, painelMenuPaginas, elementoClicado);
                controlarPainel(botaoMenuPerfil, painelMenuPerfil, elementoClicado);
                controlarPainel(botaoFiltragemVeiculos, painelFiltragemVeiculos, elementoClicado);                
            });
        
        }
                
        inicializarMenusMobile();
        inicializarEtapasCadastro();
        
    } else if( tamanhoTela.indexOf("desktop") != -1 ) {
        
        function inicializarMenusDesktop() {
            //Inicializa os menus desktop e seus respectivos botoes de ativacao
            
            var botaoFiltragemVeiculosDesktop = document.getElementById("desktop-botao-filtragem");
            var painelFiltragemVeiculos = document.getElementById("box-mobile-filtragem");
            
            var botaoMenuPerfil = document.getElementById("imagem-perfil").getElementsByTagName("img")[0];
            var painelMenuPerfil = document.getElementById("box-menu-usuario"); 
            
            $(document.body).click(function(e) {
                var elementoClicado = e.target;            
                
                controlarPainel(botaoMenuPerfil, painelMenuPerfil, elementoClicado);
                controlarPainel(botaoFiltragemVeiculosDesktop, painelFiltragemVeiculos, elementoClicado);
                
            });
        }
        
        inicializarMenusDesktop();
        inicializarEtapasCadastro();
    }
    $('.faq').click(function (){
        $(this).find('.faq-answer').slideToggle('fast');
    });
});