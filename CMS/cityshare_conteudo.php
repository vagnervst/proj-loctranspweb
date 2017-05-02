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
                            
                $id_permissoes = $sessao->get("id_permissoes");
            
                if( !in_array(7, $id_permissoes) ) redirecionar_para( "index.php" );
            ?>
            <div class="CMS_main" id="pag-cityshare-conteudo">
                <?php include("layout/menu.php") ?>
                <div id="box-caminho">
                    <a href="home.php" class="link-caminho" >Home</a> ><a href="cityshare.php" class="link-caminho"> City Share</a> > <a href="CMS_cityshare_conteudo.php" class="link-caminho" >Conteúdo</a>
                </div>
                <div class="box-conteudo">
                    <div class="box-conteudo-menu">
                        <a class="titulo-conteudo-menu" href="adm_home.php">
                            <img src="Image/content_test.jpg" />
                            Home
                        </a>
                    </div>
                    <div class="box-conteudo-menu">
                        <a class="titulo-conteudo-menu" href="empresa.php">
                            <img src="Image/content_test.jpg" />
                            Sobre a Empresa
                        </a>
                    </div>
                    <div class="box-conteudo-menu">
                        <a class="titulo-conteudo-menu" href="empreste.php">
                            <img src="Image/content_test.jpg" />
                            Empreste
                        </a>
                    </div>
                    <div class="box-conteudo-menu">
                        <a class="titulo-conteudo-menu" href="beneficios.php">
                            <img src="Image/content_test.jpg" />
                            Benefícios do Projeto
                        </a>
                    </div>                    
                    <div class="box-conteudo-menu">
                        <a class="titulo-conteudo-menu" href="projeto.php">
                            <img src="Image/content_test.jpg" />
                            Sobre o Projeto
                        </a>
                    </div>
                    <div class="box-conteudo-menu">                        
                        <a class="titulo-conteudo-menu" href="contato.php">
                            <img src="Image/content_test.jpg" />
                            Contato
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