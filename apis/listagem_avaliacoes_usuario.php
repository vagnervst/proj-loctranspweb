<?php
    require_once("../include/initialize.php");
    require_once("../include/classes/tbl_avaliacao.php");
    sleep(1);

    $idAvaliado = ( isset($_POST["idUsuario"]) )? (int) $_POST["idUsuario"] : null;
    $paginaAtual = ( isset($_POST["paginaAtual"]) )? (int) $_POST["paginaAtual"] : 1;
    $registros_por_pagina = 10;

    $buscaAvaliacoes = new \Tabela\Avaliacao();
    $listaAvaliacoes = $buscaAvaliacoes->getAvaliacao($registros_por_pagina, $paginaAtual, "avaliado.id = {$idAvaliado}" );
    
    echo json_encode( $listaAvaliacoes );
?>