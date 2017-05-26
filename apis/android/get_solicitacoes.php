<?php 
    require_once("../../include/initialize.php");
    require_once("../../include/classes/tbl_pedido.php");
    require_once("../../include/classes/tbl_alteracao_pedido.php");
    require_once("../../include/classes/tbl_status_pedido.php");    
    
    $statusPedido = new \Tabela\StatusPedido();

    $statusPedido = $statusPedido->buscar("cod = {$STATUS_PEDIDO_REJEITADO}")[0];
    $ID_STATUS_PEDIDO_RECUSADO = $statusPedido->id;

    $statusPedido = $statusPedido->buscar("cod = {$STATUS_PEDIDO_AGUARDANDO_CONFIRMACAO_LOCAL_RETIRADA}")[0];
    $ID_STATUS_PEDIDO_ACEITO = $statusPedido->id;

    $modo = ( isset($_POST["modo"]) )? $_POST["modo"] : null;
    
    $idUsuario = ( isset($_POST["idUsuario"]) )? (int) $_POST["idUsuario"] : null;
    $idSolicitacao = ( isset($_POST["idSolicitacao"]) )? (int) $_POST["idSolicitacao"] : null;            
    $where = ( isset($_POST["where"]) )? $_POST["where"] : null;

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
        
        $alteracaoPedido = new \Tabela\AlteracaoPedido();
        $alteracaoPedido->dataOcorrencia = get_data_atual_mysql();
        $alteracaoPedido->idPedido = $idSolicitacao;
        $alteracaoPedido->idStatus = $ID_STATUS_PEDIDO_ACEITO;
        $alteracaoPedido->inserir();
    }
    
    $sqlWhere = "p.idStatusPedido != {$ID_STATUS_PEDIDO_RECUSADO} AND locador.id = {$idUsuario}";
    if( !empty($where) ) {
        $sqlWhere .= " AND " . $where;
    }

    $buscaSolicitacoes = new \Tabela\Pedido();
    $listaSolicitacoes = $buscaSolicitacoes->listarPedidos( null, null, $sqlWhere );

    echo json_encode($listaSolicitacoes);
?>