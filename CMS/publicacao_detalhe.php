<?php
    require_once("../include/initialize.php");
    require_once("../include/classes/sessao.php");    
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>
            CMS - Publicações | City Share
		</title>
        <link rel="stylesheet" type="text/css" href="CSS/Style.css">
        <link rel="icon" href="../img/icones/logoCityShareIcon.png">
	</head>
	<body>
        <div id="container">
           <?php
                include("layout/header.php");
            ?>
            <div class="CMS_main" id="pag-publicacao-detalhes">
                <?php include("layout/menu.php") ?>
                <div id="box-caminho">
                    <a href="home.php" class="link-caminho" >Home</a> ><a href="clientes.php" class="link-caminho"> Clientes</a> ><a href="publicacoes.php" class="link-caminho"> Publicações</a> ><a href="publicacao_detalhe.php" class="link-caminho"> Detalhes da Publicação</a>
                </div>
                <div class="box-publicacao">
                    <div id="nome-publicacao" class="boxes-publicacao">
                        nome publicação
                    </div>
                    <div id="imagens-publicacao" class="boxes-publicacao">
                        imagens
                    </div>
                    <div id="modelo-publicacao" class="boxes-publicacao">
                        nome do modelo
                    </div>
                    <div id="proprietario-publicacao" >
                        proprietario
                    </div>
                    <div id="reputacao-publicacao" >
                        reputação
                    </div>
                    <div id="data-publicacao" class="boxes-publicacao">
                        data
                    </div>
                    <div id="diaria-publicacao" class="boxes-publicacao">
                        diaria
                    </div>
                    <div id="combustivel-publicacao" class="boxes-publicacao">
                        combustivel
                    </div>
                    <div id="distancia-publicacao" class="boxes-publicacao">
                        distancia
                    </div>
                    <div id="status-publicacao" class="boxes-publicacao">
                        status
                    </div>
                    <div id="botoes-publicacao" class="boxes-publicacao">
                        aprovar|recusar
                    </div>
                </div>
            </div>
            <?php
                include("layout/footer.php");
            ?>
        </div>      
	</body>
</html>