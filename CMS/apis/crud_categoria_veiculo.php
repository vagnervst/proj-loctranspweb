<?php              
    require_once("../../include/initialize.php");
    require_once("../../include/classes/tbl_categoria_veiculo.php");
    
    $modo = ( isset($_POST["modo"]) )? $_POST["modo"] : null;

    $id = ( isset($_POST["id"]) )? $_POST["id"] : null;
    $nomeCategoria = ( isset( $_POST["txtNomeCategoria"] ) )? $_POST["txtNomeCategoria"] : null;    
    $id_tipoVeiculo = ( isset( $_POST["sltipoVeiculo"] ) )? $_POST["sltipoVeiculo"] : null;

    $objCategoriaVeiculo = new \Tabela\CategoriaVeiculo();
    $objCategoriaVeiculo->nome = $nomeCategoria;
    $objCategoriaVeiculo->idTipoVeiculo = $id_tipoVeiculo;
    
    if( $modo == "insert" ) {
        $objCategoriaVeiculo->inserir();
    } elseif( $modo == "update" ) {
        $objCategoriaVeiculo->id = (int) $id;
        $objCategoriaVeiculo->atualizar();
    } elseif( $modo == "delete" ) {
        $objCategoriaVeiculo->id = (int) $id;
        $objCategoriaVeiculo->deletar();
    }

    $pagina = ( isset($_POST["numeroPagina"]) )? $_POST["numeroPagina"] : 1;
    $itens_por_pagina = 15;
    
    $lista_categorias = $objCategoriaVeiculo->getCategorias($itens_por_pagina, $pagina);    
    
    echo json_encode($lista_categorias);    
?>