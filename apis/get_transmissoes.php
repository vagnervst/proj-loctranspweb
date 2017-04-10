<?php
    require_once("../include/initialize.php");
    require_once("../include/classes/tbl_tipo_veiculo.php");
    require_once("../include/classes/tbl_transmissao.php");
    
    $idTipoVeiculo = ( isset($_POST["idTipoVeiculo"]) )? $_POST["idTipoVeiculo"] : null;
    
    if( !empty( $idTipoVeiculo ) ) {
        $lista_transmissao = new \Tabela\TipoVeiculo();
        $lista_transmissao->id = $idTipoVeiculo;
        $lista_transmissao = $lista_transmissao->getTransmissoesRelacionadas();            
        
        echo "<option selected disabled>Selecione um tipo de transmissão</option>";
        foreach( $lista_transmissao as $transmissao ) {
            echo '<option value="' . $transmissao->id . '">' . $transmissao->titulo . "</option>";
        }
    }
?>