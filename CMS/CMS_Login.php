<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>
            CMS - Login | City Share
		</title>
        <link rel="stylesheet" type="text/css" href="CSS/Style.css">
	</head>
	<body >
        <div id="main_login">
            <header class="conteudo">
                <div id="banner_login">
                    <img src="Image/banner_test.jpg">
                </div>
            </header>
            <div class="conteudo" id="content_login">
                <form name="frmCMSlogin" method="post" action="CMS_home.php" id="form_login">
                    <label>Usuário
                        <input type="text" name="CMSusuario" class="text-input" required/></label>
                    <label>Senha
                        <input type="password" name="CMSsenha" class="text-input" required/></label>
                    <input type="submit" value="Entrar" name="CMSsubmit" class="submit-input"/>
                </form>
            </div>
            <div class="conteudo" id="footer_login">
                &copy; City Share 2017 - CityShare.com.br - Todos os Direitos Reservados
            </div>
        </div>
	</body>
</html>