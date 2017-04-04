<?php              
    require_once("../../include/initialize.php");
    require_once("../../include/classes/tbl_tipo_veiculo.php");
    
    $modo = ( isset($_POST["modo"]) )? $_POST["modo"] : null;

    $id = ( isset($_POST["id"]) )? $_POST["id"] : null;
    $nomeTipo = ( isset($_POST["txtTipoVeiculo"]) )? $_POST["txtTipoVeiculo"] : null;
    
    $objTipoVeiculo = new \Tabela\TipoVeiculo();
    $objTipoVeiculo->titulo = $nomeTipo;        

    if( $modo == "insert" ) {
        $objTipoVeiculo->inserir();
    } elseif( $modo == "update" ) {
        $objTipoVeiculo->id = (int) $id;
        $objTipoVeiculo->atualizar();
    } elseif( $modo == "delete" ) {
        $objTipoVeiculo->id = (int) $id;
        $objTipoVeiculo->eliminar_relacionamentos_a_acessorio();
        $objTipoVeiculo->deletar();
    }

    $pagina = ( isset($_POST["numeroPagina"]) )? $_POST["numeroPagina"] : 1;
    $itens_por_pagina = 15;
    
    $lista_tipo = $objTipoVeiculo->getTipos($itens_por_pagina, $pagina);    

    echo json_encode($lista_tipo);
?>