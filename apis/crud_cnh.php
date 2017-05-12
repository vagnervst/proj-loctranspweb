<?php
    require_once("../include/initialize.php");
    require_once("../include/classes/tbl_cnh.php");
    require_once("../include/classes/sessao.php");

    $idCnh = ( isset($_GET["idCnh"]) )? (int) $_GET["idCnh"] : null;
    $numeroRegistro = ( isset($_POST["txtNumeroRegistro"]) )? $_POST["txtNumeroRegistro"] : null;
    $modo = ( isset($_GET["modo"]) )? $_GET["modo"] : null;    

    $sessao = new Sessao();
    $idUsuario = $sessao->get("idUsuario");    

    if( !empty($modo) && !empty($idUsuario) ) {
        
        $objCnh = new \Tabela\Cnh();
        if( $modo == "insert" ) {                        
            
            $objCnh->numeroRegistro = $numeroRegistro;
            $objCnh->idUsuario = $idUsuario;
            $objCnh->inserir();
            
        } elseif( $modo == "update" && !empty($idCnh) ) {
            
            $objCnh->id = $idCnh;
            $objCnh->numeroRegistro = $numeroRegistro;
            $objCnh->idUsuario = $idUsuario;
            $objCnh->atualizar();
            
            echo "atualizou";
            
        } elseif( $modo == "delete" && !empty($idCnh) ) {
            
            $objCnh->id = $idCnh;
            $objCnh->numeroRegistro = $numeroRegistro;
            $objCnh->idUsuario = $idUsuario;
            $objCnh->deletar();
            
        }
        
    }

    redirecionar_para("../configuracoes.php");
?>