<?php
    require_once("../../include/initialize.php");
    require_once("../../include/classes/tbl_tipo_veiculo.php");
    
    $idTipoVeiculo = ( isset( $_POST["idTipoVeiculo"]) )? (int) $_POST["idTipoVeiculo"] : null;

    $sql = "SELECT id, titulo ";
    $sql .= "FROM tbl_tipoveiculo";

    $buscaTipoVeiculo = new \Tabela\TipoVeiculo();
    $listaTipoVeiculo = $buscaTipoVeiculo->executarQuery( $sql );
    $listaTipoVeiculo = $buscaTipoVeiculo->get_array_from_resultado( $listaTipoVeiculo );
    
    echo json_encode( $listaTipoVeiculo );
    
?>