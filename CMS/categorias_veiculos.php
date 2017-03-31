<?php
    require_once("../include/initialize.php");    
    require_once("../include/classes/tbl_tipo_veiculo.php");
    require_once("../include/classes/tbl_categoria_veiculo.php");    
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>CMS - Categorias | City Share</title>
        <link rel="stylesheet" type="text/css" href="CSS/Style.css">
        <link rel="icon" href="../img/icones/logoCityShareIcon.png">
	</head>
	<body>
        <div id="container">
            <?php
                include("layout/header.php");
            ?>
            <div class="CMS_main" id="pag-adm-veiculos">
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
                    <a href="CMS_home.php" class="link-caminho">Home</a> ><a href="CMS_cityshare.php" class="link-caminho"> City Share</a> > <a href="CMS_cityshare_nivelAcesso.php" class="link-caminho" >Administração de Veículos</a>
                </div>
                <div class="box-conteudo">
                    <div id="box-form-veiculo">
                        <form>
                            <div class="box-label-input">
                                <label><span class="label">Nome da categoria:</span>
                                    <input class="input" type="text" name="txt_nome_categoria" />
                                </label>
                            </div>
                            <div class="box-label-input">
                                <label><span class="label">Percentual de lucro:</span>
                                    <input class="input" type="text" name="txt_percentual_categoria" />
                                </label>
                            </div>
                            <div class="box-label-input">
                                <label><span class="label">Valor mínimo do veículo:</span>
                                    <input class="input" type="text" name="txt_valor_categoria" />
                                </label>
                            </div>
                            <div class="box-label-input">
                                <label><span class="label">Tipo de veículo:</span>
                                    <select name="txt_tipo_categoria">
                                        <option value="valor_categoria">Valor</option>
                                    </select>
                                </label>
                            </div>
                            <div class="box-salvar-cancelar">                                        
                                <input class="preset-botao botao" id="botao-cancelar" type="reset" value="Cancelar" />                                        
                                <input class="preset-input-submit botao" type="submit" name="btnSubmit" value="Salvar" />
                            </div>
                        </form>
                        <div id="box-listagem-categorias"></div>
                    </div>
                </div>
            </div>
            <?php
                include("layout/footer.php");
            ?>
        </div>      
	</body>
</html>