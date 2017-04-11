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
            
                $id_permissoes = $sessao->get("id_permissoes");
            
                if( !in_array(8, $id_permissoes) ) redirecionar_para( "index.php" );
            ?>
            <div class="CMS_main" id="pag-cityshare-adm">
                <?php include("layout/menu.php") ?>
                <div id="box-caminho">
                    <a href="CMS_home.php" class="link-caminho">Home</a> ><a href="CMS_cityshare.php" class="link-caminho"> City Share</a> > <a href="CMS_cityshare_nivelAcesso.php" class="link-caminho" >Níveis de Acesso</a>
                </div>
                <div class="box-conteudo">
                   <div class="lista-wrapper">
                        <?php
                            $listaNiveisAcesso = new \Tabela\NivelAcessoCS();
                            $listaNiveisAcesso = $listaNiveisAcesso->buscar();

                            foreach( $listaNiveisAcesso as $nivelAcesso ) {
                        ?>
                        <div class="box-conteudo-adm">
                            <div class="titulo-conteudo-adm"><p><?php echo $nivelAcesso->nome; ?></p></div>
                            <div class="box-adm-info">
                                <p class="label">Número de usuarios:</p>
                                <p class="info">X</p>
                            </div>
                            <div class="box-btn-edit">
                                <a class="preset-botao" href="CMS_nivel_edit.php?id=<?php echo $nivelAcesso->id; ?>">Editar</a>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="box-operacoes">
                        <ul id="menu-operacoes">
                            <li><a class="preset-botao botao-operacao" href="CMS_nivel_edit.php">Novo</a></li>
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