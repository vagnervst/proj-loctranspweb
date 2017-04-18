<?php
    require_once("../../include/initialize.php");
    require_once("../../include/classes/tbl_tipo_cartao_credito.php");
    
    $modo = ( isset($_POST["modo"]) )? $_POST["modo"] : null;

    $id = ( isset($_POST['id']) )? $_POST["id" ] : null ;
    $titulo = ( isset($_POST["txtTipoCartao"]) )? $_POST["txtTipoCartao"] : null;
    $qtdDigitosSeguranca = ( isset($_POST["txtDigitos"]) )? $_POST["txtDigitos"] : null;

    $objTipoCartao = new \Tabela\TipoCartaoCredito();
    $objTipoCartao->titulo = $titulo;
    $objTipoCartao->qtdDigitosSeguranca = $qtdDigitosSeguranca;
    $objTipoCartao->visivel = 1;

    if( $modo == "insert" ) {
        $objTipoCartao->inserir();
    } elseif( $modo == "update" ) {
        $objTipoCartao->id = (int) $id;
        $objTipoCartao->atualizar();
    } elseif( $modo == "delete" ) {
        $objTipoCartao->id = (int) $id;
        $objTipoCartao->hideTipoCartao();
    }

    $pagina = ( isset($_POST["numeroPagina"]) )? $_POST["numeroPagina"] : 1;
    $itens_por_pagina = 10;

    $lista_tipo_cartao = $objTipoCartao->getTipoCartao($itens_por_pagina, $pagina, "visivel = 1");

    echo json_encode($lista_tipo_cartao);
?>