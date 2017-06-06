<?php
    require_once("../include/initialize.php");
    require_once("../include/classes/sessao.php");
    require_once("../include/classes/tbl_pedido.php");
    require_once("../include/classes/tbl_status_pedido.php");
    require_once("../include/classes/tbl_alteracao_pedido.php");

    $idPedido = ( isset($_POST["idPedido"]) )? (int) $_POST["idPedido"] : null;

    $resultado = false;
    if( !empty($idPedido) ) {
        
        $infoPedido = new \Tabela\Pedido();
        $infoPedido = $infoPedido->buscar("id = {$idPedido}")[0];
        $infoPedido->id = $idPedido;
        
        $statusPedido = new \Tabela\StatusPedido();
        $statusPedido = $statusPedido->buscar("cod = {$STATUS_PEDIDO_CANCELADO}")[0];
                    
        $infoPedido->idStatusPedido = $statusPedido->id;
        
        $alteracaoPedido = new \Tabela\AlteracaoPedido();
        $alteracaoPedido->idPedido = $idPedido;
        $alteracaoPedido->dataOcorrencia = get_data_atual_mysql();
        $alteracaoPedido->idStatus = $statusPedido->id;
        
        $alteracaoPedido->inserir();
        $resultado = $infoPedido->atualizar();
    }
    
    $object = new stdClass();
    
    $sessao = new Sessao();
    $object->idUsuario = $sessao->get("idUsuario");
    $object->resultado = $resultado;

    echo json_encode($object);
?>