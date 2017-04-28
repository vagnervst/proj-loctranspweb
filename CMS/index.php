<?php
    require_once("../include/initialize.php");
    require_once("../include/classes/sessao.php");
    require_once("../include/classes/tbl_usuario_cs.php");
    require_once("../include/classes/tbl_nivel_acesso_cs.php");

    $submit = ( isset($_POST["btnSubmit"]) )? $_POST["btnSubmit"] : null;
    
    if( isset( $submit ) ) {
        $usuario = ( isset($_POST["txtusuario"]) )? $_POST["txtusuario"] : null;
        $senha = ( isset($_POST["txtsenha"]) )? $_POST["txtsenha"] : null;
        
        $objUsuario = \Tabela\UsuarioCS::login( $usuario, $senha );
        
        if( !empty( $objUsuario ) ) {
            //Login realizado com sucesso...
            $sessao = new Sessao();
            $sessao->put("id_usuario", $objUsuario->id);
            
            $lista_id_permissoes = new \Tabela\NivelAcessoCS();
            $lista_id_permissoes = $lista_id_permissoes->getNivelAcesso_permissoes( $objUsuario->idNivelAcesso );
            
            $sessao->put("id_permissoes", $lista_id_permissoes);
            
            redirecionar_para("home.php");
        }
    }
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>CMS - Login | City Share</title>
        <link rel="stylesheet" type="text/css" href="CSS/Style.css">
        <link rel="icon" href="../img/icones/logoCityShareIcon.png">
	</head>
	<body >
        <div id="main_login">
            <header class="conteudo">
                <div id="banner_login">
                    <img src="Image/banner_test.jpg">
                </div>
            </header>
            <div class="conteudo" id="content_login">
                <form name="frmCMSlogin" method="post" action="index.php" id="form_login">
                    <label>Usuário
                        <input type="text" name="txtusuario" class="text-input" required/></label>
                    <label>Senha
                        <input type="password" name="txtsenha" class="text-input" required/></label>
                    <input type="submit" value="Entrar" name="btnSubmit" class="submit-input"/>
                </form>
            </div>
            <div class="conteudo" id="footer_login">
                &copy; City Share 2017 - CityShare.com.br - Todos os Direitos Reservados
            </div>
        </div>
	</body>
</html>