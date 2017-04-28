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
            <div class="CMS_main" id="pag-categorias-veiculos">
                <?php include("layout/menu.php") ?>
                <div id="box-caminho">
                    <a href="home.php" class="link-caminho">Home</a> &gt; 
                    <a href="cityshare.php" class="link-caminho">City Share</a> &gt; 
                    <a href="veiculos.php" class="link-caminho">Veículos</a> &gt; 
                    <a href="categorias_veiculos.php" class="link-caminho">Categorias</a>
                </div>
                <div class="box-conteudo">
                    <div id="box-form-categoria">
                        <form class="js-modo-insert" method="post" action="#" id="form-modificacao">
                            <div class="box-label-input">
                                <label><span class="label">Nome da categoria:</span>
                                    <input class="input" type="text" name="txtNomeCategoria" />
                                </label>
                            </div>
                            <div class="box-label-input">
                                <label><span class="label">Percentual de lucro:</span>
                                    <input class="input" type="text" name="txtPercentualLucro" />
                                </label>
                            </div>
                            <div class="box-label-input">
                                <label><span class="label">Valor mínimo do veículo:</span>
                                    <input class="input" type="text" name="txtvalorMinimoVeiculo" />
                                </label>
                            </div>
                            <div class="box-label-input">
                                <label><span class="label">Tipo de veículo:</span>
                                    <select name="sltipoVeiculo">
                                        <option selected disabled>Selecione um tipo de veículo</option>
                                        <?php
                                            $listaTiposVeiculo = new \Tabela\TipoVeiculo();
                                            $listaTiposVeiculo = $listaTiposVeiculo->buscar();
                                            
                                            foreach( $listaTiposVeiculo as $tipoVeiculo ) {
                                        ?>
                                        <option value="<?php echo $tipoVeiculo->id; ?>"><?php echo $tipoVeiculo->titulo; ?></option>
                                        <?php } ?>
                                    </select>
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
                    <div id="box-listagem-categorias"></div>
                </div>
            </div>
            <?php
                include("layout/footer.php");
            ?>
        </div>      
	</body>
</html>