<?php
    sleep(1);
    require_once("../include/initialize.php");
    require_once("../include/classes/tbl_pedido.php");
    require_once("../include/classes/tbl_alteracao_pedido.php");
    require_once("../include/classes/sessao.php");

    $idPedido = ( isset($_POST["idPedido"]) )? (int) $_POST["idPedido"]: null;
    $quilometragemExcedida = ( isset($_POST["quilometragemExcedida"]) )? (int) $_POST["quilometragemExcedida"] : null;
    $combustivelRestante = ( isset($_POST["combustivelRestante"]) )? (int) $_POST["combustivelRestante"] : null;

    $infoPedido = new \Tabela\Pedido();
    $infoPedido = $infoPedido->buscar("id = {$idPedido}")[0];
    
    $sessao = new Sessao();
    $idUsuario = $sessao->get("idUsuario");
    
    $is_locador = null;
    if( $infoPedido->idUsuarioLocador == $idUsuario ) {
        $is_locador = true;
    } elseif( $infoPedido->idUsuarioLocatario == $idUsuario ) {
        $is_locador = false;
    }
    
    $alteracaoPendencia = new \Tabela\AlteracaoPedido();
    $alteracaoPendencia->dataOcorrencia = strftime( "%Y-%m-%d %H:%M:%S", strtotime(get_data_atual()) );
    $alteracaoPendencia->idPedido = $idPedido;

    $alteracaoPedido = new \Tabela\AlteracaoPedido();
    $alteracaoPedido->dataOcorrencia = strftime( "%Y-%m-%d %H:%M:%S", strtotime(get_data_atual()) );
    $alteracaoPedido->idPedido = $idPedido;        

    if( $is_locador ) {
        $id_aguardando_confirmacao_pendencias = 7;
        
        $alteracaoPedido->idStatus = $id_aguardando_confirmacao_pendencias;
        
        $infoPedido->quilometragemExcedida = $quilometragemExcedida;
        $infoPedido->combustivelRestante = $combustivelRestante;
        $infoPedido->idStatusPedido = $id_aguardando_confirmacao_pendencias;                
        
        $infoPedido->atualizar();
    } else {
        
        $is_pendencia_aceita = ( isset($_POST["statusPendencia"]) )? (int) $_POST["statusPendencia"] : null;        
        
        if( $is_pendencia_aceita ) {
            $id_aguardando_pagamento_pendencias = 8;            
            $id_pendencia_aceita = 12;
            
            $alteracaoPedido->idStatus = $id_aguardando_pagamento_pendencias;
            $alteracaoPendencia->idStatus = $id_pendencia_aceita;
            
            $infoPedido->idStatusPedido = $id_aguardando_pagamento_pendencias;                        
        } else {
            $id_aguardando_definicao_pendencias = 6;            
            $id_pendencia_recusada = 11;
            
            $alteracaoPedido->idStatus = $id_aguardando_definicao_pendencias;
            $alteracaoPendencia->idStatus = $id_pendencia_recusada;
            
            $infoPedido->idStatusPedido = $id_aguardando_definicao_pendencias;
        }
                
        $infoPedido->atualizar();
        $alteracaoPendencia->inserir();
        $alteracaoPedido->inserir();        
    }
?>