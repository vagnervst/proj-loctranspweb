<?php
    require_once("../include/classes/sessao.php");
?>
<!DOCTYPE html>
<html>
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
            <div class="CMS_main" id="pag-clientes">
                <?php include("layout/menu.php") ?>
                <div id="box-caminho">
                    <a href="CMS_home.php" class="link-caminho" >Home</a> ><a href="CMS_clientes.php" class="link-caminho"> Clientes</a>
                </div>
                <?php                                        
                    $lista_permissoes_usuario = $sessao->get("id_permissoes");
                ?>
                <div class="box-conteudo">
                   <?php if( in_array(5, $lista_permissoes_usuario) ) { ?>
                    <div class="box-conteudo-menu">
                        <a class="titulo-conteudo-menu" href="CMS_usuario.php">
                            <img src="Image/content_test.jpg" />
                            Usuario
                        </a>
                    </div>
                    <?php } ?>
                    <?php if( in_array(6, $lista_permissoes_usuario) ) { ?>
                    <div class="box-conteudo-menu">
                        <a class="titulo-conteudo-menu" href="#">
                            <img src="Image/content_test.jpg" />                        
                            Planos de conta 
                        </a>
                    </div>
                    <?php } ?>
                    <?php if( in_array(7, $lista_permissoes_usuario) ) { ?>
                    <div class="box-conteudo-menu">
                        <a class="titulo-conteudo-menu" href="#">
                            <img src="Image/content_test.jpg" />                        
							Contatos
                        </a>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <?php
                include("layout/footer.php");
            ?>
        </div>      
	</body>
</html>