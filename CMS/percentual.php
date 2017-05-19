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
            <div class="CMS_main" id="pag-percentual-lucro">
                <?php include("layout/menu.php") ?>
                <div id="box-caminho">
                    <a href="home.php" class="link-caminho">Home</a> &gt; 
                    <a href="cityshare.php" class="link-caminho">City Share</a> &gt; 
                    <a href="financeiro.php" class="link-caminho">Financeiro</a> &gt; 
                    <a href="percentual.php" class="link-caminho">Percentual de Lucro</a>
                </div>
                <div class="box-conteudo">
                    <div id="box-form-percentual">
                        <form class="js-modo-insert" method="post" action="#" id="form-modificacao">
                            <div class="box-label-input">
                                <label><span class="label">Tipo do Veículo:</span>
                                    <select id="slTipoVeiculo" class="preset-input-select select" name="slTipoVeiculo">
                                        <option selected disabled>Selecione um tipo de veículo</option>                                        
                                        <?php
                                            $listaTipoVeiculo = new \Tabela\TipoVeiculo();
                                            $listaTipoVeiculo = $listaTipoVeiculo->buscar("visivel = 1");
                                            
                                            foreach( $listaTipoVeiculo as $tipoVeiculo ) {
                                        ?>
                                        <option value="<?php echo $tipoVeiculo->id; ?>"><?php echo $tipoVeiculo->titulo; ?></option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                </label>
                            </div>
                            <div class="box-label-input">
                                <label><span class="label">Categoria do Veículo:</span>
                                    <select id="slCategoriaVeiculo" class="select" name="slCategoriaVeiculo">
                                        <option selected disabled>Selecione uma Categoria</option>
                                    </select>
                                </label>
                            </div>
                            <div class="box-label-input">
                                <label><span class="label">Percentual de Lucro:</span>
                                    <input class="input" type="text" name="txtPercentualLucro" />
                                </label>
                            </div>
                            <div class="box-label-input">
                                <label><span class="label">Valor mínimo do veículo:</span>
                                    <input class="input" type="text" name="txtValorMinimoVeiculo" />
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
                    <div id="box-listagem-percentuais"></div>
                </div>
            </div>
            <?php
                include("layout/footer.php");
            ?>
        </div>      
	</body>
</html>