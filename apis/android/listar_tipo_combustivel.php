<?php
    require_once("../../include/initialize.php");
    require_once("../../include/classes/tbl_tipo_combustivel.php");

    $sql = "SELECT id, nome ";
    $sql .= "FROM tbl_tipocombustivel";

    $buscaTipoCombustivel = new \Tabela\TipoCombustivel();
    $listaTipoCombustivel = $buscaTipoCombustivel->executarQuery( $sql );
    $listaTipoCombustivel = $buscaTipoCombustivel->get_array_from_resultado( $listaTipoCombustivel );
    
    echo json_encode( $listaTipoCombustivel );
    }
?>