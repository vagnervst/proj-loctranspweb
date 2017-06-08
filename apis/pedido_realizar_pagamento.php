<?php
    sleep(1);
    require_once("../include/initialize.php");
    require_once("../include/classes/tbl_pedido.php");
    require_once("../include/classes/tbl_publicacao.php");
    require_once("../include/classes/tbl_status_pedido.php");
    require_once("../include/classes/tbl_alteracao_pedido.php");
    require_once("../include/classes/sessao.php");

    $idPedido = ( isset($_POST["idPedido"]) )? (int) $_POST["idPedido"] : null;
    $formaPagamento = ( isset($_POST["formaPagamento"]) )? (int) $_POST["formaPagamento"] : null;
    $codigoSegurancaCartao = ( isset($_POST["codigoSegurancaCartao"]) )? (int) $_POST["codigoSegurancaCartao"] : null;

    $sessao = new Sessao();

    $idUsuario = -1;    
    if( $sessao->get("idUsuario") != null ) {
        $idUsuario = (int) $sessao->get("idUsuario");   
    } else {
        $idUsuario = ( isset($_POST["idUsuario"]) )? (int) $_POST["idUsuario"] : -1;
    }

    $infoPedido = new \Tabela\Pedido();
    $infoPedido = $infoPedido->buscar("id = {$idPedido}")[0];
    $infoPedido->id = $idPedido;

    $is_locador = null;
    if( $infoPedido->idUsuarioLocador == $idUsuario ) {
        $is_locador = true;
    } elseif( $infoPedido->idUsuarioLocatario == $idUsuario ) {
        $is_locador = false;
    }

    $CARTAO_CREDITO = 1;
    $DINHEIRO = 2;
        
    $alteracaoPedido = new \Tabela\AlteracaoPedido();
    $alteracaoPedido->dataOcorrencia = get_data_atual_mysql();
    $alteracaoPedido->idPedido = $idPedido;
    
    $resultado = false;
    if( $formaPagamento == $CARTAO_CREDITO && !$is_locador && !empty($codigoSegurancaCartao) ) {        
                
        $statusPedido = new \Tabela\StatusPedido();
        $statusPedido = $statusPedido->buscar("cod = {$STATUS_PEDIDO_PENDENCIAS_PAGAS_CARTAO_CREDITO}")[0];
        
        $infoPedido->pagamentoPendenciaLocador = 1;
        $infoPedido->pagamentoPendenciaLocatario = 1;
        $infoPedido->idFormaPagamentoPendencias = $CARTAO_CREDITO;
        
        $alteracaoPedido->idStatus = $statusPedido->id;  
        $alteracaoPedido->inserir();
        
        $infoPedido->idStatusPedido = $statusPedido->id;
                       
    } elseif( $formaPagamento == $DINHEIRO && !$is_locador ) {
        
        $statusPedido = new \Tabela\StatusPedido();
        $statusPedido = $statusPedido->buscar("cod = {$STATUS_PEDIDO_AGUARDANDO_CONFIRMACAO_PAGAMENTO_PENDENCIAS}")[0];                
        
        $infoPedido->pagamentoPendenciaLocatario = 1;
        $infoPedido->idFormaPagamentoPendencias = $DINHEIRO;
        
        $infoPedido->idStatusPedido = $statusPedido->id;
        $alteracaoPedido->idStatus = $statusPedido->id;
        $alteracaoPedido->inserir();
    } elseif( $is_locador ) {
        
        $infoPedido->pagamentoPendenciaLocador = 1;
    }
    
    if( $infoPedido->pagamentoPendenciaLocador == 1 && $infoPedido->pagamentoPendenciaLocatario == 1 ) {
        
        $statusPedido = new \Tabela\StatusPedido();
        $statusPedido = $statusPedido->buscar("cod = {$STATUS_PEDIDO_CONCLUIDO}")[0];                
        
        $infoPedido->idStatusPedido = $statusPedido->id;
        
        $alteracaoPedido->idStatus = $statusPedido->id;
        $alteracaoPedido->inserir();
        
        $publicacaoAlvo = new \Tabela\Publicacao();
        $publicacaoAlvo->id = $infoPedido->idPublicacao;
        
        $ID_PUBLICACAO_DISPONIVEL = 1;
        $publicacaoAlvo->idStatusPublicacao = $ID_PUBLICACAO_DISPONIVEL;
        $publicacaoAlvo->atualizar();
    }        

    $resultado = $infoPedido->atualizar();
    
    echo json_encode($resultado);
?>