<?php
    require_once("../include/initialize.php");
    require_once("../include/classes/tbl_publicacao.php");
    sleep(1);

    $idUsuario = ( isset($_POST["idUsuario"]) )? (int) $_POST["idUsuario"] : null;
    $idPublicacao = ( isset($_POST["idPublicacao"]) )? (int) $_POST["idPublicacao"] : null;
    $paginaAtual = ( isset($_POST["paginaAtual"]) )? (int) $_POST["paginaAtual"] : 1;
    $registros_por_pagina = 10; 
    
    $buscaPublicacoes = new \Tabela\Publicacao();
    $listaPublicacoes = $buscaPublicacoes->getPublicacaoPaginacao( $registros_por_pagina, $paginaAtual, "p.idUsuario = {$idUsuario} AND p.idStatusPublicacao = 1" );    

    echo json_encode($listaPublicacoes);
?>