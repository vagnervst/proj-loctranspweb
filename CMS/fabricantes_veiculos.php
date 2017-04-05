<!DOCTYPE html>
<?php 
     require_once("../include/initialize.php"); 
?>
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
            <div class="CMS_main" id="pag-fabricante-veiculo">
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
                    <a href="CMS_home.php" class="link-caminho" >Home</a> ><a href="CMS_cityshare.php" class="link-caminho"> City Share</a> ><a href="veiculos.php" class="link-caminho"> Veículos</a> ><a href="fabricantes_veiculos.php" class="link-caminho"> Fabricantes</a>
                </div>
                <div class="box-conteudo">
                    <div id="box-novo-registro" >
                        <form class="js-modo-insert" method="post" action="#" id="form-modificacao">
                            <div class="titulo-sessao"> Cadastro de fabricante</div>
                            <div id="box-campos-acessorio">
                                <div class="box-input-pagina">
                                    <label class="titulo-input">Titulo fabricante</label>
                                    <input type="text" name="txt_titulo" class="input-pagina" required>
                                </div>
                                <span type="submit" class="preset-botao js-botao-remocao btn" name="btn_adicionar">Excluir</span>
                                <div id="box-salvar-cancelar">                                
                                    <input type="reset"  class="btn" value="Cancelar" required>
                                    <input type="submit" value="Salvar" name="btn_adicionar" class="preset-input-submit btn">
                                </div>

                            </div>
                        </form>
                    </div>
                    <div class="titulo-sessao">Fabricantes  cadastrados</div>
                    <div id="box-listagem-fabricantes"></div>
                </div>
            </div>
            <?php
                include("layout/footer.php");
            ?>
        </div>      
	</body>
</html>