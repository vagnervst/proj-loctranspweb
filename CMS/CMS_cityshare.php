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
            <div class="CMS_main" id="pag-home">
                <div class="box-menu-lateral">
                    <div class="menu-lateral">
                        <ul>
                            <li class="botao-menu-lateral">
                                <a href="#">Home</a>
                                <img src="Image/50x50.gif"/>
                            </li>
                            <li class="botao-menu-lateral">
                                <a href="#">Clientes</a>
                                <img src="Image/50x50.gif"/>
                            </li>
                            <li class="botao-menu-lateral">
                                <a href="#">City Share</a>
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
                    <a href="#" class="link-caminho" >Home</a> ><a href="#" class="link-caminho"> city share</a> >
                </div>
                <div class="box-conteudo">
                    <div class="box-conteudo-menu">
                        <img />
                        <p class="titulo-conteudo-menu">Conteudo</p>           
                    </div>
                    <div class="box-conteudo-menu">
                        <img />
                        <p class="titulo-conteudo-menu">Níveis de acesso</p>           
                    </div>
                    <div class="box-conteudo-menu">
                        <img />
                        <p class="titulo-conteudo-menu">Permissões</p>           
                    </div>
                    <div class="box-conteudo-menu">
                        <img />
                        <p class="titulo-conteudo-menu">Contato</p>           
                    </div>
                    <div class="box-conteudo-menu">
                        <img />
                        <p class="titulo-conteudo-menu">Administradores</p>           
                    </div>
                </div>
            </div>
            <?php
                include("layout/footer.php");
            ?>
        </div>      
	</body>
</html>