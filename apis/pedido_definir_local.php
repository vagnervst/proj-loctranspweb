<?php
    sleep(1);
    require_once("../include/initialize.php");
    require_once("../include/classes/tbl_pedido.php");
    require_once("../include/classes/tbl_status_pedido.php");
    require_once("../include/classes/tbl_alteracao_pedido.php");
    require_once("../include/classes/sessao.php");

    $RETIRADA = 1;
    $DEVOLUCAO = 2;

    $idPedido = ( isset($_POST["idPedido"]) )? (int) $_POST["idPedido"] : null;
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
                $infoPedido->localRetiradaLocador = 1;
            } else {
                $infoPedido->localRetiradaLocatario = 1;
            }

            echo json_encode( $infoPedido );
            
            if( $infoPedido->localRetiradaLocador == 1 && $infoPedido->localRetiradaLocatario == 1 ) {
                                    
                $statusPedido = new \Tabela\StatusPedido();
                $statusPedido = $statusPedido->buscar("cod = {$STATUS_PEDIDO_AGUARDANDO_CONFIRMACAO_RETIRADA}")[0];
                
                $infoPedido->idStatusPedido = $statusPedido->id;

                $historicoAlteracaoPedido = new \Tabela\AlteracaoPedido();
                $historicoAlteracaoPedido->dataOcorrencia = get_data_atual_mysql();
                $historicoAlteracaoPedido->idPedido = $idPedido;
                $historicoAlteracaoPedido->idStatus = $statusPedido->id;
                $historicoAlteracaoPedido->inserir();
                
                echo "INSERINDO ALTERACAO";
                echo json_encode($historicoAlteracaoPedido);
            }

        } elseif( $modo == $DEVOLUCAO ) {

            if( $is_locador ) {
                $infoPedido->localDevolucaoLocador = 1;                
            } else {
                $infoPedido->localDevolucaoLocatario = 1;
            }                

            if( $infoPedido->localDevolucaoLocador == 1 && $infoPedido->localDevolucaoLocatario == 1 ) {                
                
                $statusPedido = new \Tabela\StatusPedido();
                $statusPedido = $statusPedido->buscar("cod = {$STATUS_PEDIDO_AGUARDANDO_CONFIRMACAO_ENTREGA}")[0];
                
                $infoPedido->idStatusPedido = $statusPedido->id;            

                $historicoAlteracaoPedido = new \Tabela\AlteracaoPedido();
                $historicoAlteracaoPedido->dataOcorrencia = get_data_atual_mysql();
                $historicoAlteracaoPedido->idPedido = $idPedido;
                $historicoAlteracaoPedido->idStatus = $statusPedido->id;            
                $historicoAlteracaoPedido->inserir();
            }
        }
                
        $resultado = $infoPedido->atualizar();
    }

    echo json_encode($resultado)
?>