<?php
    require_once("../include/initialize.php");
    require_once("../include/classes/tbl_pedido.php");
    require_once("../include/classes/tbl_publicacao.php");
    require_once("../include/classes/sessao.php");

    $idPublicacao = ( isset( $_POST["idPublicacao"] ) )? (int) $_POST["idPublicacao"] : null;
    $dataRetirada = ( isset( $_POST["dataRetirada"] ) )? $_POST["dataRetirada"] : null;
    $dataDevolucao = ( isset( $_POST["dataDevolucao"] ) )? $_POST["dataDevolucao"] : null;
    $idCnh = ( isset( $_POST["idCnh"] ) )? (int) $_POST["idCnh"] : null;
    
    if( !empty( $idPublicacao ) ) {
        $objPedido = new \Tabela\Pedido();                                
        
        echo "CNH: " . $idCnh;
        
        $dataRetirada = strtotime( $dataRetirada );
        $dataDevolucao = strtotime( $dataDevolucao );
        
        $dataRetirada = strftime( "%Y-%m-%d %H:%M:%S", $dataRetirada );
        $dataDevolucao = strftime( "%Y-%m-%d %H:%M:%S", $dataDevolucao );
        
        $id_status_aguardando_aprovacao = 1;
        $id_tipo_pedido_online = 1;
        $id_forma_pagamento_cartao = 1;
        
        $info_publicacao = new \Tabela\Publicacao();
        $info_publicacao = $info_publicacao->getPublicacao("p.id = {$idPublicacao}")[0];
        
        $id_veiculo = (int) $info_publicacao->idVeiculo;
        $id_usuario_locador = (int) $info_publicacao->idLocador;
        $id_funcionario = $info_publicacao->idFuncionario;
        
        $sessao = new Sessao();
        $id_usuario_locatario = (int) $sessao->get("idUsuario");
        
        $objPedido->dataRetirada = $dataRetirada;
        $objPedido->dataEntrega = $dataDevolucao;
        $objPedido->idPublicacao = (int) $info_publicacao->idPublicacao;
        $objPedido->idUsuarioLocador = $id_usuario_locador;
        $objPedido->idUsuarioLocatario = $id_usuario_locatario;
        $objPedido->idStatusPedido = $id_status_aguardando_aprovacao;
        $objPedido->idTipoPedido = $id_tipo_pedido_online;
        $objPedido->idFormaPagamento = $id_forma_pagamento_cartao;
        $objPedido->idFuncionario = $id_funcionario;
        $objPedido->idCnh = $idCnh;
        $objPedido->idVeiculo = $id_veiculo;
        
        $objPedido->inserir();
    }
?>