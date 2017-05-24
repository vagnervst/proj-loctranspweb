<?php
    require_once("../../include/initialize.php");
    require_once("../../include/classes/tbl_banco.php");

    $buscaBanco = new \Tabela\Banco();
    $listaBanco = $buscaBanco->buscar();

    echo json_encode($listaBanco);
?>