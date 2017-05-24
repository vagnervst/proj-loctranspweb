<?php
    sleep(1);
    require_once("../include/initialize.php");
    require_once("../include/classes/sessao.php");
    require_once("../include/classes/tbl_pedido.php");
    require_once("../include/classes/tbl_percentual_lucro.php");
    require_once("../include/classes/tbl_alteracao_pedido.php");
    require_once("../include/classes/tbl_cityshare.php");
    require_once("../include/classes/tbl_status_pedido.php");
    require_once("../include/classes/tbl_usuario.php");
    require_once("../include/classes/tbl_notificacao.php");

    $RETIRADA = 1;
    $DEVOLUCAO = 2;

    $idPedido = ( isset($_POST["idPedido"]) )? (int) $_POST["idPedido"] : null;
    $codigoCartao = ( isset($_POST["codigoSeguranca"]) )? (int) $_POST["codigoSeguranca"] : null;
    $modo = ( isset($_POST["modo"]) && $_POST["modo"] == $RETIRADA )? $RETIRADA : $DEVOLUCAO;
    
    $sessao = new Sessao();
    $idUsuario = -1;
    if( $sessao->get("idUsuario") != null ) {
        $idUsuario = (int) $sessao->get("idUsuario");
    } else {
        $idUsuario = ( isset($_POST["idUsuario"]) )? (int) $_POST["idUsuario"] : -1;
    }
    
    $resultado = false;
    
    if( $idUsuario != -1 ) {        
         
        $infoPedido = new \Tabela\Pedido();
        $infoPedido = $infoPedido->listarPedidos("p.id = {$idPedido}")[0];
                        
        $is_locador = null;
        if( $infoPedido->idUsuarioLocador == $idUsuario ) {
            $is_locador = true;
        } elseif( $infoPedido->idUsuarioLocatario == $idUsuario ) {
            $is_locador = false;
        }        
        
        $notificacao = new \Tabela\Notificacao();
        $notificacao->idPedido = $idPedido;
        $notificacao->idTipoNotificacao = 2;
        $notificacao->visualizada = 0;
        if( $modo == $RETIRADA ) {
            
            if( $is_locador ) {                
                $infoPedido->solicitacaoRetiradaLocador = 1;
                
                $notificacao->idUsuarioRemetente = $infoPedido->idUsuarioLocador;
                $notificacao->idUsuarioDestinatario = $infoPedido->idUsuarioLocatario;
                $notificacao->mensagem = $infoPedido->nomeLocador . " " . $infoPedido->sobrenomeLocador[0] . " confirmou a retirada do veículo";
                $notificacao->inserir();
            } else {                
                $infoPedido->solicitacaoRetiradaLocatario = 1;
                
                $notificacao->idUsuarioRemetente = $infoPedido->idUsuarioLocatario;
                $notificacao->idUsuarioDestinatario = $infoPedido->idUsuarioLocador;
                $notificacao->mensagem = $infoPedido->nomeLocatario . " " . $infoPedido->sobrenomeLocatario[0] . " solicitou a retirada do veículo";
                $notificacao->inserir();
            }

            if( $infoPedido->solicitacaoRetiradaLocador == 1 && $infoPedido->solicitacaoRetiradaLocatario == 1 ) {
                
                $statusPedido = new \Tabela\StatusPedido();
                $statusPedido = $statusPedido->buscar("cod = {$STATUS_PEDIDO_AGUARDANDO_CONFIRMACAO_LOCAL_ENTREGA}")[0];
                
                $infoPedido->idStatusPedido = $statusPedido->id;
                
                $alteracaoPedido = new \Tabela\AlteracaoPedido();
                $alteracaoPedido->dataOcorrencia = get_data_atual_mysql();
                $alteracaoPedido->idPedido = $idPedido;
                $alteracaoPedido->idStatus = $statusPedido->id;
                $alteracaoPedido->inserir();                                
                
                $usuario_locador = new \Tabela\Usuario();
                $usuario_locador = $usuario_locador->buscar("id = {$infoPedido->idUsuarioLocador}")[0];
                                    
                $notificacao->mensagem = "Retirada de veículo efetuada";
                
                $notificacao->idUsuarioRemetente = $infoPedido->idUsuarioLocador;
                $notificacao->idUsuarioDestinatario = $infoPedido->idUsuarioLocatario;                
                $notificacao->inserir();
                
                $notificacao->idUsuarioRemetente = $infoPedido->idUsuarioLocatario;
                $notificacao->idUsuarioDestinatario = $infoPedido->idUsuarioLocador;
                $notificacao->inserir();
                                                
                $cityshare = new \Tabela\Cityshare();
                $cityshare->id = 1;
                
                $percentualLucro = new \Tabela\PercentualLucro();
                $percentualLucro = $percentualLucro->buscar("idCategoria = {$infoPedido->idCategoriaVeiculo} AND valorMinimo <= {$infoPedido->valorVeiculo}");
                
                if( count($percentualLucro) == 0 ) {
                    $percentualLucro = new \Tabela\PercentualLucro();
                    $percentualLucro = $percentualLucro->buscar("idCategoria = {$infoPedido->idCategoriaVeiculo}")[0];
                }
                
                $percentualLucro = $percentualLucro[0]->percentual;
                
                $valorTotal = $infoPedido->listarPedidos(null, null, "p.id = {$idPedido}")[0]->valorTotal;
                $lucro_city_share = $valorTotal * ($percentualLucro/100);
                
                $usuario_locador->saldo = $usuario_locador->saldo - $lucro_city_share;
                $usuario_locador->atualizar();
                                                
                $cityshare->saldo = $cityshare->saldo + $lucro_city_share;
                $cityshare->atualizar();
            }

        } elseif( $modo == $DEVOLUCAO ) {

            if( $is_locador ) {
                $infoPedido->solicitacaoDevolucaoLocador = 1;
                
                $notificacao->idUsuarioRemetente = $infoPedido->idUsuarioLocador;
                $notificacao->idUsuarioDestinatario = $infoPedido->idUsuarioLocatario;
                $notificacao->mensagem = $infoPedido->nomeLocador . " " . $infoPedido->sobrenomeLocador[0] . " confirmou a entrega do veículo";
                $notificacao->inserir();
            } else {
                $infoPedido->solicitacaoDevolucaoLocatario = 1;
                $infoPedido->dataEntregaEfetuada = get_data_atual_mysql();
                
                $infoPedido->solicitacaoRetiradaLocatario = 1;
                $notificacao->idUsuarioRemetente = $infoPedido->idUsuarioLocatario;
                $notificacao->idUsuarioDestinatario = $infoPedido->idUsuarioLocador;
                $notificacao->mensagem = $infoPedido->nomeLocatario . " " . $infoPedido->sobrenomeLocatario[0] . " solicitou a entrega do veículo";
                $notificacao->inserir();
            }
            
            if( $infoPedido->solicitacaoDevolucaoLocador == 1 && $infoPedido->solicitacaoDevolucaoLocatario == 1 ) {                       
                
                $statusPedido = new \Tabela\StatusPedido();
                $statusPedido = $statusPedido->buscar("cod = {$STATUS_PEDIDO_AGUARDANDO_DEFINICAO_PENDENCIAS}")[0];
                
                $infoPedido->idStatusPedido = $statusPedido->id;

                $alteracaoPedido = new \Tabela\AlteracaoPedido();
                $alteracaoPedido->dataOcorrencia = get_data_atual_mysql();
                $alteracaoPedido->idPedido = $idPedido;
                $alteracaoPedido->idStatus = $statusPedido->id;
                $alteracaoPedido->inserir(); 
                
                $notificacao->mensagem = "Devolução de veículo efetuada";
                
                $notificacao->idUsuarioRemetente = $infoPedido->idUsuarioLocador;
                $notificacao->idUsuarioDestinatario = $infoPedido->idUsuarioLocatario;                
                $notificacao->inserir();
                
                $notificacao->idUsuarioRemetente = $infoPedido->idUsuarioLocatario;
                $notificacao->idUsuarioDestinatario = $infoPedido->idUsuarioLocador;
                $notificacao->inserir();
            }

        }
                                
        $resultado = $infoPedido->atualizar();
    }
        
    echo json_encode( $resultado );
?>