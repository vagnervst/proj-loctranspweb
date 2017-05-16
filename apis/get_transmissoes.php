<?php
    require_once("../include/initialize.php");
    require_once("../include/classes/tbl_tipo_veiculo.php");
    require_once("../include/classes/tbl_transmissao.php");
    
    $idTipo = ( isset($_POST["idTipoVeiculo"]) )? $_POST["idTipoVeiculo"] : null;
    
    if( !empty( $idTipo ) ) {
        $buscaTipo = new \Tabela\TipoVeiculo();
        $buscaTipo->id = $idTipo;
        $listaTransmissoes = $buscaTipo->getTransmissoesRelacionadas();
        
        echo '<option selected disabled>Selecione o tipo de transmissão</option>';
        foreach( $listaTransmissoes as $transmissao ) {
            echo '<option value="' . $transmissao->id . '">' . $transmissao->titulo . '</option>';
        }
    }
?>