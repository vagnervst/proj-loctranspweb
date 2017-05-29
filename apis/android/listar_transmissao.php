<?php
    require_once("../../include/initialize.php");
    require_once("../../include/classes/tbl_transmissao.php");
    require_once("../../include/classes/tbl_tipo_veiculo.php");

    $idTipoVeiculo = ( isset($_POST["idTipoVeiculo"]) )? (int) $_POST["idTipoVeiculo"] : null;
    
    $buscaTransmissao = new \Tabela\TransmissaoVeiculo();
    $listaTransmissao = "";
    if( $idTipoVeiculo != null ) {
        $tipoVeiculo = new \Tabela\TipoVeiculo();
        $tipoVeiculo->id = $idTipoVeiculo;        
        $listaTransmissao = $tipoVeiculo->getTransmissoesRelacionadas();        
    } else {
        $listaTransmissao = $buscaTransmissao->buscar();
    }            
    
    echo json_encode( $listaTransmissao );
?>