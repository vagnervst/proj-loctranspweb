<?php              
    require_once("../../include/initialize.php");
    require_once("../../include/classes/tbl_acessorio_veiculo.php");
    require_once("../../include/classes/tbl_tipo_veiculo.php");
    
    $modo = ( isset($_POST["modo"]) )? $_POST["modo"] : null;

    $id = ( isset($_POST["id"]) )? $_POST["id"] : null;
    $titulo = ( isset($_POST["txtTitulo"]) )? $_POST["txtTitulo"] : null;
    $idsTipoVeiculo = ( isset($_POST["chkTipoVeiculo"]) )? $_POST["chkTipoVeiculo"] : null;
    
    $objAcessorioVeiculo = new \Tabela\AcessorioVeiculo();
    $objAcessorioVeiculo->nome = $titulo;
        
    if( $modo == "insert" ) {
        $objAcessorioVeiculo->visivel = true;
        $id_acessorio = $objAcessorioVeiculo->inserir();
        $objAcessorioVeiculo->id = $id_acessorio;
        
        for( $i = 0; $i < count($idsTipoVeiculo); ++$i ) {
            $id_tipo_veiculo = $idsTipoVeiculo[$i];
            
            $objAcessorioVeiculo->relacionar_a_tipo_veiculo( $id_tipo_veiculo );
        }
        
    } elseif( $modo == "update" ) {
        $objAcessorioVeiculo->id = (int) $id;
        
        $objAcessorioVeiculo->eliminar_relacionamentos_a_veiculo();
        for( $i = 0; $i < count($idsTipoVeiculo); ++$i ) {
            $id_tipo_veiculo = $idsTipoVeiculo[$i];
            
            $objAcessorioVeiculo->relacionar_a_tipo_veiculo( $id_tipo_veiculo );
        }
        
        $objAcessorioVeiculo->atualizar();
    } elseif( $modo == "delete" ) {
        $objAcessorioVeiculo->id = (int) $id;
        $objAcessorioVeiculo->visivel = false;        
        $objAcessorioVeiculo->atualizar();
    }

    $pagina_atual = ( isset($_POST["numeroPagina"]) )? $_POST["numeroPagina"] : 1;
    $itens_por_pagina = 15;
        
    $lista_acessorio = $objAcessorioVeiculo->getAcessorios($itens_por_pagina, $pagina_atual, "visivel = 1");    

    echo json_encode($lista_acessorio);
?>