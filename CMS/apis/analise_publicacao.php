<?php
    sleep(1);
    require_once("../../include/initialize.php");
    require_once("../../include/classes/tbl_publicacao.php");
    
    $ID_STATUS_PUBLICACAO_ACEITA = 1;
    $ID_STATUS_PUBLICACAO_RECUSADA = 2;
    
    $idPublicacao = ( isset($_POST["idPublicacao"]) )? (int) $_POST["idPublicacao"] : null;
    $modo = ( isset($_POST["modo"]) )? $_POST["modo"] : null;

    if( !empty($idPublicacao) && !empty($modo) && $modo == "recusar" ) {
        
        $publicacao = new \Tabela\Publicacao();
        $publicacao->id = $idPublicacao;
        $publicacao->idStatusPublicacao = $ID_STATUS_PUBLICACAO_RECUSADA;
        $publicacao->atualizar();
        
    } elseif( !empty($idPublicacao) && !empty($modo) && $modo == "aceitar" ) {
        
        $publicacao = new \Tabela\Publicacao();
        $publicacao->id = $idPublicacao;
        $publicacao->idStatusPublicacao = $ID_STATUS_PUBLICACAO_ACEITA;
        $publicacao->atualizar();
        
    }

    redirecionar_para("../publicacoes.php");
?>