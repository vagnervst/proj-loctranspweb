<?php
    require_once("../include/initialize.php");
    require_once("../include/classes/tbl_veiculo.php");

    $id_fabricante = ( isset( $_POST["idFabricante"] ) )? $_POST["idFabricante"] : null;

    if( !empty( $id_fabricante ) ) {
        $lista_veiculos = new \Tabela\Veiculo();
        $lista_veiculos = $lista_veiculos->getVeiculos(null, null, "idFabricante = {$id_fabricante}");
        
        echo '<option selected disabled>Selecione um modelo</option>';
        foreach($lista_veiculos as $veiculo) {
            echo '<option value="' . $veiculo->id . '">' . $veiculo->nome . '</option>';
        }
    }
?>