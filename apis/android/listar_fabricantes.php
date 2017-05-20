<?php
    require_once("../../include/initialize.php");
    require_once("../../include/classes/tbl_fabricante_veiculo.php");

    $sql = "SELECT id, nome ";
    $sql .= "FROM tbl_frabricanteveiculo";

    $buscaFabrincanteVeiculo = new \Tabela\FabrincanteVeiculo();
    $listaFabrincanteVeiculo = $buscaFabricanteVeiculo->executarQuery( $sql );
    $listaFabrincanteVeiculo = $buscaFabricanteVeiculo->get_array_from_resultado( $listaFabrincanteVeiculo );
    
    echo json_encode( $listaFabrincanteVeiculo );
    }
?>