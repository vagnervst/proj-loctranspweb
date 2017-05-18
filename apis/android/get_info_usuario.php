<?php
    require_once("../../include/initialize.php");
    require_once("../../include/classes/tbl_usuario.php");
    require_once("../../include/classes/tbl_cnh.php");

    $idUsuario = ( isset($_POST["idUsuario"]) )? (int) $_POST["idUsuario"] : null;

    if( !empty($idUsuario) ) {
        $buscaUsuario = new \Tabela\Usuario();
        $usuario = $buscaUsuario->buscar("id = {$idUsuario}")[0];                
        
        $usuario->id = (int) $usuario->id;              
        $usuario->autenticacaoDupla = (int) $usuario->autenticacaoDupla;        
        $usuario->idCidade = (int) $usuario->idCidade;
        $usuario->idTipoConta = (int) $usuario->idTipoConta;
        $usuario->idPlanoConta = (int) $usuario->idPlanoConta;
        $usuario->idLicencaDesktop = (int) $usuario->idLicencaDesktop;
        $usuario->saldo = (double) $usuario->saldo;
        
        $listaCnhs = new \Tabela\Cnh();
        $listaCnhs = $listaCnhs->buscar("idUsuario = {$idUsuario}");
        
        $usuario->listaCnh = $listaCnhs;
        
        echo json_encode($usuario);
    }
?>