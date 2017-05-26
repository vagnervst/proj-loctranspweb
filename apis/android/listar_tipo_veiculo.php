<?php
    require_once("../../include/initialize.php");
    require_once("../../include/classes/tbl_tipo_veiculo.php");        
    
    $buscaTipoVeiculo = new \Tabela\TipoVeiculo();
    $listaTipoVeiculo = $buscaTipoVeiculo->buscar("visivel = 1");    
    
    echo json_encode( $listaTipoVeiculo );
    
?>