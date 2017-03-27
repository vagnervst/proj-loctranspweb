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
        if( painel === undefined ) return;
        
        if( $(elemento).parents( "#" + painel.id.toString() ).length > 0 ) return true;
        
        return false;
    }
    
    function controlarPainel(botaoInteracao, painel, elementoClicado, elemento_a_ocultar = undefined) {                
        if(painel === null) return;
        
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
        if( painel === undefined ) return;
        
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
        
        $(boxFormularioCadastro).find(".botao-foto").css("background-image", "url(img/icones/icone-imagem.png)");
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
    
    function inicializarBotaoSelecaoImagem() {
        var botaoFotoFisico = $("#botao-foto-fisico")[0];
        var fileInputFisico = $("#input-foto-fisico")[0];
        
        var botaoFotoJuridico = $("#botao-foto-juridico")[0];
        var fileInputJuridico = $("#input-foto-juridico")[0];
        
        definirBotaoSelecaoImagem(botaoFotoFisico, fileInputFisico);
        definirBotaoSelecaoImagem(botaoFotoJuridico, fileInputJuridico);
    }
    
    function inicializarEtapasCadastro() {
        //Inicializa as sessoes de cadastro de usuario fisico e juridico
        var paginaCadastro = $("#pag-cadastro")[0];

        if( paginaCadastro != undefined ) {
            inicializarBotaoSelecaoImagem();
            inicializarBotoesTipoConta();
            
            var boxSessaoCadastroFisico = $("#container-cadastro-fisico")[0];
            var boxSessaoCadastroJuridico = $("#container-cadastro-juridico")[0];
            
            prepararSessaoCadastro(boxSessaoCadastroFisico);
            prepararSessaoCadastro(boxSessaoCadastroJuridico);
        }
    }
    
    function exibirImagemSlide(boxImagem, duracao) {        
        isTransicionando = true;
        $(boxImagem).css("display", "block");
        
        $(boxImagem).animate({
            opacity: 1
        }, duracao, function() {
            isTransicionando = false;
        });
        
        $(boxImagem).addClass("ativo");
    }
    
    function ocultarImagemSlide(boxImagem, duracao, callback = undefined) {        
        isTransicionando = true;
        
        $(boxImagem).animate({
            opacity: 0
        }, duracao, function() {
            $(boxImagem).css("display", "none");
            $(boxImagem).removeClass("ativo");
            isTransicionando = false;
            
            if(callback !== undefined) setTimeout(function(){callback()}, 0);
        });
    }
    
    function ocultarTodasImagensSlide(listaImagens, duracao, callback) {
        for( var i = 0; i < listaImagens.length; ++i ) {
            ocultarImagemSlide( listaImagens[i], duracao );
        }
        
        if( callback !== undefined ) setTimeout(function() { callback(); }, 0);
    }
    
    function exibirUnicaImagemSlide(boxImagemAnterior, boxImagem, duracaoIn, duracaoOut) {
        ocultarImagemSlide(boxImagemAnterior, duracaoOut, function() { exibirImagemSlide(boxImagem, duracaoIn); });        
    }
    
    function capturarIndiceImagemSeguinte(listaImagens) {
        var numeroImagens = listaImagens.length;
        
        var indiceProximaImagem = capturarIndiceImagemAtiva(listaImagens) + 1;
        if( indiceProximaImagem > numeroImagens - 1 ) indiceProximaImagem = 0;
        
        return indiceProximaImagem;
    }
    
    function capturarIndiceImagemAnterior(listaImagens) {
        var indiceImagemAtiva = capturarIndiceImagemAtiva(listaImagens);
        
        var indiceImagemAnterior = ( indiceImagemAtiva - 1 >= 0 )? indiceImagemAtiva - 1: listaImagens.length - 1;
        
        return indiceImagemAnterior;
    }
    
    function capturarIndiceImagemAtiva(listaImagens) {
        var numeroImagens = listaImagens.length;
        
        for( var i = 0; i < listaImagens.length; ++i ) {
            if( $(listaImagens[i]).hasClass("ativo") ) return i;
        }
        
        return numeroImagens-1;
    }
    
    function ativarIndicador(indice, listaIndicadores) {
        $(listaIndicadores[indice]).addClass("ativo");
    }
    
    function desativarIndicador(indice, listaIndicadores) {
        $(listaIndicadores[indice]).removeClass("ativo");
    }
    
    function transeferirImagemSlide(indiceImagemAtual, listaImagens, listaIndicadores, ordemInversa = false, duracaoIn, duracaoOut) {
        var indiceImagemAnterior;
        if( ordemInversa === false ) {
            indiceImagemAtual = capturarIndiceImagemSeguinte(listaImagens);
            indiceImagemAnterior = capturarIndiceImagemAtiva(listaImagens);
        } else {
            indiceImagemAnterior = capturarIndiceImagemAtiva(listaImagens);
            indiceImagemAtual = capturarIndiceImagemAnterior(listaImagens);            
        }                
        
        exibirUnicaImagemSlide( listaImagens[indiceImagemAnterior], listaImagens[indiceImagemAtual], duracaoIn, duracaoOut );

        desativarIndicador(indiceImagemAnterior, listaIndicadores);
        ativarIndicador(indiceImagemAtual, listaIndicadores);
        
        return indiceImagemAtual;
    }        
    
    function transicionarIndicador(indicador, listaIndicadores, listaImagens, duracaoIn, duracaoOut) {
        var indiceImagemAnterior = capturarIndiceImagemAtiva(listaImagens);
        var indiceSelecionado = $(listaIndicadores).index(indicador, listaIndicadores);
        
        exibirUnicaImagemSlide(listaImagens[indiceImagemAnterior], listaImagens[indiceSelecionado], duracaoIn, duracaoOut);
        desativarIndicador(indiceImagemAnterior, listaIndicadores);
        ativarIndicador(indiceSelecionado, listaIndicadores);
    }
    
    var isTransicionando = false;
    function inicializarSlide() {
        var paginaVeiculo = $("#pag-detalhes-veiculo")[0];
        
        if( paginaVeiculo !== undefined ) {
            var boxSlide = $("#slide-imagens-veiculo")[0];
            
            var botaoNext = $(boxSlide).children("#botao-next")[0];
            var botaoPrev = $(boxSlide).children("#botao-prev")[0];
            
            var indiceImagemAtual = -1;
            var imagens = $($(boxSlide).children("#container-imagens")[0]).children(".imagem");
            
            var containerIndicadores = $(boxSlide).children("#container-contador")[0];
            var indicadores = $(containerIndicadores).children(".contador");
            
            indiceImagemAtual = transeferirImagemSlide(indiceImagemAtual, imagens, indicadores, duracaoEntradaImagem, duracaoSaidaImagem);
            
            var duracaoEntradaImagem = 300;
            var duracaoSaidaImagem = 300;
            
            $(botaoNext).click(function() {
                if( isTransicionando ) return;
                
                indiceImagemAtual = transeferirImagemSlide(indiceImagemAtual, imagens, indicadores);                                
            });
            
            $(botaoPrev).click(function() {
                if( isTransicionando ) return;
                
                indiceImagemAtual = transeferirImagemSlide(indiceImagemAtual, imagens, indicadores, true);
            });
            
            $(indicadores).click(function() {
                if( isTransicionando ) return;
                
                transicionarIndicador(this, indicadores, imagens, 300);                
            });
        }
    }        
    
    function definirBotaoSelecaoImagem(botao, inputFile, label = undefined) {
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
                        
                        if(label !== undefined) {
                            label.innerHTML = "Definido";
                            $(label).css("background-color", "#8CC955");        
                        }
                    }
                }

                reader.readAsDataURL( this.files[0] );                    
            });
        });
    }
    
    function inicializarSelecionadorImagensVeiculo() {
        var paginaPublicacao = $("#pag-publicar")[0];
        
        if( paginaPublicacao !== undefined ) {
            var containerImagensVeiculo = $("#container-imagens-veiculo")[0];

            var botoesImagem = $(containerImagensVeiculo).find("#imagens #wrapper-imagens .imagem");
            var inputImagens = $(containerImagensVeiculo).find("#file-inputs .imagem-input");

            for( var i = 0; i < botoesImagem.length; ++i ) {
                var botaoImagem = botoesImagem[i];                
                var fileInput = inputImagens[ $(botoesImagem).index(botaoImagem) ];
                var label = $(botoesImagem[i].parentNode).children(".label")[0];
                
                definirBotaoSelecaoImagem(botaoImagem, fileInput, label);
            }
        }
    }
    
    function inicializarMenusMobile() {
        //Inicializa os menus mobile e seus respectivos botoes de ativacao

        var botaoMenuPaginas = $("#mobile-botao-menu")[0];
        var painelMenuPaginas = $("#box-mobile-menu")[0];

        var botaoMenuPerfil = $("#imagem-perfil img")[0];
        var painelMenuPerfil = $("#box-menu-usuario")[0];

        var botaoFiltragemVeiculos = $("#mobile-botao-filtragem-ativo")[0];
        var painelFiltragemVeiculos = $("#box-mobile-filtragem")[0];
        
        var botaoNotificacoes = $("#icone-notificacao")[0];
        var painelNotificacoes = $("#box-menu-notificacoes")[0];
        
        $(document.body).click(function(e) {
            var elementoClicado = e.target;            
            
            controlarPainel(botaoMenuPaginas, painelMenuPaginas, elementoClicado);
            controlarPainel(botaoMenuPerfil, painelMenuPerfil, elementoClicado);
            controlarPainel(botaoFiltragemVeiculos, painelFiltragemVeiculos, elementoClicado);
            controlarPainel(botaoNotificacoes, painelNotificacoes, elementoClicado);
        });

    }
    
    function inicializarMenusDesktop() {
        //Inicializa os menus desktop e seus respectivos botoes de ativacao

        var botaoFiltragemVeiculosDesktop = $("#desktop-botao-filtragem")[0];
        var painelFiltragemVeiculos = $("#box-mobile-filtragem")[0];

        var botaoMenuPerfil = $("#imagem-perfil img")[0];
        var painelMenuPerfil = $("#box-menu-usuario")[0];
        
        var botaoNotificacoes = $("#icone-notificacao")[0];
        var painelNotificacoes = $("#box-menu-notificacoes")[0];                
        
        $(document.body).click(function(e) {
            var elementoClicado = e.target;

            controlarPainel(botaoMenuPerfil, painelMenuPerfil, elementoClicado);
            controlarPainel(botaoFiltragemVeiculosDesktop, painelFiltragemVeiculos, elementoClicado);
            controlarPainel(botaoNotificacoes, painelNotificacoes, elementoClicado);

        });
    }
    
    function efeitoHoverLocadorDestaque() {
        var pagina_home = $("#pag-home")[0];
                
        if( pagina_home !== undefined ) {
            var locadores_destaque = $(".box-locador-destaque");
            
            $(locadores_destaque).mouseenter(function(e) {
                var offsetX = e.offsetX;
                //console.log(offsetX);
                
                var tamanhoBoxLocador = $(this).css("width");
                tamanhoBoxLocador = tamanhoBoxLocador.substr(0, tamanhoBoxLocador.indexOf("px"));
                
                var hoverEffect = $(this).find(".hover-effect")[0];                
                
                var leftInicial;
                var leftFinal;
                var widthInicial;
                var widthFinal;
                if( offsetX <= tamanhoBoxLocador/2 ) {
                    //Anima para a direita
                    leftInicial = "-70px";
                    leftFinal = "200px";
                    widthInicial = "70px";
                    widthFinal = "400px";
                    
                } else if( offsetX >= tamanhoBoxLocador/2 ) {
                    //Anima para a esquerda
                    leftInicial = "200px";
                    leftFinal = "-70px";
                    widthInicial = "400px";
                    widthFinal = "70px";
                }
                                                
                $(hoverEffect).css("left", leftInicial);
                $(hoverEffect).css("width", widthInicial);
                $(hoverEffect).css("display", "block");                                
                
                $(hoverEffect).animate({
                    left: leftFinal,
                    width: widthFinal
                }, 1000, function() {
                    $(hoverEffect).css("display", "none"); 
                    $(hoverEffect).css("left", leftInicial);
                    $(hoverEffect).css("width", widthFinal);                    
                });
                
            });
        }
    }        
    
    function efeitoSlidedownLogin() {
        var botaoLogin = $("#botao-login")[0];
        $(botaoLogin).attr("href", "#");
        
        var loginFullscreen = $("#box-login-fullscreen")[0];
        
        if( botaoLogin !== undefined && loginFullscreen !== undefined ) {
            
            var boxLogin = $(loginFullscreen).children("#box-login")[0];
            var slideDown1 = $(loginFullscreen).children(".js-slidedown1")[0];
            var slideDown2 = $(loginFullscreen).children(".js-slidedown2")[0];
            var botaoFechar = $(boxLogin).children("#botao-fechar-login")[0];
            
            $(botaoLogin).click(function() {
                $(loginFullscreen).css("display", "block");
                $(boxLogin).css("display", "block");
                $(slideDown1).css("display", "block");                
                
                $(slideDown1).animate({
                    top: '120%'
                }, 2000);                                
                
                $(boxLogin).animate({
                    top: '0px'
                }, 1800);
            });
                        
            $(botaoFechar).click(function() {
                 $(boxLogin).animate({
                    top: '-2000px'
                }, 800, function() {
                    $(loginFullscreen).css("display", "none");
                    $(boxLogin).css("display", "none");                    
                    $(slideDown1).css("display", "none");                    
                    $(slideDown1).css("top", "-500px");                    
                 });
            });
        }
    }
    
    if( tamanhoTela.indexOf("mobile") != -1 ) {                
                
        inicializarMenusMobile();
        inicializarEtapasCadastro();
        inicializarSlide();
        inicializarSelecionadorImagensVeiculo();
        
    } else if( tamanhoTela.indexOf("desktop") != -1 ) {                
        
        efeitoHoverLocadorDestaque();
        efeitoSlidedownLogin();
        inicializarMenusDesktop();
        inicializarEtapasCadastro();
        inicializarSlide();
        inicializarSelecionadorImagensVeiculo();
    }
    
    $('.faq').click(function (){
        console.log(this);
        $(this).find('.faq-answer').slideToggle('fast');
    });
});