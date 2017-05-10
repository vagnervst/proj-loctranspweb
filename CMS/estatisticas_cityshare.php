<?php
    require_once("../include/classes/sessao.php");
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>
            CMS - Estatísticas | City Share
		</title>
        <link rel="stylesheet" type="text/css" href="CSS/Style.css">
        <link rel="icon" href="../img/icones/logoCityShareIcon.png">
	</head>
	<body>
        <div id="container">
            <?php
                include("layout/header.php");
            ?>
            <div class="CMS_main" id="pag-financeiro">
                <?php include("layout/menu.php") ?>
                <div id="box-caminho">
                    <a href="home.php" class="link-caminho">Home</a> &gt;
                    <a href="cityshare.php" class="link-caminho">City Share</a> &gt;
                    <a href="financeiro.php" class="link-caminho">Financeiro</a> &gt;
                    <a href="estatisticas_cityshare.php" class="link-caminho">Estatísticas</a>
                </div>
                <div class="box-conteudo">                
                    <div class="box-conteudo-menu">
                        <a class="titulo-conteudo-menu" href="estatisticas_publicacoes.php">
                            <img src="Image/content_test.jpg" />
                            Publicações
                        </a>
                    </div>
                    <div class="box-conteudo-menu">
                        <a class="titulo-conteudo-menu" href="estatisticas_diarias.php">
                            <img src="Image/content_test.jpg" />                        
                            Valor das díarias
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