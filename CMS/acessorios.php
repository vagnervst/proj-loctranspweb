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
        <link rel="icon" href="../img/icones/logoCityShareIcon.png">
	</head>
	<body>
        <div id="container">
            <?php
                include("layout/header.php");
            ?>
            <div class="CMS_main" id="pag-acessorio-veiculo">
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
                    <a href="CMS_home.php" class="link-caminho" >Home</a> ><a href="CMS_cityshare.php" class="link-caminho"> City Share</a> ><a href="#" class="link-caminho"> Veículos</a>><a href="#" class="link-caminho"> Acessórios</a>
                </div>
                <div class="box-conteudo">
                    <div id="box-novo-registro" >
                        <div class="titulo-sessao"> Cadastro de acessório</div>
                        <div id="box-campos-acessorio">
                            <div class="box-input-pagina">
                                <label class="titulo-input">Titulo acessorio</label>
                                <input type="text" name="txt_titulo" class="input-pagina">
                            </div>
                            <div id="box-input-pagina">
                                <label class="titulo-input">Tipo de Veículo</label>
                                <select >
                                    <option>1</option>
                                </select>
                            </div>
                            <input type="submit" value="Adicionar" name="btn_adicionar" class="btn">
                            
                            <div id="box-btn-exc-cancelar">
                                <span type="submit"  name="btn_adicionar" class="btn">Excluir </span>
                                <span type="submit"  name="btn_adicionar" class="btn">Cancelar </span>
                            </div>
                            
                        </div>
                        
                    </div>
                    <div class="titulo-sessao"> Acessórios cadastrados</div>
                    <div id="box-listagem-acessorios">
                        <form action="#" method="post">
                            <div class="item-acessorio">
                                <label for="txt_titulo" class="input-label" > Titulo :</label>
                                <input type="text" name="txt_titulo" class="input">
                                <input type="submit" name="btn_editar" value="Salvar" class="btn_enviar"> 
                            </div>
                        
                        </form>
                        
                    </div>
                </div>
            </div>
            <?php
                include("layout/footer.php");
            ?>
        </div>      
	</body>
</html>