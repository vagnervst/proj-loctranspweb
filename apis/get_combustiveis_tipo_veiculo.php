<?php
    require_once("../include/initialize.php");
    require_once("../include/classes/tbl_tipo_veiculo.php");
    require_once("../include/classes/tbl_tipo_combustivel.php");

    $idTipoVeiculo = ( isset($_POST["idTipoVeiculo"]) )? (int) $_POST["idTipoVeiculo"] : null;        

    if( $idTipoVeiculo != null ) {
        $listaCombustiveis = new \Tabela\TipoVeiculo();
        $listaCombustiveis->id = $idTipoVeiculo;
        $listaCombustiveis = $listaCombustiveis->getCombustiveisRelacionados();
        
        echo "<option selected disabled>Selecione um Combustível</option>";
        foreach( $listaCombustiveis as $combustivel ) {
            echo "<option value=\"" . $combustivel->id . "\">" . $combustivel->nome . "</option>";
        }
    }
?>