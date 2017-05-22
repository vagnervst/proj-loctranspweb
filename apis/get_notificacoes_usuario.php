<?php
    require_once("../include/initialize.php");
    require_once("../include/classes/tbl_notificacao.php");
    require_once("../include/classes/sessao.php");
    
    $sessao = new Sessao();
    $idUsuario = null;
    if( $sessao->get("idUsuario") != null ) {
        $idUsuario = $sessao->get("idUsuario");
    } else {
        $idUsuario = ( isset($_POST["idUsuario"]) )? (int) $_POST["idUsuario"] : null;
    }
    
    if( $idUsuario != null ) {
        $notificoesUsuario = new \Tabela\Notificacao();
        $notificoesUsuario = $notificoesUsuario->getNotificacao("n.idUsuarioDestinatario = {$idUsuario}");
        
        echo json_encode($notificoesUsuario);
    }
?>