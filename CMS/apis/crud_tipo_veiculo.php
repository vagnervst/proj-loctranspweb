<?php              
    require_once("../../include/initialize.php");
    require_once("../../include/classes/tbl_tipo_veiculo.php");
    require_once("../../include/classes/tbl_tipo_combustivel.php");
    require_once("../../include/classes/tbl_transmissao.php");
    
    $modo = ( isset($_POST["modo"]) )? $_POST["modo"] : null;

    $id = ( isset($_POST["id"]) )? $_POST["id"] : null;
    $nomeTipo = ( isset($_POST["txtTipoVeiculo"]) )? $_POST["txtTipoVeiculo"] : null;
    $idsTipoCombustivel = ( isset($_POST["chkTipoCombustivel"]) )? $_POST["chkTipoCombustivel"] : null;
    $idsTransmissao = ( isset($_POST["chkTransmissao"]) )? $_POST["chkTransmissao"] : null;

    $objTipoVeiculo = new \Tabela\TipoVeiculo();
    $objTipoVeiculo->titulo = $nomeTipo;        

    if( $modo == "insert" ) {
        $id_tipo_veiculo = $objTipoVeiculo->inserir();
        $objTipoVeiculo->id = $id_tipo_veiculo;
                        
        for( $i = 0; $i < count($idsTipoCombustivel); ++$i ) {
            $id_tipo_combustivel = $idsTipoCombustivel[ $i ];
            $objTipoVeiculo->relacionar_a_combustivel( $id_tipo_combustivel );
        }
        
        for( $x = 0; $x < count($idsTransmissao); ++$x ) {
            $id_transmissao = $idsTransmissao[ $x ];
            $objTipoVeiculo->relacionar_a_transmissao( $id_transmissao );
        }
        
    } elseif( $modo == "update" ) {
        $objTipoVeiculo->id = (int) $id;
        $objTipoVeiculo->atualizar();
        
        $objTipoVeiculo->eliminar_relacionamentos_a_combustivel();       
        $objTipoVeiculo->eliminar_relacionamentos_a_transmissao();
                
        for( $i = 0; $i < count($idsTipoCombustivel); ++$i ) {
            $id_tipo_combustivel = $idsTipoCombustivel[ $i ];
            $objTipoVeiculo->relacionar_a_combustivel( $id_tipo_combustivel );
        }
        
        for( $x = 0; $x < count($idsTransmissao); ++$x ) {
            $id_transmissao = $idsTransmissao[ $x ];
            $objTipoVeiculo->relacionar_a_transmissao( $id_transmissao );
        }
        
    } elseif( $modo == "delete" ) {
        $objTipoVeiculo->id = (int) $id;
        $objTipoVeiculo->eliminar_relacionamentos_a_acessorio();
        $objTipoVeiculo->eliminar_relacionamentos_a_combustivel();       
        $objTipoVeiculo->eliminar_relacionamentos_a_transmissao();
        $objTipoVeiculo->deletar();
    }

    $pagina = ( isset($_POST["numeroPagina"]) )? $_POST["numeroPagina"] : 1;
    $itens_por_pagina = 15;
    
    $lista_tipo = $objTipoVeiculo->getTipos($itens_por_pagina, $pagina);    

    echo json_encode($lista_tipo);
?>