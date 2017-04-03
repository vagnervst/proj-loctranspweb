<?php              
    require_once("../../include/initialize.php");
    require_once("../../include/classes/tbl_fabricante_veiculo.php");
    
    $modo = ( isset($_POST["modo"]) )? $_POST["modo"] : null;

    $id = ( isset($_POST["id"]) )? $_POST["id"] : null;        
    $tituloFabricante = ( isset( $_POST["txt_titulo"] ) )? $_POST["txt_titulo"] : null;
    

    $objFabricanteVeiculo = new \Tabela\fabricanteVeiculo();
    $objFabricanteVeiculo->nome = $tituloFabricante;
    
    if( $modo == "insert" ) {
        $objFabricanteVeiculo->inserir();
    } elseif( $modo == "update" ) {
        $objFabricanteVeiculo->id = (int) $id;
        $objFabricanteVeiculo->atualizar();
    } elseif( $modo == "delete" ) {
        $objFabricanteVeiculo->id = (int) $id;
        $objFabricanteVeiculo->deletar();
    }

    $pagina = ( isset($_POST["numeroPagina"]) )? $_POST["numeroPagina"] : 1;
    $itens_por_pagina = 15;
    
    $lista_fabricantes = $objFabricanteVeiculo->getFabricante($itens_por_pagina, $pagina);    

    echo json_encode($lista_fabricantes);
?>