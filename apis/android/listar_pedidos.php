<?php
    require_once("../../include/initialize.php");
    require_once("../../include/classes/tbl_pedido.php");
    
    $idUsuario = ( isset($_POST["idUsuario"]) )? (int) $_POST["idUsuario"] : null;    
    $idStatusPedido = ( isset($_POST["idStatusPedido"]) )? (int) $_POST["idStatusPedido"] : null;
    $idStatusPedidoLimite = ( isset($_POST["idStatusPedidoLimite"]) )? $_POST["idStatusPedidoLimite"] : null;
    
    $sql = "SELECT p.id, p.idPublicacao, p.dataRetirada, p.dataEntrega, p.idUsuarioLocatario AS idLocatario, ";
    $sql .= "u.nome AS nomeLocador, u.sobrenome AS sobrenomeLocador, sp.titulo AS statusPedido, v.nome AS veiculo, pu.imagemPrincipal ";
    $sql .= "FROM tbl_pedido AS p ";
    $sql .= "INNER JOIN tbl_usuario AS u ";
    $sql .= "ON u.id = p.idUsuarioLocador ";
    $sql .= "INNER JOIN tbl_statuspedido AS sp ";
    $sql .= "ON sp.id = p.idStatusPedido ";
    $sql .= "INNER JOIN tbl_veiculo AS v ";
    $sql .= "ON v.id = p.idVeiculo ";
    $sql .= "INNER JOIN tbl_publicacao AS pu ";
    $sql .= "ON pu.id = p.idPublicacao ";
    $sql .= "WHERE p.idUsuarioLocatario = {$idUsuario}";

    $buscaPedidos = new \Tabela\Pedido();
    $listaPedidos = $buscaPedidos->executarQuery( $sql );
    $listaPedidos = $buscaPedidos->get_array_from_resultado( $listaPedidos );

    echo json_encode( $listaPedidos );
?>