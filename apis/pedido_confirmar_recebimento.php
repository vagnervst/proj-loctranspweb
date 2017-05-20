<?php
    require_once("../include/initialize.php");
    require_once("../include/classes/tbl_pedido.php");
    require_once("../include/classes/tbl_alteracao_pedido.php");    
    require_once("../include/classes/tbl_status_pedido.php");
    
    $PAGAMENTO_CONFIRMADO = 1;
    $PAGAMENTO_NEGADO = 2;

    $idPedido = ( isset($_POST["idPedido"]) )? (int) $_POST["idPedido"] : null;
    $is_confirmado = ( isset($_POST["confirmacaoPagamento"]) )? (int) $_POST["confirmacaoPagamento"] : null;
    
    echo "confirmado: " . $is_confirmado;
    if( !empty($idPedido) && !empty($is_confirmado) ) {
        
        $infoPedido = new \Tabela\Pedido();
        $infoPedido = $infoPedido->buscar("id = {$idPedido}");
        
        if( isset($infoPedido[0]) ) {
            $infoPedido = $infoPedido[0];
            $alteracaoPedido = new \Tabela\AlteracaoPedido();
            $alteracaoPedido->dataOcorrencia = get_data_atual_mysql();
            $alteracaoPedido->idPedido = $infoPedido->id;            
            
            $statusPedido = new \Tabela\StatusPedido();            
            if( $is_confirmado == $PAGAMENTO_CONFIRMADO ) {                
                
                $infoPedido->pagamentoPendenciaLocador = 1;
                
                $novoStatus = $statusPedido->buscar("cod = {$STATUS_PEDIDO_PENDENCIAS_PAGAS_DINHEIRO}")[0];                
                $alteracaoPedido->idStatus = $novoStatus->id;
                $alteracaoPedido->inserir();
                
                $novoStatus = $statusPedido->buscar("cod = {$STATUS_PEDIDO_CONCLUIDO}")[0];
                $alteracaoPedido->dataOcorrencia = get_data_atual_mysql();
                $alteracaoPedido->idStatus = $novoStatus->id;
                $alteracaoPedido->inserir();
                
                $infoPedido->idStatusPedido = $novoStatus->id;
                
            } elseif( $is_confirmado == $PAGAMENTO_NEGADO ) {
                $infoPedido->pagamentoPendenciaLocador = 0;
                $infoPedido->pagamentoPendenciaLocatario = 0;
                
                $novoStatus = $statusPedido->buscar("cod = {$STATUS_PEDIDO_AGUARDANDO_PAGAMENTO_PENDENCIAS}")[0];
                $infoPedido->idStatusPedido = $novoStatus->id;
                $alteracaoPedido->idStatus = $novoStatus->id;
                $alteracaoPedido->inserir();
            }
                                    
            $infoPedido->atualizar();
            echo json_encode($infoPedido);
        }
    }

?>