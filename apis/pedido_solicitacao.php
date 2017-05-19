<?php
    sleep(1);
    require_once("../include/initialize.php");
    require_once("../include/classes/sessao.php");
    require_once("../include/classes/tbl_pedido.php");
    require_once("../include/classes/tbl_alteracao_pedido.php");
    require_once("../include/classes/tbl_cityshare.php");
    require_once("../include/classes/tbl_status_pedido.php");
    require_once("../include/classes/tbl_usuario.php");

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
        $infoPedido = $infoPedido->buscar("id = {$idPedido}")[0];
                        
        $is_locador = null;
        if( $infoPedido->idUsuarioLocador == $idUsuario ) {
            $is_locador = true;
        } elseif( $infoPedido->idUsuarioLocatario == $idUsuario ) {
            $is_locador = false;
        }        
        
        if( $modo == $RETIRADA ) {
            
            if( $is_locador ) {                
                $infoPedido->solicitacaoRetiradaLocador = 1;
            } else {                
                $infoPedido->solicitacaoRetiradaLocatario = 1;
            }

            if( $infoPedido->solicitacaoRetiradaLocador == 1 && $infoPedido->solicitacaoRetiradaLocatario == 1 ) {                
                
                $statusPedido = new \Tabela\StatusPedido();
                $statusPedido = $statusPedido->buscar("cod = {$STATUS_PEDIDO_AGUARDANDO_CONFIRMACAO_LOCAL_ENTREGA}")[0];
                
                $infoPedido->idStatusPedido = $statusPedido->id;
                
                $alteracaoPedido = new \Tabela\AlteracaoPedido();
                $alteracaoPedido->dataOcorrencia = get_data_atual_mysql();
                $alteracaoPedido->idPedido = $idPedido;
                $alteracaoPedido->idStatusPedido = $statusPedido->id;
                $alteracaoPedido->inserir();
                
                $usuario_locador = new \Tabela\Usuario();
                $usuario_locador = $usuario_locador->buscar("id = {$infoPedido->idUsuarioLocador}")[0];
                
                
                $valorTotal = $infoPedido->listarPedidos(null, null, "p.id = {$idPedido}")[0]->valorTotal;                
                
                $usuario_locador->saldo = $usuario_locador->saldo + $valorTotal;
                $usuario_locador->atualizar();                
            }

        } elseif( $modo == $DEVOLUCAO ) {

            if( $is_locador ) {
                $infoPedido->solicitacaoDevolucaoLocador = 1;
            } else {
                $infoPedido->solicitacaoDevolucaoLocatario = 1;
                $infoPedido->dataEntregaEfetuada = get_data_atual_mysql();
            }
            
            if( $infoPedido->solicitacaoDevolucaoLocador == 1 && $infoPedido->solicitacaoDevolucaoLocatario == 1 ) {                       
                
                $statusPedido = new \Tabela\StatusPedido();
                $statusPedido = $statusPedido->buscar("cod = {$STATUS_PEDIDO_AGUARDANDO_DEFINICAO_PENDENCIAS}")[0];
                
                $infoPedido->idStatusPedido = $statusPedido->id;

                $alteracaoPedido = new \Tabela\AlteracaoPedido();
                $alteracaoPedido->dataOcorrencia = get_data_atual_mysql();
                $alteracaoPedido->idPedido = $idPedido;
                $alteracaoPedido->idStatusPedido = $statusPedido->id;
                $alteracaoPedido->inserir(); 
            }

        }
                                
        $resultado = $infoPedido->atualizar();
    }
        
    echo json_encode( $resultado );
?>