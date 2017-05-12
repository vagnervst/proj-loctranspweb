<?php
    require_once("../../include/initialize.php");
    require_once("../../include/classes/tbl_usuario.php");

    $email = ( isset($_POST["email"]) )? $_POST["email"] : null;
    $senha = ( isset($_POST["senha"]) )? $_POST["senha"] : null;        

    $resultado = new \Tabela\Usuario();
    if( $email != null && $senha != null ) {
        $buscaUsuario = new \Tabela\Usuario();

        $email = $buscaUsuario->get_valor_escapado( $email );
        $usuario_encontrado = $buscaUsuario->buscar("email = '{$email}'");
        
        if( count($usuario_encontrado) == 1 ) {
            $usuario_encontrado = $usuario_encontrado[0];
            
            $resultado_autenticacao = Autenticacao::verificar( $senha, $usuario_encontrado->senha );
            
            if( $resultado_autenticacao == true ) {
                $resultado = $usuario_encontrado;
                $resultado->id = (int) $resultado->id;                
                $resultado->saldo = (double) $resultado->saldo;                
                $resultado->autenticacaoDupla = (int) $resultado->autenticacaoDupla;                
                $resultado->idCidade = (int) $resultado->idCidade;
                $resultado->idTipoConta = (int) $resultado->idTipoConta;
                $resultado->idPlanoConta = (int) $resultado->idPlanoConta;
                $resultado->idLicencaDesktop = (int) $resultado->idLicencaDesktop;
            }
        }
    }

    echo json_encode( $resultado );
?>