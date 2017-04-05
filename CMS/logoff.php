<?php
    require_once("../include/initialize.php");
    require_once("../include/classes/sessao.php");

    $sessao = new Sessao();

    $sessao->remove("id_usuario");
    $sessao->remove("id_permissoes");

    redirecionar_para("index.php");
?>