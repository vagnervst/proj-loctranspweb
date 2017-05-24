<?php
    require_once("../../include/initialize.php");
    require_once("../../include/classes/tbl_estado.php");    
            
    $buscaEstado = new \Tabela\Estado();
    $listaEstado = $buscaEstado->buscar();
    
    echo json_encode($listaEstado);
?>