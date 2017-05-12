<?php
    require_once("../../include/initialize.php");
    require_once("../../include/classes/tbl_pedido.php");
    
    $idUsuario = ( isset($_POST["idUsuario"]) )? (int) $_POST["idUsuario"] : null;    
    $idStatusPedido = ( isset($_POST["idStatusPedido"]) )? (int) $_POST["idStatusPedido"] : null;
    $idStatusPedidoLimite = ( isset($_POST["idStatusPedidoLimite"]) )? $_POST["idStatusPedidoLimite"] : null;

    $buscaPedidos = new \Tabela\Pedido();
    $listaPedidos = $buscaPedidos->listarPedidos(null, null, "idUsuarioLocatario = {$idUsuario} AND idStatusPedido >= {$idStatusPedido} AND idStatusPedido <= {$idStatusPedidoLimite}");

    echo json_encode( $listaPedidos );
?>