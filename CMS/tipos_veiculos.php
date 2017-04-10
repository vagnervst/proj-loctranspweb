<?php
    require_once("../include/initialize.php");
    require_once("../include/classes/tbl_tipo_veiculo.php");
    require_once("../include/classes/tbl_tipo_combustivel.php");
    require_once("../include/classes/tbl_transmissao.php");
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
                <div class="box-conteudo">
                    <div class="box-tipo-veiculo">
                        <div class="box-form-tipo">
                            <form class="js-modo-insercao" method="post" action="#" id="form-modificacao">
                                <div class="box-label-input">
                                    <label class="titulo-input"><span class="label">Tipo</span>
                                        <input class="input-pagina input" type="text" name="txtTipoVeiculo">
                                    </label>
                                </div>
                                <div id="box-lista-combustivel">
                                   <h3>Combustível</h3>
                                    <?php 
                                    $lista_combustivel = new \Tabela\TipoCombustivel();
                                    $lista_combustivel = $lista_combustivel->buscar();
                                    
                                    foreach( $lista_combustivel as $combustivel ) {
                                    ?>
                                    <div class="box-combustivel">
                                        <label>
                                            <input type="checkbox" name="chkTipoCombustivel[]" value="<?php echo $combustivel->id; ?>"/><?php echo $combustivel->nome; ?>
                                        </label>
                                    </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div id="box-lista-transmissao">
                                   <h3>Transmissão</h3>
                                    <?php 
                                    $lista_transmissao = new \Tabela\TransmissaoVeiculo();
                                    $lista_transmissao = $lista_transmissao->buscar();
                                    
                                    foreach( $lista_transmissao as $transmissao ) {
                                    ?>
                                    <div class="box-combustivel">
                                        <label>
                                            <input type="checkbox" name="chkTransmissao[]" value="<?php echo $transmissao->id; ?>"/><?php echo $transmissao->titulo; ?>
                                        </label>
                                    </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="horizontal-input-wrapper">
                                    <input class="preset-botao" id="botao-cancelar" type="reset" value="Cancelar" />
                                    <span class="preset-botao js-botao-remocao" id="botao-remover">Remover</span>
                                </div>
                                <input class="preset-botao" type="submit" name="btnAdd" value="Salvar" />
                            </form>
                        </div>
                        <div class="box-listagem-tipo"></div>
                    </div>                        
                </div>
            </div>
            <?php
                include("layout/footer.php");
            ?>
        </div>      
	</body>
</html>