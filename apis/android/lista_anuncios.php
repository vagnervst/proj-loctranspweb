<?php
    require_once("../../include/initialize.php");

    $sql = "SELECT p.id, p.titulo, p.quilometragemAtual, p.valorDiaria, p.imagemPrincipal, CONCAT(eUsuario.nome, \", \", cUsuario.nome) AS localizacaoUsuario, CONCAT(eAgencia.nome, \", \", cAgencia.nome) AS localizacaoAgencia, v.qtdPortas ";
    $sql .= "FROM tbl_publicacao AS p ";
    $sql .= "INNER JOIN tbl_veiculo AS v ";
    $sql .= "ON v.id = p.idVeiculo ";
    $sql .= "INNER JOIN tbl_usuario AS u ";
    $sql .= "ON u.id = p.idUsuario ";
    $sql .= "LEFT JOIN tbl_empresa AS e ";
    $sql .= "ON e.idUsuarioJuridico = u.id ";
    $sql .= "LEFT JOIN tbl_agencia AS a ";
    $sql .= "ON a.idEmpresa = e.id AND a.id = p.idAgencia ";
    $sql .= "INNER JOIN tbl_cidade AS cUsuario ";
    $sql .= "ON cUsuario.id = u.idCidade ";
    $sql .= "INNER JOIN tbl_cidade AS cAgencia ";
    $sql .= "ON cAgencia.id = a.idCidade ";
    $sql .= "INNER JOIN tbl_estado AS eUsuario ";
    $sql .= "ON eUsuario.id = cUsuario.idEstado ";
    $sql .= "INNER JOIN tbl_estado AS eAgencia ";
    $sql .= "ON eAgencia.id = cAgencia.idEstado ";

    $db_utils = new \DB\DatabaseUtils();
    $resultado = $db_utils->executarQuery($sql);
    echo json_encode($db_utils->get_array_from_resultado( $resultado ));
?>