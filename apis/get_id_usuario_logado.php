<?php
    require_once("../include/initialize.php");
    require_once("../include/classes/sessao.php");

    $sessao = new Sessao();

    echo json_encode( $sessao->get("idUsuario") );
?>