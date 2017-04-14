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
            <div class="CMS_main" id="pag-tipo-cartao">
                <?php include("layout/menu.php") ?>
                <div id="box-caminho">
                    <a href="CMS_home.php" class="link-caminho">Home</a> ><a href="cityshare.php" class="link-caminho"> City Share</a> ><a href="financeiro.php" class="link-caminho"> Financeiro</a> > <a href="#.php" class="link-caminho" >Cartões</a>
                </div>
                <div class="box-conteudo">
                    <div id="box-form-categoria">
                        <form class="js-modo-insert" method="post" action="#" id="form-tipo-cartao">
                            <div class="box-label-input">
                                <label><span class="label">Bandeira :</span>
                                    <input class="input" type="text" name="txtTipoCartao" />
                                </label>
                            </div>
                            <div class="box-label-input">
                                <label><span class="label">Qtde de dígitos Segurança:</span>
                                    <input class="input" type="text" name="txtDigitos" />
                                </label>
                            </div>
                            
                            <div id="box-acoes">
                                <span class="preset-botao botao js-botao-remocao" id="botao-remover">Remover</span>
                                <div id="box-salvar-cancelar">                                
                                    <input class="preset-botao botao" id="botao-cancelar" type="reset" value="Cancelar" />
                                    <input class="preset-input-submit botao" type="submit" name="btnSubmit" value="Salvar" />
                                </div>
                            </div>                  
                        </form>                        
                    </div>
                    <div class="titulo-sessao">Bandeiras cadastradas</div>
                    <div id="box-listagem-tipos-cartao"></div>
                </div>
            </div>
            <?php
                include("layout/footer.php");
            ?>
        </div>      
	</body>
</html>