<?php 
    require_once("../include/initialize.php");
    require_once("../include/classes/tbl_pedido.php");
    sleep(1);
    
    $ID_STATUS_PEDIDO_RECUSADO = 10;
    $ID_STATUS_PEDIDO_ACEITO = 2;

    $modo = ( isset($_POST["modo"]) )? $_POST["modo"] : null;
    
    $idUsuario = ( isset($_POST["idUsuario"]) )? (int) $_POST["idUsuario"] : null;
    $idSolicitacao = ( isset($_POST["idSolicitacao"]) )? (int) $_POST["idSolicitacao"] : null;
    $paginaAtual = ( isset($_POST["paginaAtual"]) )? (int) $_POST["paginaAtual"] : 1;
    $registros_por_pagina = 10;        

    if( !empty($idSolicitacao) && !empty($modo) && $modo == "recusar" ) {
        $solicitacao = new \Tabela\Pedido();
        $solicitacao->id = $idSolicitacao;
        $solicitacao->idStatusPedido = $ID_STATUS_PEDIDO_RECUSADO;
        $solicitacao->atualizar();
    } elseif( !empty($idSolicitacao) && !empty($modo) && $modo == "aceitar" ) {
        $solicitacao = new \Tabela\Pedido();
        $solicitacao->id = $idSolicitacao;
        $solicitacao->idStatusPedido = $ID_STATUS_PEDIDO_ACEITO;
        $solicitacao->atualizar();
    }

    $buscaSolicitacoes = new \Tabela\Pedido();
    $listaSolicitacoes = $buscaSolicitacoes->listarPedidos( $registros_por_pagina, $paginaAtual, "p.idStatusPedido != {$ID_STATUS_PEDIDO_RECUSADO} AND locador.id = {$idUsuario}" );

    echo json_encode($listaSolicitacoes);
?>