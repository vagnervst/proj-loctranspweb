<?php
    require_once("../../include/initialize.php");
    require_once("../../include/classes/tbl_transmissao.php");

    $sql = "SELECT id, titulo ";
    $sql .= "FROM tbl_transmissaoveiculo";

    $buscaTransmissao = new \Tabela\TransmissaoVeiculo();
    $listaTransmissao = $buscaTransmissao->executarQuery( $sql );
    $listaTransmissao = $buscaTransmissao->get_array_from_resultado( $listaTransmissao );
    
    echo json_encode( $listaTransmissao );
    }
?>