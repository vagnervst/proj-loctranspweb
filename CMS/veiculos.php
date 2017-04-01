<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>
            CMS - Conteúdo | City Share
		</title>
        <link rel="stylesheet" type="text/css" href="CSS/Style.css">
        <link rel="icon" href="../img/icones/logoCityShareIcon.png">
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
                                <a href="CMS_home.php">Home</a>
                                 <img src="Image/50x50.gif"/>
                            </li>
                            <li class="botao-menu-lateral">
                                <a href="CMS_clientes.php">Clientes</a>
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
                    <a href="CMS_home.php" class="link-caminho" >Home</a> ><a href="CMS_cityshare.php" class="link-caminho"> City Share</a> ><a href="#" class="link-caminho"> Veículos</a>
                </div>
                <div class="box-conteudo">
                    <div class="box-conteudo-menu">
                        <a class="titulo-conteudo-menu" href="modelos_veiculo.php">
                            <img src="Image/content_test.jpg" />
                            Modelos
                        </a>
                    </div>
                    <div class="box-conteudo-menu">
                        <a class="titulo-conteudo-menu" href="categorias_veiculos.php">
                            <img src="Image/content_test.jpg" />                        
                            Categorias
                        </a>
                    </div>                                       
                    <div class="box-conteudo-menu">                        
                        <a class="titulo-conteudo-menu" href="tipos_veiculos.php">
                            <img src="Image/content_test.jpg" />
                            Tipos
                        </a>
                    </div>                                       
                    <div class="box-conteudo-menu">                        
                        <a class="titulo-conteudo-menu" href="marcas_veiculos.php">
                            <img src="Image/content_test.jpg" />
                            Marcas
                        </a>
                    </div>                                       
                    <div class="box-conteudo-menu">                        
                        <a class="titulo-conteudo-menu" href="acessorios_veiculos.php">
                            <img src="Image/content_test.jpg" />
                            Acessórios
                        </a>
                    </div>
                </div>
            </div>
            <?php
                include("layout/footer.php");
            ?>
        </div>      
	</body>
</html>