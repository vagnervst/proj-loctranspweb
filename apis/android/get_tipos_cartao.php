<?php
    require_once("../../include/initialize.php");
    require_once("../../include/classes/tbl_tipo_cartao_credito.php");

    $buscaCartao = new \Tabela\TipoCartaoCredito();
    $listaCartao = $buscaCartao->buscar("visivel = 1");
    
    echo json_encode($listaCartao);
?>