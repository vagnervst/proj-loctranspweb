<?php
    require_once("../../include/initialize.php");    
    require_once("../../include/classes/tbl_cidade.php");
            
    $idEstado = ( isset($_POST["idEstado"]) )? (int) $_POST["idEstado"] : null;

    $buscaCidades = new \Tabela\Cidade();
    $listaCidades = $buscaCidades->buscar("idEstado = {$idEstado}");
    
    echo json_encode($listaCidades);
?>