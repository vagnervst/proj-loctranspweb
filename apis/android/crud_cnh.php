<?php
    require_once("../../include/initialize.php");
    require_once("../../include/classes/tbl_cnh.php");    

    $idCnh = ( isset($_POST["idCnh"]) )? (int) $_POST["idCnh"] : null;
    $numeroRegistro = ( isset($_POST["txtNumeroRegistro"]) )? $_POST["txtNumeroRegistro"] : null;
    $dataValidade = ( isset($_POST["dataValidade"]) )? (int) $_POST["dataValidade"] : null;
    $modo = ( isset($_POST["modo"]) )? $_POST["modo"] : null;
    $idUsuario = ( isset($_POST["idUsuario"]) )? $_POST["idUsuario"] : null;        

    $resultado = false;
    if( !empty($modo) && !empty($idUsuario) ) {
                        
        $objCnh = new \Tabela\Cnh();
        if( $modo == "insert" ) {
            
            $objCnh->numeroRegistro = $numeroRegistro;
            $objCnh->idUsuario = $idUsuario;
            $objCnh->validade = get_data_mysql( $dataValidade );
            $resultado = $objCnh->inserir();                        
            
        } elseif( $modo == "update" && !empty($idCnh) ) {
            
            $objCnh->id = $idCnh;
            $objCnh->numeroRegistro = $numeroRegistro;
            $objCnh->idUsuario = $idUsuario;
            $objCnh->validade = get_data_mysql( $dataValidade );
            $resultado = $objCnh->atualizar();                        
            
        } elseif( $modo == "delete" && !empty($idCnh) ) {
            
            $objCnh->id = $idCnh;
            $objCnh->numeroRegistro = $numeroRegistro;
            $objCnh->idUsuario = $idUsuario;
            $objCnh->visivel = 0;
            $resultado = $objCnh->atualizar();
            
        }
        
    }

    echo json_encode($resultado);
?>