$(document).ready(function() {
    
    function buildViewNotificacoes(idUsuario, listaNotificacoes) {                
        var conteudo = "";
        
        var qtd_notificacoes_nao_lidas = 0;
        for( var indice in listaNotificacoes ) {                        
            var notificacao = listaNotificacoes[indice];
            
            if( notificacao.visualizada === 0 ) {
                ++qtd_notificacoes_nao_lidas;
            }
            
            var idTipoNotificacao = notificacao.idTipoNotificacao;
            var classe_tipo_notificacao = "";
            var url_target = "";
            
            var SOLICITACAO = 1, ATUALIZACAO_PEDIDO = 2, AVALIACAO = 3;
            if( idTipoNotificacao === SOLICITACAO ) {
                classe_tipo_notificacao = "solicitacao";               
                
                url_target = "solicitacoes.php?user=" + idUsuario;
            } else if( idTipoNotificacao === ATUALIZACAO_PEDIDO ) {
                classe_tipo_notificacao = "pedido";
                url_target = "pedido.php?id=" + notificacao.idPedido;
            } else if( idTipoNotificacao === AVALIACAO ) {
                classe_tipo_notificacao = "avaliacao";
                url_target = "pedido.php?id=" + notificacao.idPedido;
            }
            
            conteudo += '<section class="box-notificacao">';
            conteudo += '<a href="' + url_target + '">';
            conteudo += '<div class="icone-notificacao ' + classe_tipo_notificacao + '"></div>';
            conteudo += '<div class="info-notificacao">';
            conteudo += '<h1 class="titulo-notificacao">' + notificacao.tipoNotificacao + '</h1>';
            conteudo += '<p class="conteudo-notificacao">' + notificacao.mensagem + '</p>';
            conteudo += '</div>';
            conteudo += '</a>';
            conteudo += '</section>';
        }
        
        var contagemNotificacoes = $("#contagem-notificacoes")[0];
        var label_contagem = $(contagemNotificacoes).children("#label")[0];        
        
        if( qtd_notificacoes_nao_lidas > 0 ) {
            label_contagem.innerHTML = qtd_notificacoes_nao_lidas;
            $(contagemNotificacoes).css("display", "block");
        } else {
            $(contagemNotificacoes).css("display", "none");
        }
        
        var containerNotificacoes = $("#container-notificacoes")[0];
        containerNotificacoes.innerHTML = conteudo;
        
        var botaoNotificacoes = $("#icone-notificacao")[0];
        $(botaoNotificacoes).click(function(e) {
            label_contagem.innerHTML = "0";
            $(contagemNotificacoes).css("display", "none");
            
            var notificacoes_nao_lidas = [];
            for( var indice in listaNotificacoes ) {
                if( listaNotificacoes[indice].visualizada === 0 ) {
                    notificacoes_nao_lidas.push( listaNotificacoes[indice].id );
                }
            }
            
            var url = "apis/alterar_status_notificacoes.php";
            
            var dados = new FormData();            
            dados.append("listaIdNotificacoes", notificacoes_nao_lidas);
            
            var ajax = new Ajax();
            ajax.transferir_dados_para_api( url, "POST", dados);
            
        });
    }
            
    function asyncNotificacoes(idUsuario, listaNotificacoes) {
        var url = "apis/get_notificacoes_usuario.php";
        var ajax = new Ajax();
        
        var dados = new FormData();
        dados.append("where", "n.idUsuarioDestinatario = " + idUsuario);
        
        ajax.transferir_dados_para_api(url, "POST", dados, function(json) {                
            var novaListaNotificacoes = JSON.parse(json);
            
            if( listaNotificacoes.length !== novaListaNotificacoes.length ) {
                listaNotificacoes = novaListaNotificacoes;
                buildViewNotificacoes(idUsuario, listaNotificacoes);
            }

        });            
    }
    
    function getNotificacoes() {
        var ajax = new Ajax();
        ajax.conectar("apis/get_id_usuario_logado.php", function(idUsuario) {    
            var listaNotificacoes = [];
            
            asyncNotificacoes(idUsuario, listaNotificacoes);
                                        
            setInterval(function() {                
                
                var url = "apis/get_notificacoes_usuario.php";    
                var dados = new FormData();
                dados.append("where", "n.idUsuarioDestinatario = " + idUsuario);
                
                ajax.transferir_dados_para_api(url, "POST", dados, function(json) {
                    var novaListaNotificacoes = JSON.parse(json);

                    if( listaNotificacoes.length !== novaListaNotificacoes.length ) {
                        listaNotificacoes = novaListaNotificacoes;
                        buildViewNotificacoes(idUsuario, listaNotificacoes);
                    }

                });
                
            }, 5000);
            
        });        
    }
        
    getNotificacoes();
});