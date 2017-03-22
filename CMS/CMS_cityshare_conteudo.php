<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>
            CMS - Conteúdo | City Share
		</title>
        <link rel="stylesheet" type="text/css" href="CSS/Style.css">
	</head>
	<body>
        <div id="container">
            <?php
                include("layout/header.php");
            ?>
            <div class="CMS_main" id="pag-cityshare-conteudo">
                <div class="box-menu-lateral">
                     <div class="menu-lateral">
                        <ul>
                            <li class="botao-menu-lateral">
                                <a href="CMS_home.php">Home</a>
                                <img src="Image/50x50.gif"/>
                            </li>
                            <li class="botao-menu-lateral">
                                <a href="#">Clientes</a>
                                <img src="Image/50x50.gif"/>
                            </li>
                            <li class="botao-menu-lateral">
                                <a href="CMS_cityshare.php">City Share</a>
                                <img src="Image/50x50.gif"/>
                            </li>
                            <li class="botao-menu-lateral">
                                <a href="#">Desktop</a>
                                <img src="Image/50x50.gif"/>
                            </li>
                        </ul>
                    </div>
                </div>
                <div id="box-caminho">
                    <a href="CMS_home.php" class="link-caminho" >Home</a> ><a href="CMS_cityshare.php" class="link-caminho"> City Share</a> > <a href="CMS_cityshare_conteudo.php" class="link-caminho" >Conteúdo</a>
                </div>
                <div class="box-conteudo">
                    <div class="box-conteudo-menu">
                        <img src="Image/content_test.jpg" />
                        <p class="titulo-conteudo-menu"><a href="CMS_adm_home.php">Home</a></p>
                    </div>
                    <div class="box-conteudo-menu">
                        <img src="Image/content_test.jpg" />
                        <p class="titulo-conteudo-menu"><a href="CMS_empresa.php">Sobre a Empresa</a></p>
                    </div>
                    <div class="box-conteudo-menu">
                        <img src="Image/content_test.jpg" />
                        <p class="titulo-conteudo-menu"><a href="#">Empreste</a></p>      
                    </div>
                    <div class="box-conteudo-menu">
                        <img src="Image/content_test.jpg" />
                        <p class="titulo-conteudo-menu"><a href="CMS_beneficios.php">Benefícios do Projeto</a></p>
                    </div>
                    <div class="box-conteudo-menu">
                        <img src="Image/content_test.jpg" />
                        <p class="titulo-conteudo-menu"><a href="CMS_projeto.php">Sobre o Projeto</a></p>
                    </div>
                </div>
            </div>
            <?php
                include("layout/footer.php");
            ?>
        </div>      
	</body>
</html>