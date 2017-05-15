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
            <div class="CMS_main" id="pag-plano-conta">
                <?php include("layout/menu.php") ?>
                <div id="box-caminho">
                    <a href="home.php" class="link-caminho">Home</a> ><a href="clientes.php" class="link-caminho"> Clientes</a> ><a href="plano_conta.php" class="link-caminho"> Planos de Conta</a>
                </div>
                <div class="box-conteudo">
                    <div id="box-form-plano">
                        <form class="js-modo-insert" method="post" action="#" id="form-plano-conta">
                            <div class="box-label-input">
                                <label><span class="label">Nome do plano :</span>
                                    <input class="input" type="text" name="txtNomePlano" />
                                </label>
                            </div>
                            <div class="box-label-input">
                                <label><span class="label">Preço:</span>
                                    <input class="input" type="text" name="txtPreco" />
                                </label>
                            </div>
                            <div class="box-label-input">
                                <label><span class="label">Duração plano (meses):</span>
                                    <input class="input" type="text" name="txtDuracaoMeses" />
                                </label>
                            </div>
                            <div class="box-label-input">
                                <label><span class="label">Limite de publicações:</span>
                                    <input class="input" type="text" name="txtLimitePublicacoes" />
                                </label>
                            </div>
                            <div class="box-label-input">
                                <label><span class="label">Dias para analise:</span>
                                    <input class="input" type="text" name="txtDiasAnalise" />
                                </label>
                            </div>
                            <div class="box-label-input">
                                <label><span class="label">Descrição plano:</span>
                                    <textarea class="input" name="txtDescricaoPlano"></textarea>
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
                    <div class="titulo-sessao">Planos  cadastrados</div>
                    <div id="box-listagem-planos"></div>
                </div>
            </div>
            <?php
                include("layout/footer.php");
            ?>
        </div>      
	</body>
</html>