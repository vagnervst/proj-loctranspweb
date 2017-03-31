<?php
    require_once("../include/initialize.php");
    require_once("../include/classes/tbl_veiculo.php");
    require_once("../include/classes/tbl_transmissao.php");
    require_once("../include/classes/tbl_fabricante_veiculo.php");
    require_once("../include/classes/tbl_tipo_combustivel.php");
    require_once("../include/classes/tbl_tipo_veiculo.php");
    require_once("../include/classes/tbl_categoria_veiculo.php");    
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>
            CMS - Veículos | City Share
		</title>
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
                    <div id="box-veiculos">
                        <div id="box-form-veiculo">
                            <form class="js-modo-insercao" id="form-info-veiculo" method="post" action="#">
                                <div class="box-label-input" id="box-nome">
                                    <label><span class="label">Nome</span>
                                        <input class="input" type="text" name="txtNome"/>
                                    </label>
                                </div>
                                <div class="horizontal-input-wrapper">
                                    <div class="box-label-input">
                                        <label><span class="label">Portas</span>
                                            <input class="input" type="text" name="txtPortas"/>
                                        </label>
                                    </div>
                                    <div class="box-label-input">
                                        <label><span class="label">Motor</span>
                                            <input class="input" type="text" name="txtMotor"/>
                                        </label>
                                    </div>
                                    <div class="box-label-input">
                                        <label><span class="label">Ano</span>
                                            <input class="input" type="text" name="txtAno"/>
                                        </label>
                                    </div>
                                    <div class="box-label-input" id="box-transmissao">
                                        <label><span class="label">Transmissão</span>
                                            <select class="input" name="slTransmissao">
                                                <option selected disabled>Selecione a transmissão</option>
                                                <?php
                                                    $listaTransmissoes = new \Tabela\TransmissaoVeiculo();
                                                    $listaTransmissoes = $listaTransmissoes->buscar();
                                                
                                                    foreach( $listaTransmissoes as $transmissao ) {
                                                ?>
                                                <option value="<?php echo $transmissao->id;?>"><?php echo $transmissao->titulo;?></option>
                                                <?php } ?>
                                            </select>
                                        </label>
                                    </div>
                                </div>
                                <div class="horizontal-input-wrapper" id="box-detalhes">
                                    <div class="box-label-input" id="box-preco">
                                        <label><span class="label">Preço Médio</span>
                                            <input class="input" type="text" name="txtPrecoMedio"/>
                                        </label>
                                    </div>
                                    <div class="box-label-input">
                                        <label><span class="label">Fabricante</span>
                                            <select class="input" name="slFabricante">
                                                <option selected disabled>Selecione o fabricante</option>
                                                <?php
                                                    $listaFabricante = new \Tabela\FabricanteVeiculo();
                                                    $listaFabricante = $listaFabricante->buscar();
                                                
                                                    foreach($listaFabricante as $fabricante) {
                                                ?>
                                                <option value="<?php echo $fabricante->id;?>"><?php echo $fabricante->nome;?></option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                        </label>
                                    </div>
                                    <div class="box-label-input">
                                        <label><span class="label">Combustível</span>
                                            <select class="input" name="slCombustivel">
                                                <option selected disabled>Selecione o combustível</option>
                                                <?php
                                                    $listaCombustivel = new \Tabela\TipoCombustivel();
                                                    $listaCombustivel = $listaCombustivel->buscar();
                                                
                                                    foreach($listaCombustivel as $combustivel) {
                                                ?>
                                                <option value="<?php echo $combustivel->id;?>"><?php echo $combustivel->nome;?></option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                        </label>
                                    </div>
                                </div>
                                <div class="horizontal-input-wrapper" id="box-filtragem">
                                    <h1 class="titulo">Filtragem</h1>                                    
                                    <div class="box-label-input">
                                        <label><span class="label">Tipo</span>
                                            <select class="input" name="slTipo">
                                                <option selected disabled>Selecione o tipo</option>
                                                <?php
                                                    $listaTipoVeiculo = new \Tabela\TipoVeiculo();
                                                    $listaTipoVeiculo = $listaTipoVeiculo->buscar();
                                                
                                                    foreach($listaTipoVeiculo as $tipoVeiculo) {
                                                ?>
                                                <option value="<?php echo $tipoVeiculo->id; ?>"><?php echo $tipoVeiculo->titulo; ?></option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                        </label>
                                    </div>
                                    <div class="box-label-input">
                                        <label><span class="label">Categoria</span>
                                            <select class="input" name="slCategoria">
                                                <option selected disabled>Selecione a categoria</option>
                                                <?php
                                                    $listaCategoriaVeiculo = new \Tabela\CategoriaVeiculo();
                                                    $listaCategoriaVeiculo = $listaCategoriaVeiculo->buscar();
                                                
                                                    foreach($listaCategoriaVeiculo as $categoriaVeiculo) {
                                                ?>
                                                <option value="<?php echo $categoriaVeiculo->id; ?>"><?php echo $categoriaVeiculo->nome; ?></option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                        </label>
                                    </div>                                    
                                </div>
                                <div class="horizontal-input-wrapper" id="box-acoes">                                    
                                    <span class="preset-botao botao" id="botao-remover">Remover</span>
                                    <div class="box-salvar-cancelar">                                        
                                        <input class="preset-botao botao" id="botao-cancelar" type="reset" value="Cancelar" />                                        
                                        <input class="preset-input-submit botao" type="submit" name="btnSubmit" value="Salvar" />
                                    </div>
                                </div>
                            </form>                         
                        </div>
                        <div id="box-filtragem-veiculos">
                           <form method="post" action="#">
                                <div class="horizontal-input-wrapper">
                                    <div class="box-label-input" id="box-cod">
                                        <label><span class="label">cod</span>
                                            <input class="input" type="text" name="txtCod"/>
                                        </label>
                                    </div>
                                    <div class="box-label-input" id="box-preco-medio">
                                        <label><span class="label">Preço Médio Mínimo</span>
                                            <input class="input" type="text" name="txtPrecoMinimo"/>
                                        </label>
                                    </div>
                                    <div class="box-label-input">
                                        <label><span class="label">Tipo</span>
                                            <select class="input" name="slTipo">
                                                <option selected></option>
                                                <?php                                                                                                    
                                                    foreach($listaTipoVeiculo as $tipoVeiculo) {
                                                ?>
                                                <option value="<?php echo $tipoVeiculo->id; ?>"><?php echo $tipoVeiculo->titulo; ?></option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                        </label>
                                    </div>
                                    <div class="box-label-input">
                                        <label><span class="label">Fabricante</span>
                                            <select class="input" name="slFabricante">
                                                <option selected></option>
                                                <?php
                                                    foreach($listaFabricante as $fabricante) {
                                                ?>
                                                <option value="<?php echo $fabricante->id;?>"><?php echo $fabricante->nome;?></option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                        </label>
                                    </div>
                                </div>
                                <div class="horizontal-input-wrapper">
                                    <div class="box-label-input" id="box-nome">
                                        <label><span class="label">Nome</span>
                                            <input class="input" type="text" name="txtNome"/>
                                        </label>
                                    </div>
                                    <div class="box-label-input">
                                        <label><span class="label">Categoria</span>
                                            <select class="input" name="slCategoria">
                                                <option selected></option>
                                                <?php
                                                    foreach($listaCategoriaVeiculo as $categoriaVeiculo) {
                                                ?>
                                                <option value="<?php echo $categoriaVeiculo->id; ?>"><?php echo $categoriaVeiculo->nome; ?></option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                        </label>
                                    </div>
                                    <div class="box-label-input">
                                        <label><span class="label">Combustível</span>
                                            <select class="input" name="slCombustivel">
                                                <option selected></option>
                                                <?php
                                                    foreach($listaCombustivel as $combustivel) {
                                                ?>
                                                <option value="<?php echo $combustivel->id;?>"><?php echo $combustivel->nome;?></option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                        </label>
                                    </div>
                                </div>
                                <input class="preset-input-submit" id="botao-buscar" type="submit" name="btnBuscar" value="Buscar"/>
                            </form>
                        </div>
                        <div id="box-listagem-veiculos"></div>
                    </div>                    
                </div>
            </div>
            <?php
                include("layout/footer.php");
            ?>
        </div>      
	</body>
</html>