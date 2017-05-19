<?php
    require_once("../../include/initialize.php");
    require_once("../../include/classes/tbl_pedido.php");
    require_once("../../include/classes/tbl_alteracao_pedido.php");
    
    $idPedido = ( isset($_POST["idPedido"]) )? (int) $_POST["idPedido"] : null;

    $buscaPedidos = new \Tabela\Pedido();
    $pedido = $buscaPedidos->listarPedidos(null, null, "p.id = {$idPedido}");
    
    $pedido = $pedido[0];
    
    $buscaHistoricoAlteracao = new \Tabela\AlteracaoPedido();
    $buscaHistoricoAlteracao->idPedido = $idPedido;

    $historicoAlteracao = $buscaHistoricoAlteracao->getAlteracaoPedido("a.idPedido = {$idPedido}");
    $pedido->historicoAlteracao = $historicoAlteracao;
    
    echo json_encode( $pedido );
?>