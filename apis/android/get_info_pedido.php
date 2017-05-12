<?php
    require_once("../../include/initialize.php");
    require_once("../../include/classes/tbl_pedido.php");
    
    $idPedido = ( isset($_POST["idPedido"]) )? (int) $_POST["idPedido"] : null;

    $buscaPedidos = new \Tabela\Pedido();
    $listaPedidos = $buscaPedidos->listarPedidos(null, null, "p.id = {$idPedido}");

    echo json_encode( $listaPedidos[0] );
?>