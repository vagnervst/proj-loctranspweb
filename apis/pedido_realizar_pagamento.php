<?php
    sleep(1);
    require_once("../include/initialize.php");
    require_once("../include/classes/tbl_pedido.php");
    require_once("../include/classes/tbl_alteracao_pedido.php");
    require_once("../include/classes/sessao.php");

    $idPedido = ( isset($_POST["idPedido"]) )? (int) $_POST["idPedido"] : null;
    $formaPagamento = ( isset($_POST["formaPagamento"]) )? (int) $_POST["formaPagamento"] : null;
    $codigoSegurancaCartao = ( isset($_POST["codigoSegurancaCartao"]) )? (int) $_POST["codigoSegurancaCartao"] : null;

    $sessao = new Sessao();
    $idUsuario = (int) $sessao->get("idUsuario");

    $infoPedido = new \Tabela\Pedido();
    $infoPedido = $infoPedido->buscar("id = {$idPedido}")[0];

    $is_locador = null;
    if( $infoPedido->idUsuarioLocador == $idUsuario ) {
        $is_locador = true;
    } elseif( $infoPedido->idUsuarioLocatario == $idUsuario ) {
        $is_locador = false;
    }

    $CARTAO_CREDITO = 1;
    $DINHEIRO = 2;
    
    $id_pedido_concluido = 9;
    
    $alteracaoPendencias = new \Tabela\AlteracaoPedido();
    $alteracaoPendencias->dataOcorrencia = get_data_atual_mysql();
    $alteracaoPendencias->idPedido = $idPedido;

    $alteracaoPedido = new \Tabela\AlteracaoPedido();
    $alteracaoPedido->dataOcorrencia = get_data_atual_mysql();
    $alteracaoPedido->idPedido = $idPedido;
    $alteracaoPedido->idStatus = $id_pedido_concluido;
    
    if( $formaPagamento == $CARTAO_CREDITO && !$is_locador && !empty($codigoSegurancaCartao) ) {        
        $id_pagamento_cartao_credito = 14;
        
        $infoPedido->idFormaPagamentoPendencias = $CARTAO_CREDITO;
        $infoPedido->idStatusPedido = $id_pedido_concluido;
        $alteracaoPendencias->idStatus = $id_pagamento_cartao_credito;
                       
    } elseif( $formaPagamento == $DINHEIRO && !$is_locador ) {
        $id_pagamento_dinheiro = 13;
        
        $infoPedido->idFormaPagamentoPendencias = $DINHEIRO;
        $infoPedido->idStatusPedido = $id_pedido_concluido;
        $alteracaoPendencias->idStatus = $id_pagamento_dinheiro;
        
    }

    $infoPedido->atualizar();
    $altercacaoPendencias->inserir();
    $alteracaoPedido->inserir(); 
?>