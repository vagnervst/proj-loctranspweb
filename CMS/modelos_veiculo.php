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
                <?php include("layout/menu.php") ?>
                <div id="box-caminho">
                    <a href="home.php" class="link-caminho">Home</a> &gt;
                    <a href="cityshare.php" class="link-caminho">City Share</a> &gt;
                    <a href="veiculos.php" class="link-caminho"> Veículos</a> &gt;
                    <a href="modelos_veiculo.php" class="link-caminho" >Modelos</a>
                </div>
                <div class="box-conteudo">                    
                    <div id="box-veiculos">
                        <div id="box-form-veiculo">
                            <form class="js-modo-insert" id="form-info-veiculo" method="post" action="#">
                                <div class="box-label-input" id="box-cod">
                                    <label><span class="label">Cod</span>
                                        <input class="input" type="text" name="txtCod"/>
                                    </label>
                                </div>
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
                                    <div class="box-label-input">
                                        <label><span class="label">Tanque (litros)</span>
                                            <input class="input" type="text" name="txtTanque"/>
                                        </label>
                                    </div>                                    
                                    <div class="box-label-input" id="box-transmissao">
                                        <label><span class="label">Transmissão</span>
                                            <select id="slTransmissao" class="input" name="slTransmissao">
                                                <option selected disabled>Selecione a transmissão</option>
                                            </select>
                                        </label>
                                    </div>
                                </div>
                                <div class="horizontal-input-wrapper" id="box-detalhes">                                    
                                    <div class="box-label-input">
                                        <label><span class="label">Fabricante</span>
                                            <select id="slFabricante" class="input" name="slFabricante">
                                                <option selected disabled>Selecione o fabricante</option>
                                            </select>
                                        </label>
                                    </div>
                                    <div class="box-label-input">
                                        <label><span class="label">Combustível</span>
                                            <select id="slCombustivel" class="input" name="slCombustivel">
                                                <option selected disabled>Selecione o combustível</option>
                                            </select>
                                        </label>
                                    </div>
                                </div>
                                <div class="horizontal-input-wrapper" id="box-filtragem">
                                    <h1 class="titulo">Filtragem</h1>                                    
                                    <div class="box-label-input">
                                        <label><span class="label">Tipo</span>
                                            <select id="slTipoVeiculo" class="input" name="slTipo">
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
                                            <select id="slCategoriaVeiculo" class="input" name="slCategoria">
                                                <option selected disabled>Selecione uma Categoria</option>
                                            </select>
                                        </label>
                                    </div>                                    
                                </div>
                                <div class="horizontal-input-wrapper" id="box-acoes">                                    
                                    <span class="preset-botao botao js-botao-remocao" id="botao-remover">Remover</span>
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
                                                <option selected disabled>Selecione um tipo</option>
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
                                                <option selected disabled>Selecione um fabricante</option>
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