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
            <div class="CMS_main" id="pag-desktop">
                <?php include("layout/menu.php") ?>
                <div id="box-caminho">
                    <a href="home.php" class="link-caminho" >Home</a> ><a href="clientes.php" class="link-caminho"> Desktop</a>
                </div>
                <div class="box-conteudo">
                    <div class="box-conteudo-menu">
                        <a class="titulo-conteudo-menu" href="licencas_desktop.php">
                            <img src="Image/content_test.jpg" />                        
                            Licenças Desktop
                        </a>
                    </div>
                    <div class="box-conteudo-menu">
                        <a class="titulo-conteudo-menu" href="#">
                            <img src="Image/content_test.jpg" />
                            Estatística Desktop
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