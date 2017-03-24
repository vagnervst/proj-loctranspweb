<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>
            CMS - Conteúdo | City Share
		</title>
        <link rel="stylesheet" type="text/css" href="CSS/Style.css">
	</head>
	<body>
        <div id="container">
            <?php
                include("layout/header.php");
            ?>
            <div class="CMS_main" id="pag-clientes">
                <div class="box-menu-lateral">
                     <div class="menu-lateral">
                        <ul>
                            <li class="botao-menu-lateral">
                                <a href="CMS_home.php">Home</a>
                                <img src="Image/50x50.gif"/>
                            </li>
                            <li class="botao-menu-lateral">
                                <a href="#">Clientes</a>
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
                
                <div class="box-conteudo">
                    <div id="box-caminho">
                    <a href="CMS_home.php" class="link-caminho" >Home</a> ><a href="CMS_cityshare.php" class="link-caminho"> City Share</a> > <a href="CMS_cityshare_adm.php" class="link-caminho" >Administradores</a> > <a href="#" class="link-caminho" >Editar/Novo</a>
                    
                    </div>
                    <div id="box-pesquisa">
                        <form method="post" action="CMS_usuario.php"> 
                            <input id="search" type="search" placeholder="Pesquisar"  ><input id="btn-pesquisar"type="submit" value="pesquisar">
                                   
                       </form>
                    </div>
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