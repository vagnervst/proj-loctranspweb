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
            <div class="CMS_main" id="pag-licenca-desktop">
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
                    <a href="CMS_home.php" class="link-caminho" >Home</a> ><a href="desktop.php" class="link-caminho"> Desktop</a > ><a href="#.php" class="link-caminho"> Licenças Desktop</a>
                </div>
                <div class="box-conteudo">
                    <div class="titulo-sessao">Cadastro de Licenças</div>
                    <div class="box-form-licenca">
                        <form class="js-modo-insercao" method="post" action="#" id="form-modificacao">
                            <div class="box-label-input">
                                <label class="titulo-input"><span class="label">Licença</span>
                                    <input class="input-pagina input" type="text" name="txtNomeLicenca" />
                                </label>
                                <label class="titulo-input"><span class="label">Conexões Simultâneas</span>
                                    <input class="input-pagina input" type="text" name="txtConexoesLicenca" />
                                </label>
                                <label class="titulo-input"><span class="label">Preço</span>
                                    <input class="input-pagina input" type="text" name="txtPrecoLicenca" />
                                </label>
                                <label class="titulo-input"><span class="label">Duração</span>
                                    <input class="input-pagina input" type="text" name="txtDuracaoLicenca" />
                                </label>
                            </div>
                            <div class="horizontal-input-wrapper">
                                <input class="preset-botao" id="botao-cancelar" type="reset" value="Cancelar" />
                                <span class="preset-botao js-botao-remocao" id="botao-remover">Remover</span>
                            </div>
                            <input class="preset-botao" type="submit" name="btnAdd" value="Salvar" />
                        </form>
                    </div>
                    <div class="box-listagem-licencas"></div>
                </div>
            </div>
            <?php
                include("layout/footer.php");
            ?>
        </div>      
	</body>
</html>