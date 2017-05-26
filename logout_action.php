<?php    
    require_once("include/functions.php");
    require_once("include/classes/sessao.php");
    
    $sessao = new Sessao();
    if( $sessao->get("idUsuario") != null ) {
        $sessao->remove( "idUsuario" );        
    }

    redirecionar_para("index.php")
?>