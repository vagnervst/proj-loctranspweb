<?php
    $modo = ( isset($_POST["modo"]) )? $_POST["modo"] : null;
    
    require_once("../../include/initialize.php");
    require_once("../../include/classes/tbl_usuario.php");
    $usuarios = new \Tabela\Usuario();
    $usuarios = $usuarios->getUsuario();
    
    if( $modo == "pesquisa" ) {
        $db = new \DB\Database();        
                
        $filtragem_nome = ( isset( $_POST["txtNome"] ) )? mysqli_real_escape_string($db->conexao, $_POST["txtNome"]) : null;
        
        $lista_parametros_pesquisa = [];
        
        if ( !empty($filtragem_nome) ) $lista_parametros_pesquisa[] = " u.nome LIKE '{$filtragem_nome}'";
        
        $query_pesquisa = implode($lista_parametros_pesquisa, ' OR ');
    }
    $pagina = ( isset($_POST["numeroPagina"]) )? $_POST["numeroPagina"] : 1;
    $itens_por_pagina = 15;

    $listaUsuarios = $usuarios->getDetalhesUsuario($itens_por_pagina, $pagina, $query_pesquisa);

    echo json_encode($listaVeiculos);
?>