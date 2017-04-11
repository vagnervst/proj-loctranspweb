<?php
    require_once("../include/initialize.php");
    require_once("../include/classes/tbl_veiculo.php");
    require_once("../include/classes/tbl_tipo_combustivel.php");
    
    $idVeiculo = ( isset($_POST["idVeiculo"]) )? $_POST["idVeiculo"] : null;
    
    if( !empty( $idVeiculo ) ) {
        
        $codigoVeiculo = new \Tabela\Veiculo();
        $codigoVeiculo = $codigoVeiculo->buscar("id = {$idVeiculo}")[0];
        $codigoVeiculo = $codigoVeiculo->codigo;

        if( !empty( $codigoVeiculo ) ) {
            
            $lista_veiculos = new \Tabela\Veiculo();        
            $lista_veiculos = $lista_veiculos->getVeiculos(null, null, "codigo = {$codigoVeiculo}", "idTipoCombustivel");
            echo "<option selected disabled>Selecione um tipo de combustivel</option>";
            foreach( $lista_veiculos as $veiculo ) {
                $combustivel = new \Tabela\TipoCombustivel();
                $combustivel = $combustivel->buscar("id = {$veiculo->idTipoCombustivel}")[0];

                echo '<option value="' . $combustivel->id . '">' . $combustivel->nome . "</option>";
            }
        }
    }
?>