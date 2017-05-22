<?php
    require_once("../../include/initialize.php");
    require_once("../../include/classes/tbl_veiculo.php");

    $sql = "SELECT v.id, v.codigo, v.nome, v.tipoMotor, v.ano, v.qtdPortas, v.idCategoriaVeiculo, v.tanque, v.visivel, ";
    $sql .= "c.nome AS categoria, v.idFabricante, f.nome AS fabricante, v.idTipoCombustivel, cb.nome AS combustivel, ";
    $sql .= "v.idTipoVeiculo, t.titulo AS tipo, v.idTransmissao, tr.titulo AS transmissao ";
    $sql .= "FROM tbl_veiculo AS v ";
    $sql .= "INNER JOIN tbl_categoriaveiculo AS c ";
    $sql .= "ON c.id = v.idCategoriaVeiculo ";
    $sql .= "INNER JOIN tbl_fabricanteveiculo AS f ";
    $sql .= "ON f.id = v.idFabricante ";
    $sql .= "LEFT JOIN tbl_tipocombustivel AS cb ";
    $sql .= "ON cb.id = v.idTipoCombustivel ";
    $sql .= "INNER JOIN tbl_tipoveiculo AS t ";
    $sql .= "ON t.id = v.idTipoVeiculo ";
    $sql .= "LEFT JOIN tbl_transmissaoveiculo AS tr ";
    $sql .= "ON tr.id = v.idTransmissao";

    $buscaVeiculo = new \Tabela\Veiculo();
    $listaVeiculo = $buscaVeiculo->executarQuery( $sql );
    $listaVeiculo = $buscaVeiculo->get_array_from_resultado( $listaVeiculo );
    
    echo json_encode( $listaVeiculo );
    
?>