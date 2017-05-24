<?php
    require_once("../include/initialize.php");
    require_once("../include/classes/sessao.php");
    require_once("../include/classes/tbl_publicacao.php");
    require_once("../include/classes/tbl_usuario.php");
    require_once("../include/classes/tbl_notificacao.php");

    $txtTitulo = ( isset( $_POST["txtTitulo"] ) )? $_POST["txtTitulo"] : null;
    $txtDescricao = ( isset( $_POST["txtDescricao"] ) )? $_POST["txtDescricao"] : null;
    $id_tipo = ( isset( $_POST["slTipo"] ) )? $_POST["slTipo"] : null;
    $id_fabricante = ( isset( $_POST["slFabricante"] ) )? $_POST["slFabricante"] : null;
    $id_combustivel = ( isset( $_POST["slCombustivel"] ) )? $_POST["slCombustivel"] : null;
    $id_transmissao = ( isset( $_POST["slTransmissao"] ) )? $_POST["slTransmissao"] : null;
    $id_modelo = ( isset( $_POST["slModelo"] ) )? $_POST["slModelo"] : null;
    $quilometragemAtual = ( isset( $_POST["txtQuilometragem"] ) )? $_POST["txtQuilometragem"] : null;
    $valorVeiculo = ( isset( $_POST["txtValorVeiculo"] ) )? $_POST["txtValorVeiculo"] : null;
    $limiteQuilometragem = ( isset( $_POST["txtLimiteQuilometragem"] ) )? $_POST["txtLimiteQuilometragem"] : null;
    $valorDiaria = ( isset( $_POST["txtValorDiaria"] ) )? $_POST["txtValorDiaria"] : null;
    $valorQuilometragem = ( isset( $_POST["txtValorQuilometragem"] ) )? $_POST["txtValorQuilometragem"] : null;
    $valorCombustivel = ( isset( $_POST["txtValorCombustivel"] ) )? $_POST["txtValorCombustivel"] : null;
    $status_publicacao_pendente = 3;

    $sessao = new Sessao();
    $idUsuario = -1;
    if( $sessao->get("idUsuario") != null ) {
        $idUsuario = (int) $sessao->get("idUsuario");
    } else {
        $idUsuario = ( isset($_POST["idUsuario"]) )? (int) $_POST["idUsuario"] : -1;
    }
    
    if( $idUsuario != 1 ) {
        
        $publicacao = new \Tabela\Publicacao();
        
        $publicacao->titulo = $txtTitulo;
        $publicacao->descricao = $txtDescricao;
        $publicacao->quilometragemAtual = (int) $quilometragemAtual;
        $publicacao->valorDiaria = (double) $valorDiaria;
        $publicacao->valorCombustivel = (double) $valorCombustivel;
        $publicacao->valorQuilometragem = (double) $valorQuilometragem;
        $publicacao->valorVeiculo = (double) $valorVeiculo;
        $publicacao->limiteQuilometragem = (int) $limiteQuilometragem;         
        $publicacao->dataPublicacao = get_data_atual_mysql();
        $publicacao->idVeiculo = (int) $id_modelo;
        $publicacao->disponivelOnline = 1;
        $publicacao->idStatusPublicacao = $status_publicacao_pendente;
        
        $publicacao->inserir();
        
    }
?>