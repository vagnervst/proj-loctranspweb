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
                $infoPedido->localRetiradaLocador = true;
            } else {
                $infoPedido->localRetiradaLocatario = true;
            }

            if( $infoPedido->localRetiradaLocador == true && $infoPedido->localRetiradaLocatario == true ) {
                $id_status_aguardando_retirada = 3;

                $infoPedido->idStatusPedido = $id_status_aguardando_retirada;

                $historicoAlteracaoPedido = new \Tabela\AlteracaoPedido();
                $historicoAlteracaoPedido->dataOcorrencia = get_data_atual_mysql();
                $historicoAlteracaoPedido->idPedido = $idPedido;
                $historicoAlteracaoPedido->idStatus = $id_status_aguardando_retirada;
                $historicoAlteracaoPedido->inserir();
            }

        } elseif( $modo == $DEVOLUCAO ) {

            if( $is_locador ) {
                $infoPedido->localDevolucaoLocador = true;
                $infoPedido->dataEntregaEfetuada = get_data_atual_mysql();
            } else {
                $infoPedido->localDevolucaoLocatario = true;
            }                

            if( $infoPedido->localDevolucaoLocador && $infoPedido->localDevolucaoLocatario ) {
                $id_definicao_pendencias = 5;

                $infoPedido->idStatusPedido = $id_definicao_pendencias;            

                $historicoAlteracaoPedido = new \Tabela\AlteracaoPedido();
                $historicoAlteracaoPedido->dataOcorrencia = get_data_atual_mysql();
                $historicoAlteracaoPedido->idPedido = $idPedido;
                $historicoAlteracaoPedido->idStatus = $id_definicao_pendencias;            
                $historicoAlteracaoPedido->inserir();
            }
        }

        $resultado = $infoPedido->atualizar();
    }

    echo json_encode($resultado)
?>