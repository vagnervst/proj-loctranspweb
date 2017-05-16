<?php
    require_once("../../include/initialize.php");
    require_once("../../include/classes/tbl_publicacao.php");

    $idPublicacao = ( isset( $_POST["idPublicacao"] ) )? (int) $_POST["idPublicacao"] : null;
    
    if( !empty( $idPublicacao ) ) {
        $publicacao = new \Tabela\Publicacao();
        $publicacao->id = $idPublicacao;
        
        $publicacao = $publicacao->getDetalhesPublicacao(null, null, "p.id = {$idPublicacao}")[0];
        
        echo json_encode($publicacao);
    }
?>