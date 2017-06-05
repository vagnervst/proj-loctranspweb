<?php
    require_once("../../include/initialize.php");
    require_once("../../include/classes/tbl_notificacao.php");    

    $idNotificacao = ( isset($_POST["idNotificacao"]) )? (int) $_POST["idNotificacao"] : null;
    
    $resultado = false;
    if( $idNotificacao != null ) {
        $notificacao = new \Tabela\Notificacao();
        $notificacao->id = $idNotificacao;
        $notificacao->visualizada = 1;
        $resultado = $notificacao->atualizar();
    }

    echo json_encode($resultado);
?>