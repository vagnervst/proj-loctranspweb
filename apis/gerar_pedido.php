<?php
    require_once("../include/initialize.php");
    require_once("../include/classes/tbl_pedido.php");
    require_once("../include/classes/tbl_status_pedido.php");
    require_once("../include/classes/tbl_publicacao.php");
    require_once("../include/classes/tbl_alteracao_pedido.php");
    require_once("../include/classes/tbl_notificacao.php");
    require_once("../include/classes/sessao.php");

    $idPublicacao = ( isset( $_POST["idPublicacao"] ) )? (int) $_POST["idPublicacao"] : null;
    $dataRetirada = ( isset( $_POST["dataRetirada"] ) )? $_POST["dataRetirada"] : null;
    $dataDevolucao = ( isset( $_POST["dataDevolucao"] ) )? $_POST["dataDevolucao"] : null;
    $idCnh = ( isset( $_POST["idCnh"] ) )? (int) $_POST["idCnh"] : null;
    
    $ID_INDISPONIVEL = 2;

    if( !empty( $idPublicacao ) ) {
        $objPedido = new \Tabela\Pedido();                    
        
        $dataRetirada = strtotime( $dataRetirada );
        $dataDevolucao = strtotime( $dataDevolucao );
        
        $dataRetirada = strftime( "%Y-%m-%d %H:%M:%S", $dataRetirada );
        $dataDevolucao = strftime( "%Y-%m-%d %H:%M:%S", $dataDevolucao );
                
        $id_tipo_pedido_online = 1;
        $id_forma_pagamento_cartao = 1;
        
        $info_publicacao = new \Tabela\Publicacao();
        $info_publicacao = $info_publicacao->getPublicacao("p.id = {$idPublicacao}")[0];
        
        $id_veiculo = (int) $info_publicacao->idVeiculo;
        $id_usuario_locador = (int) $info_publicacao->idLocador;
        $id_funcionario = $info_publicacao->idFuncionario;
        
        $sessao = new Sessao();
        $id_usuario_locatario = (int) $sessao->get("idUsuario");
        
        $statusPedido = new \Tabela\StatusPedido();
        $statusPedido = $statusPedido->buscar("cod = {$STATUS_PEDIDO_AGENDADO}")[0];
        
        $objPedido->valorDiaria = $info_publicacao->valorDiaria;
        $objPedido->valorCombustivel = $info_publicacao->valorCombustivel;
        $objPedido->valorQuilometragem = $info_publicacao->valorQuilometragem;
        $objPedido->dataRetirada = $dataRetirada;
        $objPedido->dataEntrega = $dataDevolucao;
        $objPedido->idPublicacao = (int) $info_publicacao->id;
        $objPedido->idUsuarioLocador = $id_usuario_locador;
        $objPedido->idUsuarioLocatario = $id_usuario_locatario;
        $objPedido->idStatusPedido = $statusPedido->id;
        $objPedido->idTipoPedido = $id_tipo_pedido_online;
        $objPedido->idFormaPagamento = $id_forma_pagamento_cartao;
        $objPedido->idFuncionario = $id_funcionario;
        $objPedido->idCnh = $idCnh;
        $objPedido->idVeiculo = $id_veiculo;
        
        $idPedido = $objPedido->inserir();                
        
        $info_publicacao->idStatusPublicacao = $ID_INDISPONIVEL;
        $info_publicacao->atualizar();
        
        $historicoAlteracaoPedido = new \Tabela\AlteracaoPedido();
        $historicoAlteracaoPedido->dataOcorrencia = strftime( "%Y-%m-%d %H:%M:%S", strtotime(get_data_atual()) );
        $historicoAlteracaoPedido->idPedido = $idPedido;
        $historicoAlteracaoPedido->idStatus = $statusPedido->id;
        
        $historicoAlteracaoPedido->inserir();
        
        $notificacao = new \Tabela\Notificacao();
        $notificacao->idUsuarioRemetente = $id_usuario_locatario;
        $notificacao->idUsuarioDestinatario = $id_usuario_locador;
        $notificacao->idPedido = $idPedido;
        $notificacao->idTipoNotificacao = 1;
        $notificacao->visualizada = 0;                
        $notificacao->inserir();
        
        echo json_encode($notificacao);
    }
?>