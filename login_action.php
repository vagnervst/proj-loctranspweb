<?php
    require_once("include/initialize.php");  
    require_once("include/classes/sessao.php");
    require_once("include/classes/tbl_usuario.php");
    
    if( isset($_POST["submitLogin"]) ) {
        $db = new \DB\Database();
        
        $email = ( isset($_POST["txtEmail"]) )? mysqli_real_escape_string($db->conexao, $_POST["txtEmail"]) : null;
        $senha = ( isset($_POST["txtSenha"]) )? mysqli_real_escape_string($db->conexao, $_POST["txtSenha"]) : null;

        $usuarioAlvo = new \Tabela\Usuario();
        $usuarioAlvo = $usuarioAlvo->buscar( "email = '{$email}'" );
        
        if( isset( $usuarioAlvo[0] ) ) $usuarioAlvo = $usuarioAlvo[0];
        
        if( Autenticacao::verificar( $senha, $usuarioAlvo->senha ) ) {            
            $sessao = new Sessao();
            
            $sessao->put("idUsuario", $usuarioAlvo->id);
            
            redirecionar_para("index.php");
        }
    }
?>