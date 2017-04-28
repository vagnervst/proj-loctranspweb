<?php
    require_once("../include/initialize.php");
    require_once("../include/classes/tbl_usuario_cs.php");
    $administradoresCS = new \Tabela\UsuarioCS();
    $administradoresCS = $administradoresCS->getUsuarios();
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
            
                $id_permissoes = $sessao->get("id_permissoes");
            
                if( !in_array(9, $id_permissoes) ) redirecionar_para( "index.php" );
            ?>
            <div class="CMS_main" id="pag-cityshare-adm">
                <?php include("layout/menu.php") ?>
                <div id="box-caminho">
                    <a href="CMS_home.php" class="link-caminho" >Home</a> ><a href="cityshare.php" class="link-caminho"> City Share</a> > <a href="CMS_cityshare_adm.php" class="link-caminho" >Administradores</a>
                </div>
                <div class="box-conteudo">
                   <div class="lista-wrapper">
                        <?php
                            foreach( $administradoresCS as $administrador ) {
                        ?>
                        <div class="box-conteudo-adm">                       
                            <div class="titulo-conteudo-adm">
                                <p><?php echo $administrador["nome"] . " " . $administrador["sobrenome"][0]; ?><p>
                            </div>                        
                            <div class="box-adm-info">                            
                                <div class="box-info-label">
                                    <p class="label">Nível de Autenticação:</p>
                                    <p class="info"><?php echo $administrador["nivelAcesso"]; ?></p>
                                </div>
                            </div>
                            <div class="box-btn-edit">
                                <a class="preset-botao botao-operacoes" href="administrador.php?id=<?php echo $administrador["id"]; ?>">Editar</a>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="box-operacoes">
                        <ul id="menu-operacoes">
                            <li><a class="preset-botao botao-operacao" href="administrador.php">Novo</a></li>
                        </ul>
                    </div>
                </div>                
            </div>
            <?php
                include("layout/footer.php");
            ?>
        </div>      
	</body>
</html>