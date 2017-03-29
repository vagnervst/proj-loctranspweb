<?php
    require_once("../include/initialize.php");
    $dadosTipoVeiculo = new \Tabela\TipoVeiculo();
    $id = (isset($_GET["id"]))? (int) $_GET["id"] : null;
    $buscaDados = $dadosTipoVeiculo->buscar("id = {$id}");

    if( !empty($buscaDados[0]) ) $dadosTipoVeiculo = $buscaDados[0];

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
            <div class="CMS_main" id="pag-tipo-veiculo">
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
                    <a href="CMS_home.php" class="link-caminho" >Home</a> ><a href="CMS_cityshare.php" class="link-caminho"> City Share</a> ><a href="veiculos.php" class="link-caminho"> Veículos</a> ><a href="#" class="link-caminho"> Tipos</a>
                </div>
                <form>
                    <div class="box-conteudo">
                        <div class="container-campos">
                            <div class="container-add">
                                <div class="box-label-input">
                                <label class="titulo-input"><span class="label">Tipo</span>
                                    <input class="input-pagina input" type="text" name="txtPergunta">
                                </label>
                                </div>
                                <input class="preset-botao" type="submit" name="btnAdd" value="+" />
                            </div>
                        </div>
                        <div></div>
                    </div>
                </form>
            </div>
            <?php
                include("layout/footer.php");
            ?>
        </div>      
	</body>
</html>