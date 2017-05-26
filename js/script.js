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
        //Exibe ou oculta o painel de acordo com seu estado atual

        if( isPainelExibido(painel) ) {
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
        
        $('html, body').animate({
            scrollTop: $(".box-conteudo").offset().top-100
        }, 100);
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
        });
        
        $(botaoCadastroJuridico).click(function(){
            setStatusTipoContaUnico(listaFormCadastro, 1, true);            
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
                        $(botao).css("background-size", "cover");
                        $(botao).css("opacity", "1");
                        
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
                
                definirBotaoSelecaoImagem(botaoImagem, fileInput);
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
        
        var botaoNotificacoes = $("#icone-notificacao");
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
        $(botaoLogin).removeAttr("href");
        
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
    
    function exibirModal(modalAtual, modalAlvo) {
        var containerModals = $("#container-modals")[0];
                        
        if( modalAlvo === undefined ) {                
            ocultarModais( $(containerModals).find(".modal") );
        } else {
            $(containerModals).css("display", "block");    
        }

        $(modalAtual).css("display", "none");            
        $(modalAlvo).css("display", "block");
    }
    
    function definirBotaoModal(botao, modalAlvo) {        
        if( botao === undefined ) return;
                        
        $(botao).click(function() {   
            if( this.id === "btn-confirmar-info" ) {
                var select_cnh = $("#select-cnh")[0];
                var id_cnh = select_cnh.value;
                
                if( isNaN(id_cnh) ) return;                
                
                var data_retirada = $("#data-retirada")[0];
                var hora_retirada = $("#hora-retirada")[0];
                var data_devolucao = $("#data-devolucao")[0];
                var hora_devolucao = $("#hora-devolucao")[0];
                
                var data_hora_retirada = preparar_data(data_retirada.value, hora_retirada.value);
                var data_hora_devolucao = preparar_data(data_devolucao.value, hora_devolucao.value);
                
                var parametros_get = window.location.search;
                var id_publicacao = parametros_get.substr( parametros_get.indexOf("id=")+3, parametros_get.length );   
                
                var dados_api = new FormData();
                dados_api.append( "idPublicacao", id_publicacao );
                dados_api.append( "idCnh", id_cnh );
                dados_api.append( "dataRetirada", data_hora_retirada.toLocaleString( "en-US" ) );
                dados_api.append( "dataDevolucao", data_hora_devolucao.toLocaleString( "en-US" ) );
                                
                var ajax = new Ajax();
                ajax.transferir_dados_para_api("apis/gerar_pedido.php", "POST", dados_api, function(resultado) {
                    console.log(resultado);
                });
            }
            
            var modalAtual = $(botao).parents(".modal")[0];
            exibirModal( modalAtual, modalAlvo );
        });
    }
    
    function getClasseModal(elemento) {
        if( elemento === undefined ) return;
        
        var classes = elemento.className;
        classes = classes.split(' ');
        
        var classeModal;
        for( var i = 0; i < classes.length; ++i ) {
            if( classes[i].indexOf("js-modal") !== -1 ) {
                classeModal = classes[i];
            }
        }
                
        return classeModal;
    }
    
    function ocultarModais(listaModais) {                
        $(listaModais).css("display", "none");
        var containerModals = $("#container-modals")[0];            
        $(containerModals).css("display", "none");
    }
    
    function inicializarModaisLocacao() {
        var pagVeiculo = $("#pag-detalhes-veiculo")[0];        
        
        if( pagVeiculo !== undefined ) {
            
            var containerModals = $("#container-modals")[0];
            var modals = $(containerModals).children(".modal");
            
            var botaoAlugar = $(pagVeiculo).find("#botao-alugar")[0];                        
            var modalAlvo = $(containerModals).find( "." + getClasseModal(botaoAlugar) )[0];
                        
            definirBotaoModal(botaoAlugar, modalAlvo);
            
            var botaoConcluido = $("#botao-concluido")[0];            
            
            for( var i = 0; i < modals.length; ++i ) {
                var botaoTransferencia = $(modals[i]).children(".btn-avancar")[0];
                var modalAlvo = $(containerModals).children( "." + getClasseModal(botaoTransferencia) )[0]; 
                
                definirBotaoModal(botaoTransferencia, modalAlvo);
            }
            
            $(containerModals).click(function(e) {
                if( $(e.target).parents(".modal")[0] !== undefined || $(e.target).hasClass("modal")) return;
                
                ocultarModais(modals);               
            });
            
            $(botaoConcluido).click(function(e) {                
                ocultarModais(modals);
            });
        }
    }
    
    function preparar_data(data, hora) {
        data = data.split('/');
        
        data = data.reverse();
        for( var i = 0; i < data.length; ++i ) {
            data[i] = Number( data[i] );
        }
        
        data = data.join('/')
        data += " " + hora + ":00";
        return new Date(data);
    }
    
    function calcular_diarias(data_hora_retirada, data_hora_devolucao) {
        var diarias = Math.floor( ( data_hora_retirada - data_hora_devolucao ) / (1000 * 60 * 60 * 24) )+1;
                        
        return diarias;
    }
    
    function calcular_valor_total_diarias(data_retirada, hora_retirada, data_devolucao, hora_devolucao) {
        var data_hora_retirada = preparar_data(data_retirada, hora_retirada);
        var data_hora_devolucao = preparar_data(data_devolucao, hora_devolucao);
        
        if( isNaN(data_hora_retirada.getTime()) || isNaN(data_hora_devolucao.getTime()) ) return false;
        
        var diarias = calcular_diarias( data_hora_devolucao.getTime(), data_hora_retirada.getTime() );        
        
        var parametros_get = window.location.search;
        var id_publicacao = parametros_get.substr( parametros_get.indexOf("id=")+3, parametros_get.length );
        
        var dados_api = new FormData();
        dados_api.append( "idPublicacao", id_publicacao );
        
        var ajax = new Ajax();
        ajax.transferir_dados_para_api("apis/get_info_publicacao.php", "POST", dados_api, function(resultado) {
            var json_info_publicacao = JSON.parse( resultado );
            
            var valor_diaria = Number( json_info_publicacao.valorDiaria );
            
            var valor_total_diarias = diarias * valor_diaria;
            
            var label_total_diarias = $("#label-total-diarias")[0];
            var valor_formatado = (valor_total_diarias).toLocaleString("pt-BR", {
                style: "currency", 
                currency: "BRL", 
                minimunFractionDigits: 2
            });
            
            label_total_diarias.innerHTML = valor_formatado;
        });
        
        return true;
    }        
    
    function atualizarLabelsModalLocacao() {
        var data_retirada = $("#data-retirada")[0];
        var hora_retirada = $("#hora-retirada")[0];
        var data_devolucao = $("#data-devolucao")[0];
        var hora_devolucao = $("#hora-devolucao")[0];                            
        
        if( calcular_valor_total_diarias( data_retirada.value, hora_retirada.value, data_devolucao.value, hora_devolucao.value ) ) {
        
            var label_data_retirada = $("#label-data-retirada")[0];
            var label_data_devolucao = $("#label-data-devolucao")[0];

            var data_retirada_formatada = preparar_data( data_retirada.value, hora_retirada.value ).toLocaleString();
            data_retirada_formatada = data_retirada_formatada.substr(0, data_retirada_formatada.length-3);

            var data_devolucao_formatada = preparar_data( data_devolucao.value, hora_devolucao.value ).toLocaleString();
            data_devolucao_formatada = data_devolucao_formatada.substr(0, data_devolucao_formatada.length-3);

            label_data_retirada.innerHTML = data_retirada_formatada;
            label_data_devolucao.innerHTML = data_devolucao_formatada;
        }
    }        
    
    function definirAcaoDataLocacao(input_data, input_hora) {
        
        $(input_data).change(function() {
            atualizarLabelsModalLocacao();
        });
        
        $(input_hora).change(function() {
            atualizarLabelsModalLocacao();
        });
    }
    
    function inicializarPreenchimentoDatasLocacao() {
        var data_retirada = $("#data-retirada")[0];
        var hora_retirada = $("#hora-retirada")[0];
        var data_devolucao = $("#data-devolucao")[0];
        var hora_devolucao = $("#hora-devolucao")[0];
        
        definirAcaoDataLocacao( data_retirada, hora_retirada );
        definirAcaoDataLocacao( data_devolucao, hora_devolucao );
    }
    
    function exibirCarregamentoModal(modal) {
        var box_info = $(modal).children(".box-info")[0];                
        $(box_info).children().css("display", "none");

        var imagem_carregamento = document.createElement("img");
        imagem_carregamento.src = "img/loading_cityshare_black.gif";
        imagem_carregamento.style.display = "block";
        imagem_carregamento.style.margin = "0 auto";
        imagem_carregamento.style.marginTop = "100px";

        $(box_info).append(imagem_carregamento);
    }
    
    function pedido_atualizar_local(modo, callback) {
        var idPedido = window.location.search;
        idPedido = idPedido.substr( idPedido.indexOf("?id=")+4, idPedido.length );
        
        var data = new FormData();
        data.append("idPedido", idPedido);
        data.append("modo", modo);                
        
        var ajax = new Ajax();
        ajax.transferir_dados_para_api("apis/pedido_definir_local.php", "POST", data, function(resultado) {
            if( callback !== undefined ) callback(resultado);
        });
    }        
    
    function hover_botao_avaliacao(botao_avaliacao) {
        var box_botoes_avaliacao = $("#modal-pagamento-confirmado .box-botoes-avaliacao")[0];
        var botoes_avaliacao = box_botoes_avaliacao.getElementsByClassName("botao-avaliacao");
        $(botoes_avaliacao).removeClass("ativo");
        
        var indice_botao = $(botoes_avaliacao).index( botao_avaliacao );                                
        
        for( var i = 0; i <= indice_botao; ++i ) {
            var botao_a_ativar = botoes_avaliacao[i];
            
            $(botao_a_ativar).toggleClass("ativo");
        }
        
        $(botoes_avaliacao).removeClass("js-selected");
        $(botao_avaliacao).addClass("js-selected");
    }
    
    function inicializarBotoesAcaoPedido() {                
        var botao_local_retirada = $(".js-btn-local-retirada")[0];
        var botao_local_entrega = $(".js-btn-local-entrega")[0];
        var botao_retirada = $(".js-btn-solicitacao-retirada, .js-btn-confirmar-retirada");        
        var botao_devolucao = $(".js-btn-solicitar-devolucao, .js-btn-confirmar-devolucao");
        var botao_definir_pendencias = $(".js-btn-definir-pendencias");
        var botao_pendencias = $(".js-btn-pendencias-concordar, .js-btn-pendencias-discordar");        
        var botao_pagamento = $(".js-pagamento-cartao, .js-pagamento-dinheiro");
        var botao_confirmacao_pagamento = $(".js-pagamento-dinheiro-confirmar, .js-pagamento-dinheiro-negar");
        var botao_confirmar_avaliacao = $(".js-btn-confirmar-avaliacao");
        var botao_cancelar_locacao = $(".js-btn-cancelar-locacao");
        
        var RETIRADA = 1, DEVOLUCAO = 2;
        if( botao_local_retirada !== undefined ) {
            $(botao_local_retirada).click(function(e) {
                
                var box_modal = $(this).parents(".modal")[0];
                exibirCarregamentoModal( box_modal );                                
                
                pedido_atualizar_local( RETIRADA, function(resultado) {
                    console.log(resultado);
                    var box_botoes = $("#container-acoes-pedido")[0];
                    var botao_retirada = $(box_botoes).children("#botao-local-pedido")[0];
                    
                    box_botoes.removeChild( botao_retirada );
                    
                    ocultarModais(box_modal.parentNode);
                });
            });
        }
        
        if( botao_local_entrega !== undefined ) {
            $(botao_local_entrega).click(function(e) {
                
                var box_modal = $(this).parents(".modal")[0];
                exibirCarregamentoModal( box_modal );  
                
                pedido_atualizar_local( DEVOLUCAO, function(resultado) {                                    
                    var box_botoes = $("#container-acoes-pedido")[0];
                    var botao_devolucao = $(box_botoes).children("#botao-local-pedido")[0];
                    
                    box_botoes.removeChild( botao_devolucao );
                    
                    ocultarModais(box_modal.parentNode);
                });
            });
        }
                
        if( botao_retirada !== undefined ) {
            $( botao_retirada ).click(function(e) {                
                var idPedido = window.location.search;
                idPedido = idPedido.substr( idPedido.indexOf("?id=")+4, idPedido.length );                
                var codigo_seguranca_cartao = $(".js-txt-codigo-seguranca")[0].value;
                
                var data = new FormData();
                data.append("idPedido", idPedido);
                data.append("codigoSeguranca", codigo_seguranca_cartao);
                data.append("modo", RETIRADA);
                    
                var box_modal = $(this).parents(".modal")[0];
                exibirCarregamentoModal(box_modal);                                
                
                var ajax = new Ajax();
                ajax.transferir_dados_para_api("apis/pedido_solicitacao.php", "POST", data, function(resultado) {
                    console.log(resultado);
                    
                    var box_botoes = $("#container-acoes-pedido")[0];
                    var botao_solicitacao = $(box_botoes).children("#botao-solicitar-retirada")[0];
                    var botao_confirmacao = $(box_botoes).children("#botao-confirmar-retirada")[0];
                    
                    if( botao_solicitacao !== undefined ) {
                        box_botoes.removeChild( botao_solicitacao );   
                    }
                    
                    if( botao_confirmacao !== undefined ) {
                        box_botoes.removeChild( botao_confirmacao );   
                    }
                    
                    var botao_transferencia = $(box_modal).find(".botao")[0];                    
                    
                    var modal_alvo = $(box_modal.parentNode).children( "." + getClasseModal(botao_transferencia) );                    
                    
                    exibirModal(box_modal, modal_alvo);
                });
                
            });
        }
        
        if( botao_devolucao !== undefined ) {            
            $(botao_devolucao).click(function(e) {
                var idPedido = window.location.search;
                idPedido = idPedido.substr( idPedido.indexOf("?id=")+4, idPedido.length );
                
                var dados = new FormData();
                dados.append("idPedido", idPedido);
                dados.append("modo", DEVOLUCAO);
                
                var box_modal = $(this).parents(".modal")[0];
                exibirCarregamentoModal(box_modal);
                
                var ajax = new Ajax();
                ajax.transferir_dados_para_api("apis/pedido_solicitacao.php", "POST", dados, function(resultado) {
                    console.log(resultado);
                    
                    var box_botoes = $("#container-acoes-pedido")[0];
                    var botao_solicitacao = $(box_botoes).children("#botao-solicitar-devolucao")[0];
                    var botao_confirmacao = $(box_botoes).children("#botao-confirmar-devolucao")[0];
                    
                    if( botao_solicitacao !== undefined ) {
                        box_botoes.removeChild( botao_solicitacao );   
                    }
                    
                    if( botao_confirmacao !== undefined ) {
                        box_botoes.removeChild( botao_confirmacao );   
                    }                    
                    
                    var botao_transferencia = $(box_modal).find(".botao")[0];                    
                    
                    var modal_alvo = $(box_modal.parentNode).children( "." + getClasseModal(botao_transferencia) );                    
                    
                    exibirModal(box_modal, modal_alvo);                
                });
            });
        }
        
        if( botao_definir_pendencias !== undefined ) {
            $(botao_definir_pendencias).click(function(e) {                
                                
                var idPedido = window.location.search;
                idPedido = idPedido.substr( idPedido.indexOf("?id=")+4, idPedido.length );
                
                var quilometragemExcedida = $(".js-txt-distancia-excedida")[0].value;
                var combustivelRestante = $(".js-txt-combustivel-restante")[0].value;
                
                var dados = new FormData();
                dados.append("idPedido", idPedido);
                dados.append("quilometragemExcedida", quilometragemExcedida);
                dados.append("combustivelRestante", combustivelRestante);
                
                var box_modal = $(this).parents(".modal")[0];
                exibirCarregamentoModal(box_modal);                                
                
                var ajax = new Ajax();
                ajax.transferir_dados_para_api("apis/pedido_definir_pendencias.php", "POST", dados, function(resultado) {
                    console.log(resultado);
                    var botao_definir_pendencias = $("#botao-definir-pendencias")[0];
                    
                    if( botao_definir_pendencias !== undefined ) {
                        botao_definir_pendencias.parentNode.removeChild(botao_definir_pendencias);
                    }
                    
                    var botao_transferencia = $(box_modal).find(".botao")[0];
                    var modal_alvo = $(box_modal.parentNode).children( "." + getClasseModal(botao_transferencia) );                                              
                    exibirModal(box_modal, modal_alvo);     
                });
            });
        }
        
        if( botao_pendencias !== undefined ) {
            $(botao_pendencias).click(function(e) {                
                var CONCORDO = 1, DISCORDO = 0;
                
                var idPedido = window.location.search;
                idPedido = idPedido.substr( idPedido.indexOf("?id=")+4, idPedido.length );
                
                var statusPendencia = ( $(this).hasClass("js-btn-pendencias-concordar") )? CONCORDO : DISCORDO                
                
                var dados = new FormData();
                dados.append("idPedido", idPedido);
                dados.append("statusPendencia", statusPendencia);                                
                
                var box_modal = $(this).parents(".modal")[0];
                exibirCarregamentoModal(box_modal); 
                
                var ajax = new Ajax();
                ajax.transferir_dados_para_api("apis/pedido_definir_pendencias.php", "POST", dados, function(resultado) {                                                            
                    console.log(resultado);
                    var botao_visualizar_pendencias = $("#botao-visualizar-pendencias")[0];
                    
                    if( statusPendencia === DISCORDO ) {                    
                        botao_visualizar_pendencias.parentNode.removeChild( botao_visualizar_pendencias );
                        ocultarModais(box_modal.parentNode);
                    } else {                    
                        var botao_transferencia = $(box_modal).find(".js-btn-pendencias-concordar")[0];
                        var modal_alvo = $(box_modal.parentNode).children( "." + getClasseModal(botao_transferencia) );                                              
                        exibirModal(box_modal, modal_alvo); 
                        
                        $(botao_visualizar_pendencias).removeClass( getClasseModal(box_modal) );
                        $(botao_visualizar_pendencias).addClass( getClasseModal($(".js-btn-pendencias-concordar")[0]) );
                        
                        var modal_pagamento_pendencias =  $(".modal." + getClasseModal($(".js-btn-pendencias-concordar")[0]))[0];
                        
                        $(botao_visualizar_pendencias).off("click");
                        definirBotaoModal( botao_visualizar_pendencias, modal_pagamento_pendencias );
                    }
                    
                });
            });
                        
            if( botao_pagamento !== undefined ) {
                $( botao_pagamento ).click(function(e) {                    
                    var PAGAMENTO_CARTAO = 1, PAGAMENTO_DINHEIRO = 2;
                    
                    var idPedido = window.location.search;
                    idPedido = idPedido.substr( idPedido.indexOf("?id=")+4, idPedido.length );
                    
                    var formaPagamento = ( $(this).hasClass("js-pagamento-cartao") )? PAGAMENTO_CARTAO : PAGAMENTO_DINHEIRO;
                    console.log(formaPagamento);
                    
                    var dados = new FormData();
                    dados.append("idPedido", idPedido);
                    dados.append("formaPagamento", formaPagamento);
                                                            
                    var box_modal = $(this).parents(".modal")[0];
                                        
                    if( formaPagamento === PAGAMENTO_CARTAO ) { 
                        console.log(box_modal);
                        var codigo_seguranca_cartao = $(box_modal).find(".js-txt-codigo-seguranca-cartao")[0].value;
                        
                        dados.append("codigoSegurancaCartao", codigo_seguranca_cartao);
                    }
                    
                    exibirCarregamentoModal(box_modal);
                    
                    var ajax = new Ajax();
                    ajax.transferir_dados_para_api("apis/pedido_realizar_pagamento.php", "POST", dados, function(resultado) {
                        console.log(resultado);
                        
                        var botao_avanco = $(box_modal).find(".js-pagamento-cartao")[0];
                        
                        if( botao_avanco === undefined ) {                        
                            botao_avanco = $(box_modal).find(".js-pagamento-dinheiro")[0];
                        }
                        
                        var modal_alvo = $(box_modal.parentNode).children("." + getClasseModal(botao_avanco));
                        
                        exibirModal(box_modal, modal_alvo);
                        
                        var modal_pagamento_pendencias = $("#modal-pagamento-pendencias")[0];
                        var titulo_modal = $(modal_pagamento_pendencias).children(".box-info").children(".titulo")[0];
                        titulo_modal.innerHTML = "Pendências Definidas";
                        
                        $(modal_pagamento_pendencias).find(".box-acoes")[0].style.display = "none";
                    });
                });
            }
            
            if( botao_confirmacao_pagamento !== undefined ) {
                $( botao_confirmacao_pagamento ).click(function(e) {
                    var PAGAMENTO_CONFIRMADO = 1, PAGAMENTO_NEGADO = 2;                    
                    var botao_avanco = this;
                    
                    var idPedido = window.location.search;
                    idPedido = idPedido.substr( idPedido.indexOf("?id=")+4, idPedido.length );
                    
                    var is_confirmado = ( $(this).hasClass("js-pagamento-dinheiro-confirmar") )? 1 : 2;
                    console.log(is_confirmado);
                    
                    var dados = new FormData();
                    dados.append("idPedido", idPedido);
                    dados.append("confirmacaoPagamento", is_confirmado);
                    
                    var box_modal = $(this).parents(".modal")[0];
                    exibirCarregamentoModal(box_modal);
                    
                    var ajax = new Ajax();
                    ajax.transferir_dados_para_api("apis/pedido_confirmar_recebimento.php", "POST", dados, function(resultado) {
                        console.log(resultado);
                        
                        var modal_alvo = $(box_modal.parentNode).children("." + getClasseModal(botao_avanco));
                        
                        exibirModal(box_modal, modal_alvo);
                    });
                });
            }
            
            if( botao_confirmar_avaliacao !== undefined ) {
                $(botao_confirmar_avaliacao).click(function(e) {
                                        
                    var box_modal = $(this).parents(".modal")[0];
                    
                    var comentario_avaliacao = $(box_modal).find(".js-txt-mensagem-avaliacao")[0].value;
                    var box_botoes_avaliacao = $(box_modal).find(".box-botoes-avaliacao")[0];
                    var botoes_avaliacao = $(box_botoes_avaliacao).children(".botao-avaliacao");
                    var botao_avaliacao_selecionado = $(box_botoes_avaliacao).children(".js-selected")[0];
                    var nota = $(botoes_avaliacao).index(botao_avaliacao_selecionado)+1;
                    
                    var idPedido = window.location.search;
                    idPedido = idPedido.substr( idPedido.indexOf("?id=")+4, idPedido.length );
                    
                    var dados = new FormData();
                    dados.append("idPedido", idPedido);
                    dados.append("notaAvaliacao", nota);                    
                    dados.append("mensagemAvaliacao", comentario_avaliacao);
                                        
                    console.log(box_modal);
                    exibirCarregamentoModal(box_modal);
                    
                    var ajax = new Ajax();
                    ajax.transferir_dados_para_api("apis/pedido_avaliacao.php", "POST", dados, function(resultado) {                               
                        exibirModal(box_modal);
                        $("#botao-avaliar-locacao").css("display", "none");
                    });
                });                
            }
            
            if( botao_cancelar_locacao !== undefined ) {
                $(botao_cancelar_locacao).click(function(e) {
                    var box_modal = $(this).parents(".modal")[0];
                    
                    var idPedido = window.location.search;
                    idPedido = idPedido.substr( idPedido.indexOf("?id=")+4, idPedido.length );
                    
                    var dados = new FormData();
                    dados.append( "idPedido", idPedido );
                    
                    var ajax = new Ajax();
                    ajax.transferir_dados_para_api("apis/pedido_cancelar.php", "POST", dados, function(resultado) {
                        console.log(resultado);
                        
                        var objeto = JSON.parse(resultado);
                        console.log(objeto);
                        
                        if( objeto.resultado === true ) {
                            window.location = "perfil.php?id=" + objeto.idUsuario;
                        }
                    });
                    
                });
            }
            
            var box_botoes_avaliacao = $("#modal-pagamento-confirmado .box-botoes-avaliacao")[0];
            var botoes_avaliacao = box_botoes_avaliacao.getElementsByClassName("botao-avaliacao");                                    
            
            for( var i = 0; i < botoes_avaliacao.length; ++i ) {
                var botao_avaliacao = botoes_avaliacao[i];
                
                $(botao_avaliacao).click(function(e) {
                    $(botoes_avaliacao).removeClass("js-selected");
                    $(this).addClass("js-selected");
                    
                    $(botoes_avaliacao).off("mouseleave");
                });
            }
            
            $(botoes_avaliacao).mouseenter(function(e) {                
                hover_botao_avaliacao(this);                                
            });
            
            $(botoes_avaliacao).mouseleave(function(e) {
                hover_botao_avaliacao(this);
            });
            
            var botoes_contato = $(".box-contato");
            $(botoes_contato).click(function(e) {                
                $(this).toggleClass("ativo");
                
                var info_contato = $(this).find(".info-contato")[0];                
                
                if( $(this).hasClass("ativo") ) {
                    
                    setTimeout(function() {
                        info_contato.style.display = "block";
                    }, 200);
                    
                } else {
                                                            
                    setTimeout(function() {
                        info_contato.style.display = "none";
                    }, 0);
                    
                }                                
                
            });
        }
    }
    
    function inicializarModaisPedido() {
        var detalhesPedido = $("#pag-pedido")[0];
        
        if( detalhesPedido !== undefined ) {
            var botoesPedido = $("#container-acoes-pedido .botao");
            
            var containerModals = $("#container-modals")[0];
            for( var i = 0; i < botoesPedido.length; ++i ) {
                var botaoAcaoPedido = botoesPedido[i];
                                
                var modal_alvo = $(containerModals).find( ".modal." + getClasseModal(botaoAcaoPedido) )[0];                            
                
                definirBotaoModal(botaoAcaoPedido, modal_alvo);
            }
            
            var modals = $(containerModals).children(".modal");
            $(".modal .botao-fechar").click(function(e) {
                ocultarModais( modals );
            });
            
            for( var i = 0; i < modals.length; ++i ) {
                var botoesTransferencia = $(modals[i]).find(".btn-avancar");
                
                for( var x = 0; x < botoesTransferencia.length; ++x ) {
                    var modalAlvo = $(containerModals).children( "." + getClasseModal(botoesTransferencia[x]) )[0];                    
                    definirBotaoModal(botoesTransferencia[x], modalAlvo);
                }

            }
            
            $(containerModals).click(function(e) {
                if( $(e.target).parents(".modal")[0] !== undefined || $(e.target).hasClass("modal")) return;                
                
                ocultarModais(modals);
            });
            
            inicializarBotoesAcaoPedido();
                        
            $('#slider-combustivel').slider({
                value: 1,
                min: 0,
                max: 8,
                step: 1,
                slide: function( event, ui ) {
                    $( ".js-txt-combustivel-restante" ).val( ui.value );
                    $( ".label-combustivel" ).text( ui.value + "/8" );
                }
            });
            
        }
    }
    
    function ocultarSessoesPedido() {
        var box_detalhes = $("#container-info-pedido")[0];
        var box_acoes = $("#container-acoes-pedido")[0];
        var box_historico = $("#container-historico-pedido")[0];
        
        $(box_detalhes).css("display", "none");
        $(box_acoes).css("display", "none");
        $(box_historico).css("display", "none");
    }
    
    function inicializarBotoesSessaoPedido() {
        
        var pagPedido = $("#pag-pedido")[0];
        
        if( pagPedido !== undefined ) {
            var botao_detalhes = $( "#botao-detalhes" )[0];
            var botao_acoes = $( "#botao-acoes" )[0];
            var botao_historico = $( "#botao-historico" )[0];
            
            $( botao_detalhes ).click(function(e) {                
                var box_detalhes = $("#container-info-pedido")[0];
                ocultarSessoesPedido();
                
                $(box_detalhes).css("display", "block");
            });
            
            $( botao_acoes ).click(function(e) {                
                var box_acoes = $("#container-acoes-pedido")[0];
                ocultarSessoesPedido();
                
                $(box_acoes).css("display", "block");
            });
            
            $( botao_historico ).click(function(e) {                
                var box_historico = $("#container-historico-pedido")[0];
                ocultarSessoesPedido();
                
                $(box_historico).css("display", "block");
            });
            
        }        
    }        
    
    function carregarListaPedidos(pagina_alvo, increment = false) {
        var box_listagem = $("#box-listagem")[0];        
        var conteudo_listagem = box_listagem.innerHTML;
        
        var imagem_carregamento = document.createElement("img");
        imagem_carregamento.src = "img/loading_cityshare_black.gif";
        imagem_carregamento.style.display = "block";
        imagem_carregamento.style.margin = "0 auto";
        
        if( !increment ) {
            box_listagem.innerHTML = "";
        }
        
        box_listagem.appendChild( imagem_carregamento );
        
        var dados = new FormData();

        var idUsuario = window.location.search;
        idUsuario = idUsuario.substr( idUsuario.indexOf("user=") + 5, idUsuario.length );                

        dados.append("idUsuario", idUsuario);
        dados.append("paginaAtual", pagina_alvo);                
        
        var ajax = new Ajax();        
        ajax.transferir_dados_para_api("apis/listagem_pedidos.php", "POST", dados, function(resultado) {            
            
            if( increment ) {
                box_listagem.innerHTML = conteudo_listagem + resultado;                
            } else {
                box_listagem.innerHTML = resultado;
            }
            
            var botao_carregar_mais_pedidos = $("#botao-exibir-mais")[0];
            
            if( resultado.length === 0 ) {
                botao_carregar_mais_pedidos.style.display = "none";
            } else {
                botao_carregar_mais_pedidos.style.display = "block";    
            }
            
        });
    }
    
    var lista_json_solicitacoes = [];
    function carregarListaSolicitacoes(pagina_alvo, increment = false) {
        var box_listagem = $("#box-listagem")[0];        
        var conteudo_listagem = box_listagem.innerHTML;
        
        var imagem_carregamento = document.createElement("img");
        imagem_carregamento.src = "img/loading_cityshare_black.gif";
        imagem_carregamento.style.display = "block";
        imagem_carregamento.style.margin = "0 auto";
        
        if( !increment ) {
            box_listagem.innerHTML = "";
            pagina_alvo = 1;
        }
        
        box_listagem.appendChild( imagem_carregamento );
        
        var dados = new FormData();

        var idUsuario = window.location.search;
        idUsuario = idUsuario.substr( idUsuario.indexOf("user=") + 5, idUsuario.length );                

        dados.append("idUsuario", idUsuario);
        dados.append("paginaAtual", pagina_alvo);                
        
        var ajax = new Ajax();        
        ajax.transferir_dados_para_api("apis/listagem_solicitacoes.php", "POST", dados, function(resultado) {                                    
            var nova_lista_solicitacoes = JSON.parse( resultado );
            
            if( nova_lista_solicitacoes.length !== 0 ) {            
                lista_json_solicitacoes = nova_lista_solicitacoes;                                                                                                              
            }
                        
            if( increment && nova_lista_solicitacoes.length > 0 ) {                
                box_listagem.innerHTML = conteudo_listagem + criarListaSolicitacoes(lista_json_solicitacoes);                
            } else {                
                console.log("not increment");
                box_listagem.innerHTML = criarListaSolicitacoes(lista_json_solicitacoes);
            }
            
            var botao_carregar_mais_pedidos = $("#botao-exibir-mais")[0];  
            
            if( nova_lista_solicitacoes.length === 0 ) {
                botao_carregar_mais_pedidos.style.display = "none";
            } else {
                botao_carregar_mais_pedidos.style.display = "block";    
            }
            
        });
    }
    
    function formatarData(data) {
        var meses = [
            "Jan",
            "Fev",
            "Mar",
            "Abr",
            "Mai",
            "Jun",
            "Jul",
            "Ago",
            "Set",
            "Out",
            "Nov",
            "Dez"
        ];
        
        var dataFormatada = ("0" + (data.getUTCDate())).slice(-2) + '/' + 
            meses[(data.getUTCMonth())] + '/' +
            data.getFullYear() + " - " +
            ("0" + (data.getHours())).slice(-2) + ':' +
            ("0" + (data.getMinutes())).slice(-2);
        
        return dataFormatada;
    }
    
    function criarListaSolicitacoes(lista_json) {
        console.log("CRIANDO LISTA");
        console.log( lista_json );
        
        var html = "";
        for( var i = 0; i < lista_json.length; ++i ) {
            var solicitacao = lista_json[i];
            
            if( solicitacao.idStatusPedido != 1 ) {
                html += '<div class="box-solicitacao aceito">';
            } else {
                html += '<div class="box-solicitacao">';    
            }
                        
            html += '<div class="wrapper-box-info">';
            html += '<div class="box-foto-info">';
            html += '<div class="box-foto">';
            html += '<a href="pedido.php?id=' + solicitacao.id + '"><img class="foto-pedido" src="" /></a>';
            html += '</div>';
            html += '<div class="box-info">';
            html += '<p class="valor-diaria">Total: R$' + solicitacao.valorTotal.toString().replace(".", ",") + '</p>';
            html += '<p class="modelo-veiculo">' + solicitacao.veiculo + '</p>';
            html += '<div class="box-icone-data">';
            html += '<span class="icone retirada"></span>';
            
            var dataRetirada = new Date( solicitacao.dataRetirada );                                      
            var dataEntrega = new Date( solicitacao.dataEntrega );
            
            html += '<p class="data">' + formatarData(dataRetirada) + '</p>';
            html += '</div>';
            html += '<div class="box-icone-data">';
            html += '<span class="icone entrega"></span>';
            html += '<p class="data">' + formatarData(dataEntrega) + '</p>';
            html += '</div>';
            html += '</div>';
            html += '</div>';                        
            html += '<div class="box-info-locatario">';            
            html += '<div class="info-locatario">';
            
            if( solicitacao.idStatusPedido != 1 ) {
                html += '<p class="status">' + solicitacao.statusPedido + '</p>';
            }
            
            html += '<p class="nome-locatario">' + solicitacao.nomeLocatario + ' ' + solicitacao.sobrenomeLocatario[0] + '</p>';
            html += '<p class="localizacao-locatario">' + solicitacao.estadoLocatario + ', ' + solicitacao.cidadeLocatario + '</p>';
            
            if( solicitacao.idStatusPedido == 1 ) {
                html += '<div class="box-avaliacoes">';
                html += '<div class="container-icone-avaliacoes">';
                html += '<div class="icone-avaliacao"></div>';
                html += '<div class="icone-avaliacao"></div>';
                html += '<div class="icone-avaliacao"></div>';
                html += '<div class="icone-avaliacao"></div>';
                html += '<div class="icone-avaliacao"></div>';
                html += '</div>';
                html += '</div>';
            }
            
            html += '</div>';            
                        
            if( solicitacao.idStatusPedido == 1 ) {
                html += '<div class="box-acoes">';
                html += '<div class="box-botoes">';
                html += '<span class="preset-botao botao js-btn-aceitar">Aceitar</span>';
                html += '<span class="preset-botao botao js-btn-recusar">Recusar</span>';
                html += '</div>';
                html += '</div>';
            }
                        
            html += '</div>';
            html += '</div>';
            html += '</div>';
        }
        
        return html;
    }
    
    var paginaAtual = 1;
    function inicializarBotoesSessaoSolicitacoesEPedidos() {
        var pagSolicitacoesPedidos = $("#pag-solicitacoes")[0];
        
        if( pagSolicitacoesPedidos !== undefined ) {
            var botaoPedidos = $("#btnPedidos")[0];
            var botaoSolicitacoes = $("#btnSolicitacoes")[0];
                                                                                    
            $( botaoPedidos ).click( function(e) {
                paginaAtual = 1;
                
                var botao_carregar_mais_pedidos = $("#botao-exibir-mais")[0];
                botao_carregar_mais_pedidos.className = "js-load-pedidos";
                botao_carregar_mais_pedidos.style.display = "none";
                
                carregarListaPedidos(paginaAtual);
            });
            
            $(document).on("click", ".js-load-pedidos", function(e) {
                ++paginaAtual;  
                
                carregarListaPedidos(paginaAtual, true);
                var botao_carregar_mais_pedidos = $("#botao-exibir-mais")[0];
                botao_carregar_mais_pedidos.style.display = "none";
            });
            
            $( botaoSolicitacoes ).click( function(e) {
                paginaAtual = 1;
                
                var botao_carregar_mais_solicitacoes = $("#botao-exibir-mais")[0];
                botao_carregar_mais_solicitacoes.className = "js-load-solicitacoes";
                botao_carregar_mais_solicitacoes.style.display = "none";
                                
                carregarListaSolicitacoes(paginaAtual);
            });
            
            $(document).on("click", ".js-load-solicitacoes", function(e) {
                ++paginaAtual;                
                
                carregarListaSolicitacoes(paginaAtual, true);
                var botao_carregar_mais_solicitacoes = $("#botao-exibir-mais")[0];
                botao_carregar_mais_solicitacoes.style.display = "none";
            });
            
            inicializarBotoesControleSolicitacao();
        }
    }
            
    function inicializarBotoesControleSolicitacao() {
        var pagSolicitacoesPedidos = $("#pag-solicitacoes")[0];
        
        if( pagSolicitacoesPedidos !== undefined ) {            
            $(document).on("click", ".js-btn-recusar", function(e) {
                var box_solicitacao_selecionada = $(this).parents(".box-solicitacao")[0];
                
                var box_listagem = $("#box-listagem")[0];
                var lista_solicitacoes = box_listagem.childNodes;
                
                var indice_solicitacao_selecionada = $(lista_solicitacoes).index(box_solicitacao_selecionada);
                
                var solicitacao_selecionada = lista_json_solicitacoes[indice_solicitacao_selecionada];
                                                
                var dados = new FormData();
                dados.append("idSolicitacao", solicitacao_selecionada.id);
                dados.append("modo", "recusar");
                
                var ajax = new Ajax();
                
                var imagem_carregamento = document.createElement("img");
                imagem_carregamento.src = "img/loading_cityshare_black.gif";
                imagem_carregamento.style.display = "block";
                imagem_carregamento.style.margin = "0 auto";
                
                box_solicitacao_selecionada.innerHTML = "";                
                box_solicitacao_selecionada.appendChild( imagem_carregamento );
                
                ajax.transferir_dados_para_api("apis/listagem_solicitacoes.php", "POST", dados, function(resultado) {                     
                    lista_json_solicitacoes.splice(indice_solicitacao_selecionada, 1);
                    
                    box_listagem.removeChild( box_solicitacao_selecionada );
                    
                    if( lista_json_solicitacoes.length === 0 ) {
                        var botao_carregar_mais_pedidos = $("#botao-exibir-mais")[0];
                        botao_carregar_mais_pedidos.style.display = "none";
                    }
                });
            });
            
            $(document).on("click", ".js-btn-aceitar", function(e) {
                var box_solicitacao_selecionada = $(this).parents(".box-solicitacao")[0];
                
                var box_listagem = $("#box-listagem")[0];
                var lista_solicitacoes = box_listagem.childNodes;
                
                var indice_solicitacao_selecionada = $(lista_solicitacoes).index(box_solicitacao_selecionada);                
                
                var solicitacao_selecionada = lista_json_solicitacoes[indice_solicitacao_selecionada];
                                            
                var dados = new FormData();
                dados.append("idSolicitacao", solicitacao_selecionada.id);
                dados.append("modo", "aceitar");
                
                var ajax = new Ajax();
                
                var imagem_carregamento = document.createElement("img");
                imagem_carregamento.src = "img/loading_cityshare_black.gif";
                imagem_carregamento.style.display = "block";
                imagem_carregamento.style.margin = "0 auto";
                
                box_listagem.innerHTML = "";
                box_listagem.appendChild( imagem_carregamento );
                
                ajax.transferir_dados_para_api("apis/listagem_solicitacoes.php", "POST", dados, function(resultado) {                     
                    console.log(resultado);
                    carregarListaSolicitacoes( paginaAtual );
                    
                    if( lista_json_solicitacoes.length === 0 ) {
                        var botao_carregar_mais_pedidos = $("#botao-exibir-mais")[0];
                        botao_carregar_mais_pedidos.style.display = "none";
                    }
                });
            });                        
        }
    }
    
    function criarListaPublicacoesUsuario( lista_json ) {
        var html = "";
        
        for( var i = 0; i <lista_json.length; i++ ) {
            var publicacao = lista_json[i];
            
            html += '<div class="box-publicacao">';
            html += '<a href="veiculo.php?id=' + publicacao.id + '">';
            html += '<div class="foto-publicacao" style="background-image: url("img/uploads/publicacoes/")")"></div>';
            html += '</a>';
            html += '<section class="box-info-publicacao">';
            html += '<h1 class="titulo">'+ publicacao.titulo +'</h1>';
            html += '<p class="modelo-veiculo">'+ publicacao.modeloVeiculo +'</p>';
            html += '<div class="box-diaria">';            
            html += '<p class="diaria">R$'+ publicacao.valorDiaria.toString().replace(".", ","); +'</p>';
            html += '<p class="label-diaria">diária</p>';
            html += '</div>';
            html += '</section>';
            html += '</div>';
        }
        
        return html;
    }
    
    function criarListaAvaliacoesUsuario( lista_json ) {
        var html = "";
        
        for( var i = 0; i<lista_json.length; i++ ) {
            var avaliacao = lista_json[i];
            
            html += '<div class="box-avaliacao">';
            html += '<section class="info-avaliador">';
            html += '<div class="info-detalhes">'+ avaliacao.nomeAvaliador +'</div>';
            var dataAvaliacao = new Date( avaliacao.dataAvaliacao );            
            html += '<div class="info-detalhes">'+ dataAvaliacao.toLocaleString().split(" ")[0] +'</div>';
            html += '<div class="info-detalhes">Avaliação: '+ avaliacao.nota.toString(); +'</div>';
            html += '</section>';
            html += '<p>Mensagem:</p>'
            html += '<div class="mensagem">'+ avaliacao.mensagem +'</div>';
            html += '</div>';
        }
        
        return html;
    }
    
    function inicializarBotaoPublicacaoUsuario() {
        var pagPerfilUsuario = $("#pag-perfil-usuario")[0];
        
        if( pagPerfilUsuario !== undefined ) {
            var paginaAtual = 1;
            var botaoVerMais = $("#botao-ver-mais")[0];
            
            carregarListaPublicacaoUsuario(paginaAtual, false);
            
            $( botaoVerMais ).off("click");
            $( botaoVerMais ).click( function(e) {
                ++paginaAtual;  
                
                carregarListaPublicacaoUsuario(paginaAtual, true);
                var botao_carregar_mais_publicacoes = $("#botao-ver-mais")[0];
                botao_carregar_mais_publicacoes.style.display = "none";
            });            
        }
    }

    var lista_json_publicacoes = [];
    function carregarListaPublicacaoUsuario(pagina_alvo, increment = false) {
        var box_info_publicacao = $("#container-publicacoes-avaliacoes .wrapper-publicacoes-avaliacoes")[0];        
        var conteudo_listagem = box_info_publicacao.innerHTML;
        
        var imagem_carregamento = document.createElement("img");
        imagem_carregamento.src = "img/loading_cityshare_black.gif";
        imagem_carregamento.style.display = "block";
        imagem_carregamento.style.margin = "0 auto";
        
        if( !increment ) {
            box_info_publicacao.innerHTML = "";
        }
        
        box_info_publicacao.appendChild( imagem_carregamento );

        var dados = new FormData();

        var idUsuario = window.location.search;
        idUsuario = idUsuario.substr( idUsuario.indexOf("user=") + 5, idUsuario.length );                

        dados.append("idUsuario", idUsuario);
        dados.append("paginaAtual", pagina_alvo);                
        
        var ajax = new Ajax();        
        ajax.transferir_dados_para_api("apis/listagem_publicacoes_usuario.php", "POST", dados, function(resultado) {
            console.log(resultado);
            lista_json_publicacoes = JSON.parse( resultado );
            
            if( increment ) {
                box_info_publicacao.innerHTML = conteudo_listagem + criarListaPublicacoesUsuario( lista_json_publicacoes );              
            } else {
                box_info_publicacao.innerHTML = criarListaPublicacoesUsuario( lista_json_publicacoes );
            }

            var botao_carregar_mais_publicacoes = $("#botao-ver-mais")[0];            
            
            if( lista_json_publicacoes.length === 0 ) {                
                botao_carregar_mais_publicacoes.style.display = "none";
            } else {
                botao_carregar_mais_publicacoes.style.display = "block";
            }
            
        });
    }
    
    var lista_json_avaliacoes = [];
    function carregarListaAvaliacaoUsuario(pagina_alvo, increment = false) {
        var box_info_avaliacao = $("#container-publicacoes-avaliacoes .wrapper-publicacoes-avaliacoes")[0];
        var conteudo_listagem = box_info_avaliacao.innerHTML;
        
        var imagem_carregamento = document.createElement("img");
        imagem_carregamento.src = "img/loading_cityshare_black.gif";
        imagem_carregamento.style.display = "block";
        imagem_carregamento.style.margin = "0 auto";
        
        if( !increment ) {
            box_info_avaliacao.innerHTML = "";
        }
        
        box_info_avaliacao.appendChild( imagem_carregamento );
        
        var dados = new FormData();
        
        var idUsuario = window.location.search;
        idUsuario = idUsuario.substr( idUsuario.indexOf("user=") + 5, idUsuario.length );
        
        dados.append("idUsuario", idUsuario);
        dados.append("paginaAtual", pagina_alvo);
        
        var ajax = new Ajax();
        ajax.transferir_dados_para_api("apis/listagem_avaliacoes_usuario.php", "POST", dados, function(resultado) {
           
            lista_json_avaliacoes = JSON.parse( resultado );
            
            if( increment ) {
                box_info_avaliacao.innerHTML = conteudo_listagem + criarListaAvaliacoesUsuario( lista_json_avaliacoes );
            } else {
                box_info_avaliacao.innerHTML = criarListaAvaliacoesUsuario( lista_json_avaliacoes );
            }
        });
    }
    
    function inicializarBotoesPublicacaoAvaliacao() {
        var pagina_perfil_publico = $("#pag-perfil-usuario")[0];
        
        if( pagina_perfil_publico !== undefined ) {
            
            var box_conteudo = $("#container-publicacoes")[0];
            var conteudo_publicacoes_avaliacoes = $("#container-publicacoes-avaliacoes .wrapper-publicacoes-avaliacoes")[0];
            var conteudo_listagem = conteudo_publicacoes_avaliacoes.innerHTML;
            var botao_publicacoes = $(".js-btn-publicacao")[0];
            var botao_avaliacoes = $(".js-btn-avaliacao")[0];
            var paginaAtual = 1;
            var increment = false;
            
            var idUsuario = window.location.toString();
            idUsuario = idUsuario.substr( idUsuario.indexOf("id=")+3, idUsuario.length );
            id = Number(idUsuario);
            
            var dados_api = new FormData();
            dados_api.append("idUsuario", id);
            
            var imagem_carregamento = document.createElement("img");
            imagem_carregamento.src = "img/loading_cityshare_black.gif";
            
            imagem_carregamento.style.display = "block";
            imagem_carregamento.style.margin = "auto";
            imagem_carregamento.style.marginTop = "200px";
            
            $(botao_publicacoes).click(function() {
                conteudo_publicacoes_avaliacoes.style.display = "block";
                carregarListaPublicacaoUsuario();
            });
            
            $(botao_avaliacoes).click(function() {
                conteudo_publicacoes_avaliacoes.style.display = "block";
                carregarListaAvaliacaoUsuario();
            });

        }
    }

    function ativarBotaoFormularioConfiguracao(botao) {
        $("#box-botoes .botao").removeClass("ativo");
        
        $(botao).addClass("ativo");
    }
    
    function exibirFormularioConfiguracao(formulario) {
        var box_form = $("#box-form")[0];
        
        $( box_form.children ).css("display", "none");
        $( formulario ).css("display", "block");
    }
    
    function inicializarSessoesConfiguracaoConta() {
        var pagina_configuracao_conta = $("#pag-config-perfil");
        
        if( pagina_configuracao_conta !== undefined ) {
                                    
            $(".js-botao-pessoais").click(function(e) {
                var formularioAlvo = $("#form-info-pessoais")[0];
                exibirFormularioConfiguracao( formularioAlvo );
                
                ativarBotaoFormularioConfiguracao(this);
            });
            
            $(".js-botao-contato").click(function(e) {
                var formularioAlvo = $("#form-info-contato")[0];
                exibirFormularioConfiguracao( formularioAlvo );
                
                ativarBotaoFormularioConfiguracao(this);
            });
            
            $(".js-botao-financeiro").click(function(e) {
                var formularioAlvo = $("#form-info-financeiro")[0];
                exibirFormularioConfiguracao( formularioAlvo );
                
                ativarBotaoFormularioConfiguracao(this);
            });
            
            $(".js-botao-conducao").click(function(e) {
                var formularioAlvo = $("#form-info-conducao")[0];
                exibirFormularioConfiguracao( formularioAlvo );
                
                ativarBotaoFormularioConfiguracao(this);
            });
            
            $(".js-botao-autenticacao").click(function(e) {
                var formularioAlvo = $("#form-info-autenticacao")[0];
                exibirFormularioConfiguracao( formularioAlvo );
                
                ativarBotaoFormularioConfiguracao(this);
            });
            
            var botao_foto = $("#botao-foto")[0];
            var input_foto = $("#input-foto")[0];
            
            definirBotaoSelecaoImagem( botao_foto, input_foto );
        }
    }
    
    if( tamanhoTela.indexOf("mobile") != -1 ) {
        
        inicializarPreenchimentoDatasLocacao();
        inicializarModaisLocacao();
        inicializarMenusMobile();
        inicializarEtapasCadastro();
        inicializarSlide();
        inicializarSelecionadorImagensVeiculo();
        inicializarModaisPedido();
        inicializarBotoesSessaoPedido();
        inicializarBotoesSessaoSolicitacoesEPedidos();
        inicializarBotaoPublicacaoUsuario();
        inicializarBotoesPublicacaoAvaliacao();
        inicializarSessoesConfiguracaoConta();
        
    } else if( tamanhoTela.indexOf("desktop") != -1 ) {
        
        inicializarPreenchimentoDatasLocacao();
        inicializarModaisLocacao();
        efeitoHoverLocadorDestaque();
        efeitoSlidedownLogin();
        inicializarMenusDesktop();
        inicializarEtapasCadastro();
        inicializarSlide();
        inicializarSelecionadorImagensVeiculo();
        inicializarModaisPedido();
        inicializarBotoesSessaoSolicitacoesEPedidos();
        inicializarBotaoPublicacaoUsuario();
        inicializarBotoesPublicacaoAvaliacao();       
        inicializarSessoesConfiguracaoConta();
    }
    
    $('.faq').click(function (){        
        $(this).find('.faq-answer').slideToggle('fast');
    });
});