<?php
    require_once("../include/classes/sessao.php");
?>
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
            <div class="CMS_main" id="pag-financeiro">
                <?php include("layout/menu.php") ?>
                <div id="box-caminho">
                    <a href="home.php" class="link-caminho">Home</a> &gt;
                    <a href="cityshare.php" class="link-caminho">City Share</a> &gt;
                    <a href="#" class="link-caminho">Financeiro</a>
                </div>
                <?php                
                    $lista_permissoes_usuario = $sessao->get("id_permissoes");
                ?>
                <div class="box-conteudo">
                    <?php if( in_array(7, $lista_permissoes_usuario) ) { ?>                  
                    <div class="box-conteudo-menu">
                        <a class="titulo-conteudo-menu" href="banco.php">
                            <img src="Image/content_test.jpg" />
                            Bancos
                        </a>
                    </div>
                    <?php } ?>
                    <?php if( in_array(8, $lista_permissoes_usuario) ) { ?>
                    <div class="box-conteudo-menu">
                        <a class="titulo-conteudo-menu" href="cartao.php">
                            <img src="Image/content_test.jpg" />                        
                            Cartões
                        </a>
                    </div>
                    <?php } ?>
                    <div class="box-conteudo-menu">
                        <a class="titulo-conteudo-menu" href="percentual.php">
                            <img src="Image/content_test.jpg" />                        
                            Percentuais de Lucro
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