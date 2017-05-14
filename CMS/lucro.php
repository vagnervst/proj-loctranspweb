<?php
    require_once("../include/initialize.php");
    require_once("../include/classes/tbl_veiculo.php");
    require_once("../include/classes/tbl_transmissao.php");
    require_once("../include/classes/tbl_fabricante_veiculo.php");
    require_once("../include/classes/tbl_tipo_combustivel.php");
    require_once("../include/classes/tbl_tipo_veiculo.php");
    require_once("../include/classes/tbl_categoria_veiculo.php");    
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>
            CMS - Veículos | City Share
		</title>
        <link rel="stylesheet" type="text/css" href="CSS/Style.css">
        <link rel="icon" href="../img/icones/logoCityShareIcon.png">
	</head>
	<body>
        <div id="container">
            <?php
                include("layout/header.php");
            ?>
            <div class="CMS_main" id="pag-lucro">
                <?php include("layout/menu.php") ?>
                <div id="box-caminho">
                    <a href="home.php" class="link-caminho">Home</a> ><a href="cityshare.php" class="link-caminho"> City Share</a> ><a href="veiculos.php" class="link-caminho"> Veículos</a> > <a href="modelos_veiculo.php" class="link-caminho" >Modelos</a>
                </div>
                <div class="box-conteudo">                     
                                     
                </div>
            </div>
            <?php
                include("layout/footer.php");
            ?>
        </div>      
	</body>
</html>