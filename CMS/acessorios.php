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
                    <a href="CMS_home.php" class="link-caminho" >Home</a> ><a href="CMS_cityshare.php" class="link-caminho"> City Share</a> ><a href="#" class="link-caminho"> Veículos</a>
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
                                    <option><?php echo($row['titulo']); ?></option>
                                </select>
                            </div>
                        </div>
                        
                    </div>
                    <div class="titulo-sessao"> Cadastro de acessório</div>
                    <div id="box-listagem-acessorios">
                    
                    </div>
                </div>
            </div>
            <?php
                include("layout/footer.php");
            ?>
        </div>      
	</body>
</html>