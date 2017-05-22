<?php
    require_once("../include/initialize.php");
    require_once("../include/classes/tbl_notificacao.php");

    $idNotificacoes = ( isset($_POST["listaIdNotificacoes"]) )? $_POST["listaIdNotificacoes"] : null;
    
    if( $idNotificacoes != null  ) {
    
        $idNotificacoes = explode(",", $idNotificacoes);        
        
        if( count($idNotificacoes) > 0 ) {                

            foreach( $idNotificacoes as $idNotificacao ) {
                $objNotificacao = new \Tabela\Notificacao();
                $objNotificacao->id = (int) $idNotificacao;            
                $objNotificacao->visualizada = 1;

                $objNotificacao->atualizar();
            }
        }
        
    }
?>