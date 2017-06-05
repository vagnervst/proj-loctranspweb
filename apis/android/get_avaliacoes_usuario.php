<?php
    require_once("../../include/initialize.php");
    require_once("../../include/classes/tbl_avaliacao.php");
    sleep(1);

    $idAvaliado = ( isset($_POST["idUsuario"]) )? (int) $_POST["idUsuario"] : null;    

    $buscaAvaliacoes = new \Tabela\Avaliacao();
    $listaAvaliacoes = $buscaAvaliacoes->getAvaliacao(null, null, "avaliado.id = {$idAvaliado}" );
    
    echo json_encode( $listaAvaliacoes );
?>