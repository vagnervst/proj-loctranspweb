<?php
    require_once("../include/initialize.php");
    require_once("../include/classes/tbl_estado.php");
    require_once("../include/classes/tbl_cidade.php");
    
    $idEstado = ( isset($_POST["idEstado"]) )? $_POST["idEstado"] : null;
    
    if( !empty( $idEstado ) ) {
        $lista_cidades = new \Tabela\Cidade();
        $lista_cidades = $lista_cidades->buscar(" idEstado = " .$idEstado );
        
        echo "<option selected disabled>Selecione...</option>";
        foreach( $lista_cidades as $cidade ) {
            echo '<option value="' . $cidade->id . '">' . $cidade->nome . "</option>";
        }
    }
?>