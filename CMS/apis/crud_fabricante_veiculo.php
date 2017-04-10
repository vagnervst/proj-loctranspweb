<?php              
    require_once("../../include/initialize.php");
    require_once("../../include/classes/tbl_fabricante_veiculo.php");
    
    $modo = ( isset($_POST["modo"]) )? $_POST["modo"] : null;

    $id = ( isset($_POST["id"]) )? $_POST["id"] : null;        
    $tituloFabricante = ( isset( $_POST["txt_titulo"] ) )? $_POST["txt_titulo"] : null;
    $idsTipoVeiculo = ( isset($_POST["chkTipoVeiculo"]) )? $_POST["chkTipoVeiculo"] : null;        
    
    $objFabricanteVeiculo = new \Tabela\fabricanteVeiculo();
    $objFabricanteVeiculo->nome = $tituloFabricante;
    
    if( $modo == "insert" ) {
        $idFabricante = $objFabricanteVeiculo->inserir();
        
        $objFabricanteVeiculo->id = $idFabricante;
        for( $i = 0; $i < count($idsTipoVeiculo); ++$i ) {
            $id_tipo_veiculo = $idsTipoVeiculo[$i];
            
            $objFabricanteVeiculo->relacionar_a_tipo_veiculo( $id_tipo_veiculo );
        }
        
    } elseif( $modo == "update" ) {
        $objFabricanteVeiculo->id = (int) $id;
        $objFabricanteVeiculo->atualizar();
        
        $objFabricanteVeiculo->eliminar_relacionamentos_a_tipo_veiculo();
        
        for( $i = 0; $i < count($idsTipoVeiculo); ++$i ) {
            $id_tipo_veiculo = $idsTipoVeiculo[$i];
            
            $objFabricanteVeiculo->relacionar_a_tipo_veiculo( $id_tipo_veiculo );
        }
        
    } elseif( $modo == "delete" ) {
        $objFabricanteVeiculo->id = (int) $id;
        $objFabricanteVeiculo->eliminar_relacionamentos_a_tipo_veiculo();
        
        $objFabricanteVeiculo->deletar();
    }

    $pagina = ( isset($_POST["numeroPagina"]) )? $_POST["numeroPagina"] : 1;
    $itens_por_pagina = 17;
    
    $lista_fabricantes = $objFabricanteVeiculo->getFabricante($itens_por_pagina, $pagina);    

    echo json_encode($lista_fabricantes);
?>