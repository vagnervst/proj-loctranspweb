<?php
    sleep(1);
    require_once("../include/initialize.php");
    require_once("../include/classes/tbl_pedido.php");
    require_once("../include/classes/tbl_status_pedido.php");
    require_once("../include/classes/tbl_alteracao_pedido.php");
    require_once("../include/classes/sessao.php");

    $idPedido = ( isset($_POST["idPedido"]) )? (int) $_POST["idPedido"]: null;
    $quilometragemExcedida = ( isset($_POST["quilometragemExcedida"]) )? (int) $_POST["quilometragemExcedida"] : null;
    $combustivelRestante = ( isset($_POST["combustivelRestante"]) )? (int) $_POST["combustivelRestante"] : null;

    $infoPedido = new \Tabela\Pedido();
    $infoPedido = $infoPedido->buscar("id = {$idPedido}")[0];
    
    $sessao = new Sessao();

    $idUsuario = -1;    
    if( $sessao->get("idUsuario") != null ) {
        $idUsuario = (int) $sessao->get("idUsuario");   
    } else {
        $idUsuario = ( isset($_POST["idUsuario"]) )? (int) $_POST["idUsuario"] : -1;
    }
    
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
    
    $resultado = false;
    if( $is_locador ) {                
        $statusPedido = new \Tabela\StatusPedido();
        $statusPedido = $statusPedido->buscar("cod = {$STATUS_PEDIDO_AGUARDANDO_CONFIRMACAO_PENDENCIAS}")[0];
        
        $alteracaoPedido->idStatus = $statusPedido->id;
        
        $infoPedido->quilometragemExcedida = $quilometragemExcedida;
        $infoPedido->combustivelRestante = $combustivelRestante;
        $infoPedido->idStatusPedido = $statusPedido->id;
        
        $resultado = $infoPedido->atualizar();
    } else {
        
        $is_pendencia_aceita = ( isset($_POST["statusPendencia"]) )? (int) $_POST["statusPendencia"] : null;        
        
        if( $is_pendencia_aceita ) {                        
            
            $statusPedido = new \Tabela\StatusPedido();
            $statusPedido = $statusPedido->buscar("cod = {$STATUS_PEDIDO_AGUARDANDO_PAGAMENTO_PENDENCIAS}")[0];
            
            $statusPendencia = new \Tabela\StatusPedido();
            $statusPendencia = $statusPendencia->buscar("cod = {$STATUS_PEDIDO_PENDENCIAS_ACEITAS}")[0];
            
            $alteracaoPedido->idStatus = $statusPedido->id;
            $alteracaoPendencia->idStatus = $statusPendencia->id;
            
            $infoPedido->idStatusPedido = $statusPedido->id;                        
        } else {
                        
            $statusPedido = new \Tabela\StatusPedido();
            $statusPedido = $statusPedido->buscar("cod = {$STATUS_PEDIDO_AGUARDANDO_DEFINICAO_PENDENCIAS}")[0];
            
            $statusPendencia = new \Tabela\StatusPedido();
            $statusPendencia = $statusPendencia->buscar("cod = {$STATUS_PEDIDO_PENDENCIAS_RECUSADAS}")[0];
            
            $alteracaoPedido->idStatus = $statusPedido->id;
            $alteracaoPendencia->idStatus = $statusPendencia->id;
            
            $infoPedido->idStatusPedido = $statusPedido->id;
        }
                
        $resultado = $infoPedido->atualizar();                
    }
    
    $alteracaoPendencia->inserir();
    $alteracaoPedido->inserir();
    echo json_encode($resultado);
?>