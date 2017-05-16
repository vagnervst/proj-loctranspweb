<?php
    require_once("../include/initialize.php");
    require_once("../include/classes/tbl_tipo_veiculo.php");
    require_once("../include/classes/tbl_tipo_combustivel.php");
    
    $idTipo = ( isset($_POST["idTipoVeiculo"]) )? $_POST["idTipoVeiculo"] : null;
    
    if( !empty( $idTipo ) ) {
        $buscaTipo = new \Tabela\TipoVeiculo();
        $buscaTipo->id = $idTipo;
        $listaCombustiveis = $buscaTipo->getCombustiveisRelacionados();
        
        echo '<option selected disabled>Selecione o combustível</option>';
        foreach( $listaCombustiveis as $combustivel ) {
            echo '<option value="' . $combustivel->id . '">' . $combustivel->nome . '</option>';
        }
    }
?>