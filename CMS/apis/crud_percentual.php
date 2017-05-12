<?php              
    require_once("../../include/initialize.php");
    require_once("../../include/classes/tbl_percentual_lucro.php");
    
    $modo = ( isset($_POST["modo"]) )? $_POST["modo"] : null;

    $id = ( isset($_POST["id"]) )? $_POST["id"] : null;
    $idTipoVeiculo = ( isset( $_POST["slTipoVeiculo"] ) )? $_POST["slTipoVeiculo"] : null;
    $idCategoriaVeiculo = ( isset( $_POST["slCategoriaVeiculo"] ) )? $_POST["slCategoriaVeiculo"] : null;
    $percentualLucro = ( isset ($_POST["txtPercentualLucro"] ) )? $_POST["txtPercentualLucro"] : null;
    $valorMinimoVeiculo = ( isset( $_POST["txtValorMinimoVeiculo"] ) )? $_POST["txtValorMinimoVeiculo"] : null;    

    $objPercentualLucro = new \Tabela\PercentualLucro();
    $objPercentualLucro->percentual = $percentualLucro;
    $objPercentualLucro->valorMinimo = $valorMinimoVeiculo;
    $objPercentualLucro->idCategoria = $idCategoriaVeiculo;
    $objPercentualLucro->idTipoVeiculo = $idTipoVeiculo;
    
    if( $modo == "insert" ) {
        $objPercentualLucro->inserir();
    } elseif( $modo == "update" ) {
        $objPercentualLucro->id = (int) $id;
        $objPercentualLucro->atualizar();
    } elseif( $modo == "delete" ) {
        $objPercentualLucro->id = (int) $id;
        $objPercentualLucro->deletar();
    }

    $pagina = ( isset($_POST["numeroPagina"]) )? $_POST["numeroPagina"] : 1;
    $itens_por_pagina = 15;
    
    $lista_percentuais = $objPercentualLucro->getPercentuais($itens_por_pagina, $pagina);    
    
    echo json_encode($lista_percentuais);
?>