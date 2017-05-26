<?php
    require_once("../../include/initialize.php");
    require_once("../../include/classes/tbl_fabricante_veiculo.php");

    $sql = "SELECT id, nome ";
    $sql .= "FROM tbl_fabricanteveiculo";

    $buscaFabricanteVeiculo = new \Tabela\FabricanteVeiculo();
    $listaFabricanteVeiculo = $buscaFabricanteVeiculo->executarQuery( $sql );
    $listaFabricanteVeiculo = $buscaFabricanteVeiculo->get_array_from_resultado( $listaFabricanteVeiculo );
    
    echo json_encode( $listaFabricanteVeiculo );
    
?>