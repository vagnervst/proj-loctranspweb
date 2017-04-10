<?php
    require_once("../include/initialize.php");
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
            <div class="CMS_main" id="pag-clientes-usuarios">
                <?php include("layout/menu.php") ?>
                <div id="box-caminho">
                        <a href="CMS_home.php" class="link-caminho" >Home</a> ><a href="CMS_clientes.php" class="link-caminho"> Clientes</a> > <a href="CMS_usuario.php" class="link-caminho" >Usuarios</a>
                    </div>
                    <div id="box-pesquisa">
                        <form method="post" action="CMS_usuario.php"> 
                            <input id="search-input" type="search" placeholder="Pesquisar" />
                            <input class="preset-input-submit"type="submit" value="pesquisar" />
                                   
                       </form>
                    </div>
                <div class="box-conteudo">
                    <div class="box-usuario">
                        <div class="nome-usuario">jose bezerra</div>
                        <div class="cont-usuario">Email : jbezerra</div>
                        <div class="cont-usuario">Tipo : jbezerra</div>
                    </div>
                </div>
            </div>
            <?php
                include("layout/footer.php");
            ?>
        </div>      
	</body>
</html>