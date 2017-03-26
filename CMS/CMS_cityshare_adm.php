<?php
    require_once("../include/initialize.php");
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
	</head>
	<body>
        <div id="container">
            <?php
                include("layout/header.php");
            ?>
            <div class="CMS_main" id="pag-cityshare-adm">
                <div class="box-menu-lateral">
                     <div class="menu-lateral">
                        <ul>
                            <li class="botao-menu-lateral">
                                <a href="CMS_home.php">Home</a>
                                <img src="Image/50x50.gif"/>
                            </li>
                            <li class="botao-menu-lateral">
                                <a href="CMS_clientes.php">Clientes</a>
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
                <div id="box-caminho">
                    <a href="CMS_home.php" class="link-caminho" >Home</a> ><a href="CMS_cityshare.php" class="link-caminho"> City Share</a> > <a href="CMS_cityshare_adm.php" class="link-caminho" >Administradores</a>
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
                                <a class="preset-botao botao-operacoes" href="CMS_adm_edit.php?id=<?php echo $administrador["id"]; ?>">Editar</a>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="box-operacoes">
                        <ul id="menu-operacoes">
                            <li><a class="preset-botao botao-operacao" href="CMS_adm_edit.php">Novo</a></li>
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