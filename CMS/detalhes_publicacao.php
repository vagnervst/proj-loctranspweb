<?php
    require_once("../include/initialize.php");
    require_once("../include/classes/tbl_publicacao.php");
    
    $idUsuario = ( isset($_GET["idUsuario"]) )? $_GET["idUsuario"] : null;
    $idPublicacao = ( isset($_GET["idPublicacao"]) )? $_GET["idPublicacao"] : null;

    $dadosPublicacao = new \Tabela\Publicacao();
    $dadosPublicacao = $dadosPublicacao->getPublicacao("u.id = {$idUsuario} AND p.id = {$idPublicacao}")[0];
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
            <div class="CMS_main" id="pag-detalhes-publicacao">
                <?php include("layout/menu.php") ?>
                <div id="box-caminho">
                    <a href="CMS_home.php" class="link-caminho" >Home</a> ><a href="clientes.php" class="link-caminho"> Clientes</a> > <a href="usuario.php" class="link-caminho" >Usuarios</a> > <a href="info_usuario.php?id=<?php echo $idUsuario ?>" class="link-caminho" >Informações do usuário</a> > <a href="#" class="link-caminho" >Detalhes Publicação</a>
                </div>
                <div class="box-conteudo">
                    <a class="preset-botao" id="botao-voltar" href="info_usuario.php?id=<?php echo $idUsuario ?>">←</a>
                    <div class="info-usuario">
                        <span>Nome: <?php echo $dadosPublicacao->nomeLocador; ?></span>
                    </div>
                    <div class="box-publicacao">
                    
                    </div>
                    <div class="lista-pedidos">
                        
                    </div>
                </div>
            </div>
            <?php
                include("layout/footer.php");
            ?>
        </div>      
	</body>
</html>