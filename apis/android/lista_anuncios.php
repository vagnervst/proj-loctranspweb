<?php
    require_once("../../include/initialize.php");
    
    $params = ( isset($_POST["params"]) )? $_POST["params"] : null;

    $sql = "SELECT p.id, p.titulo, p.quilometragemAtual, p.valorDiaria, p.imagemPrincipal, p.idStatusPublicacao, CONCAT(eUsuario.nome, \", \", cUsuario.nome) AS localizacaoUsuario, CONCAT(eAgencia.nome, \", \", cAgencia.nome) AS localizacaoAgencia, v.nome AS modeloVeiculo, v.qtdPortas, ";
    $sql .= "st.titulo AS statusPedido ";
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
    $sql .= "LEFT JOIN tbl_cidade AS cAgencia ";
    $sql .= "ON cAgencia.id = a.idCidade ";
    $sql .= "INNER JOIN tbl_estado AS eUsuario ";
    $sql .= "ON eUsuario.id = cUsuario.idEstado ";
    $sql .= "LEFT JOIN tbl_estado AS eAgencia ";
    $sql .= "ON eAgencia.id = cAgencia.idEstado ";
    $sql .= "LEFT JOIN tbl_pedido AS pe ";
    $sql .= "ON pe.idPublicacao = p.id ";
    $sql .= "LEFT JOIN tbl_statuspedido AS st ";
    $sql .= "ON st.id = pe.idStatusPedido ";

    if( $params == null ) {
        $sql .= "WHERE p.idStatusPublicacao = 1";
    } else {
        $sql .= "WHERE " . $params;
    }

    $db_utils = new \DB\DatabaseUtils();
    $resultado = $db_utils->executarQuery($sql);
    echo json_encode($db_utils->get_array_from_resultado( $resultado ));
?>