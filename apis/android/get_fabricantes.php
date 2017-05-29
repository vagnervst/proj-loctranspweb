<?php
    require_once("../../include/initialize.php");
    require_once("../../include/classes/tbl_tipo_veiculo.php");
    require_once("../../include/classes/tbl_fabricante_veiculo.php");

    $id_tipo_veiculo = ( isset( $_POST["idTipoVeiculo"] ) )? $_POST["idTipoVeiculo"] : null;

    if( !empty( $id_tipo_veiculo ) ) {
        $lista_fabricantes = new \Tabela\TipoVeiculo();
        $lista_fabricantes->id = $id_tipo_veiculo;
        $lista_fabricantes = $lista_fabricantes->getFabricantesRelacionados();
        
        echo json_encode($lista_fabricantes);
    }
?>