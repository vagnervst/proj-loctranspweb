<?php                      
    require_once("../../include/initialize.php");
    require_once("../../include/classes/tbl_veiculo.php");
    require_once("../../include/classes/tbl_tipo_veiculo.php");	    
    
    $modo = ( isset($_POST["modo"]) )? $_POST["modo"] : null;

    $idVeiculo = ( isset($_POST["id"]) )? (int) $_POST["id"] : null;
    $codigoVeiculo = ( isset($_POST["txtCod"]) )? (double) $_POST["txtCod"] : null;
    $nome = ( isset($_POST["txtNome"]) )? $_POST["txtNome"] : null;
    $precoMedio = ( isset($_POST["txtPrecoMedio"]) )? $_POST["txtPrecoMedio"] : null;
    $ano = ( isset($_POST["txtAno"]) )? (int) $_POST["txtAno"] : null;
    $motor = ( isset($_POST["txtMotor"]) )? $_POST["txtMotor"] : null;
    $portas = ( isset($_POST["txtPortas"]) )? (int) $_POST["txtPortas"] : null;		
    $tanque = ( isset($_POST["txtTanque"]) )? $_POST["txtTanque"] : null;
    $idCategoria = ( isset($_POST["slCategoria"]) )? (int) $_POST["slCategoria"] : null;
    $idTipo = ( isset($_POST["slTipo"]) )? (int) $_POST["slTipo"] : null;
    $idCombustivel = ( isset($_POST["slCombustivel"]) )? (int) $_POST["slCombustivel"] : null;
    $idFabricante = ( isset($_POST["slFabricante"]) )? (int) $_POST["slFabricante"] : null;
    $idTransmissao = ( isset($_POST["slTransmissao"]) )? (int) $_POST["slTransmissao"] : null;        

    $objVeiculo = new \Tabela\Veiculo();

    $objVeiculo->codigo = $codigoVeiculo;
    $objVeiculo->nome = $nome;
    $objVeiculo->precoMedio = $precoMedio;
    $objVeiculo->ano = $ano;
    $objVeiculo->tanque = $tanque;
    $objVeiculo->tipoMotor = $motor;
    $objVeiculo->qtdPortas = $portas;
    $objVeiculo->idCategoriaVeiculo = $idCategoria;
    $objVeiculo->idTipoVeiculo = $idTipo;
    $objVeiculo->idTipoCombustivel = $idCombustivel;
    $objVeiculo->idFabricante = $idFabricante;
    $objVeiculo->idTransmissao = $idTransmissao;

    if( $modo == "insert" ) {
        $objVeiculo->visivel = true;
        $objVeiculo->inserir();
    } elseif( $modo == "update" ) {
        $objVeiculo->id = (int) $idVeiculo;
        $objVeiculo->atualizar();
    } elseif( $modo == "delete" ) {
        $objVeiculo->id = (int) $idVeiculo;
        $objVeiculo->visivel = false;
        $objVeiculo->atualizar();
    }

    $listaVeiculos = null;
    $query_pesquisa = "v.visivel = 1";

    if( $modo == "pesquisa" ) {
        
        $db = new \DB\Database();        
                
        $filtragem_nome = ( isset( $_POST["txtNome"] ) )? mysqli_real_escape_string($db->conexao, $_POST["txtNome"]) : null;        
        $filtragem_cod = ( isset( $_POST["txtCod"] ) )? $_POST["txtCod"] : null;
        $filtragem_precoMinimo = ( isset( $_POST["txtPrecoMinimo"] ) )? mysqli_real_escape_string($db->conexao, $_POST["txtPrecoMinimo"]) : null;
        $filtragem_idTipo = ( isset( $_POST["slTipo"] ) )? $_POST["slTipo"] : null;
        $filtragem_idFabricante = ( isset( $_POST["slFabricante"] ) )? $_POST["slFabricante"] : null;        
        $filtragem_idCategoria = ( isset( $_POST["slCategoria"] ) )? $_POST["slCategoria"] : null;
        $filtragem_idCombustivel = ( isset( $_POST["slCombustivel"] ) )? $_POST["slCombustivel"] : null;                
        
        $lista_parametros_pesquisa = [];
                
        if( !empty($filtragem_nome) ) $lista_parametros_pesquisa[] = "v.nome LIKE '{$filtragem_nome}'";
        if( !empty($filtragem_cod) ) $lista_parametros_pesquisa[] = "v.codigo = {$filtragem_cod}";
        if( !empty($filtragem_precoMinimo) ) $lista_parametros_pesquisa[] = "v.precoMedio >= '{$filtragem_precoMinimo}'";
        if( !empty($filtragem_idTipo) ) $lista_parametros_pesquisa[] = "v.idTipoVeiculo = {$filtragem_idTipo}";
        if( !empty($filtragem_idFabricante) ) $lista_parametros_pesquisa[] = "v.idFabricante = {$filtragem_idFabricante}";
        if( !empty($filtragem_idCategoria) ) $lista_parametros_pesquisa[] = "v.idCategoriaVeiculo = {$filtragem_idCategoria}";
        if( !empty($filtragem_idCombustivel) ) $lista_parametros_pesquisa[] = "v.idTipoCombustivel = {$filtragem_idCombustivel}";
        
        if( !empty($lista_parametros_pesquisa) ) {
            $query_pesquisa .= " AND " . implode($lista_parametros_pesquisa, ' OR ');
        }
    }    
    
    //echo $query_pesquisa;

    $pagina = ( isset($_POST["numeroPagina"]) )? $_POST["numeroPagina"] : 1;
    $itens_por_pagina = 15;

    $listaVeiculos = $objVeiculo->getVeiculos($itens_por_pagina, $pagina, $query_pesquisa);
    
    echo json_encode($listaVeiculos);
?>
