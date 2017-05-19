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

            if( $infoPedido->localRetiradaLocador == true && $infoPedido->localRetiradaLocatario == true ) {
                $cod_status_aguardando_retirada = 3;
                    
                $statusPedido = new \Tabela\StatusPedido();
                $statusPedido = $statusPedido->buscar("cod = {$cod_status_aguardando_retirada}")[0];
                
                $infoPedido->idStatusPedido = $statusPedido->id;

                $historicoAlteracaoPedido = new \Tabela\AlteracaoPedido();
                $historicoAlteracaoPedido->dataOcorrencia = get_data_atual_mysql();
                $historicoAlteracaoPedido->idPedido = $idPedido;
                $historicoAlteracaoPedido->idStatusPedido = $statusPedido->id;
                $historicoAlteracaoPedido->inserir();
            }

        } elseif( $modo == $DEVOLUCAO ) {

            if( $is_locador ) {
                $infoPedido->localDevolucaoLocador = 1;                
            } else {
                $infoPedido->localDevolucaoLocatario = 1;
            }                

            if( $infoPedido->localDevolucaoLocador && $infoPedido->localDevolucaoLocatario ) {
                $cod_status_aguardando_entrega = 5;
                
                $statusPedido = new \Tabela\StatusPedido();
                $statusPedido = $statusPedido->buscar("cod = {$cod_status_aguardando_entrega}")[0];
                
                $infoPedido->idStatusPedido = $statusPedido->id;            

                $historicoAlteracaoPedido = new \Tabela\AlteracaoPedido();
                $historicoAlteracaoPedido->dataOcorrencia = get_data_atual_mysql();
                $historicoAlteracaoPedido->idPedido = $idPedido;
                $historicoAlteracaoPedido->idStatusPedido = $statusPedido->id;            
                $historicoAlteracaoPedido->inserir();
            }
        }
        echo json_encode( $infoPedido );
        
        $resultado = $infoPedido->atualizar();
    }

    echo json_encode($resultado)
?>