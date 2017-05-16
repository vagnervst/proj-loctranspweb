<?php
    require_once("../include/initialize.php");
    require_once("../include/classes/tbl_usuario.php");
    
    $search = ( isset($_POST["txtPesquisa"]) )? (int) $_POST["txtPesquisa"] : null;
    if( isset($_POST['btnBuscar']) ) {
        $usuarios = new \Tabela\Usuario();
        $usuarios = $usuarios->getUsuario(" u.nome LIKE {$search} ");
    }
    
    $usuarios = new \Tabela\Usuario();
    $usuarios = $usuarios->getUsuario();
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
                        <a href="home.php" class="link-caminho" >Home</a> ><a href="clientes.php" class="link-caminho"> Clientes</a> > <a href="usuario.php" class="link-caminho" >Usuarios</a>
                    </div>
                    <div id="box-pesquisa">
                        <form method="post" action="#"> 
                            <input id="search-input" type="search" name="txtPesquisa" placeholder="Pesquisar" />
                            <input class="preset-input-submit" name="btnBuscar" type="submit" value="Pesquisar" />
                       </form>
                    </div>
                <div class="box-conteudo">
                    <?php
                        foreach( $usuarios as $usuario ){
                    ?>
                    <div class="box-listagem-usuario">
                        <div class="nome-usuario"><?php echo $usuario->nome; ?></div>
                        <div class="box-label-info">
                            <p class="label">Email:</p>
                            <p class="info"><?php echo $usuario->email; ?></p>
                        </div>
                        <div class="box-label-info">
                            <p class="label">Tipo:</p>
                            <p class="info"><?php echo $usuario->tipoConta; ?></p>
                        </div>
                        <div class="box-botao">
                            <a href="info_usuario.php?id=<?php echo $usuario->id; ?>" class="preset-botao">Ver mais</a>
                        </div>
                    </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
            <?php
                include("layout/footer.php");
            ?>
        </div>      
	</body>
</html>