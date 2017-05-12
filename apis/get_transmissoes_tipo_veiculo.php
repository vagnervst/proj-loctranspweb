<?php
    require_once("../include/initialize.php");
    require_once("../include/classes/tbl_tipo_veiculo.php");
    require_once("../include/classes/tbl_transmissao.php");

    $idTipoVeiculo = ( isset($_POST["idTipoVeiculo"]) )? (int) $_POST["idTipoVeiculo"] : null;        

    if( $idTipoVeiculo != null ) {
        $listaTransmissoes = new \Tabela\TipoVeiculo();
        $listaTransmissoes->id = $idTipoVeiculo;
        $listaTransmissoes = $listaTransmissoes->getTransmissoesRelacionadas();
        
        echo "<option selected disabled>Selecione um Combustível</option>";
        foreach( $listaTransmissoes as $transmissao ) {
            echo "<option value=\"" . $transmissao->id . "\">" . $transmissao->titulo . "</option>";
        }
    }
?>