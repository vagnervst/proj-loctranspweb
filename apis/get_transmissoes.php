<?php
    require_once("../include/initialize.php");
    require_once("../include/classes/tbl_veiculo.php");
    require_once("../include/classes/tbl_tipo_combustivel.php");
    require_once("../include/classes/tbl_transmissao.php");
    
    $idVeiculo = ( isset($_POST["idVeiculo"]) )? $_POST["idVeiculo"] : null;
    $idTipoCombustivel = ( isset($_POST["idTipoCombustivel"]) )? $_POST["idTipoCombustivel"] : null;

    if( !empty($idVeiculo) ) {
        
        $codigoVeiculo = new \Tabela\Veiculo();
        $codigoVeiculo = $codigoVeiculo->buscar("id = {$idVeiculo}")[0];
        $codigoVeiculo = $codigoVeiculo->codigo;
        
        if( !empty( $codigoVeiculo ) ) {
            
            $busca_veiculo = new \Tabela\Veiculo();
            
            $lista_veiculo = $busca_veiculo->getVeiculos(null, null, "codigo = {$codigoVeiculo} AND idTipoCombustivel = {$idTipoCombustivel}", "idTransmissao");
                        
            echo "<option selected disabled>Selecione um tipo de transmissão</option>";
            foreach( $lista_veiculo as $veiculo ) {
                $transmissao = new \Tabela\TransmissaoVeiculo();
                $transmissao = $transmissao->buscar("id = {$veiculo->idTransmissao}")[0];
                
                echo '<option value="' . $transmissao->id . '">' . $transmissao->titulo . "</option>";
            }
        }
    }
?>