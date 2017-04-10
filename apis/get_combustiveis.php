<?php
    require_once("../include/initialize.php");
    require_once("../include/classes/tbl_tipo_veiculo.php");
    require_once("../include/classes/tbl_tipo_combustivel.php");
    
    $idTipoVeiculo = ( isset($_POST["idTipoVeiculo"]) )? $_POST["idTipoVeiculo"] : null;
    
    if( !empty( $idTipoVeiculo ) ) {
        $lista_combustivel = new \Tabela\TipoVeiculo();
        $lista_combustivel->id = $idTipoVeiculo;
        $lista_combustivel = $lista_combustivel->getCombustiveisRelacionados();
        
        echo "<option selected disabled>Selecione um tipo de combustivel</option>";
        foreach( $lista_combustivel as $combustivel ) {
            echo '<option value="' . $combustivel->id . '">' . $combustivel->nome . "</option>";
        }
    }
?>