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
                    <a href="estatisticas_cityshare.php" class="link-caminho">Estatísticas</a> &gt;
                    <a href="estatisticas_publicacoes.php" class="link-caminho">Publicações</a>
                </div>
                <div class="box-conteudo">                
                    <div class="box-grafico">
                        <div class="nome-grafico">
                            Publicações por 
                        </div>
                        <div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                include("layout/footer.php");
            ?>
        </div>      
	</body>
</html>