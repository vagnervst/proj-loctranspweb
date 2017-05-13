<?php
    require_once("../include/initialize.php");
    require_once("../include/classes/tbl_categoria_veiculo.php");

    $idTipoVeiculo = ( isset($_POST["idTipoVeiculo"]) )? (int) $_POST["idTipoVeiculo"] : null;        

    if( $idTipoVeiculo != null ) {
        $listaCategorias = new \Tabela\CategoriaVeiculo();
        $listaCategorias = $listaCategorias->buscar("visivel = 1 AND idTipoVeiculo = {$idTipoVeiculo}");
        
        echo "<option selected disabled>Selecione uma Categoria</option>";
        foreach( $listaCategorias as $categoria ) {
            echo "<option value=\"" . $categoria->id . "\">" . $categoria->nome . "</option>";
        }
    }
?>