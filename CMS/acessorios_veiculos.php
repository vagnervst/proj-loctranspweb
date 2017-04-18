 <?php 
    require_once("../include/initialize.php");
    require_once("../include/classes/tbl_tipo_veiculo.php");
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
                <?php include("layout/menu.php") ?>
                <div id="box-caminho">
                    <a href="CMS_home.php" class="link-caminho" >Home</a> ><a href="cityshare.php" class="link-caminho"> City Share</a> ><a href="veiculos.php" class="link-caminho"> Veículos</a> ><a href="acessorios_veiculos.php" class="link-caminho"> Acessórios</a>
                </div>
                <div class="box-conteudo">
                    <div id="box-novo-registro" >
                        <div class="titulo-sessao">Cadastro de acessório</div>
                        <div id="box-campos-acessorio">
                            <form id="form-modificacao-acessorio" method="post" action="#">
                                <div class="box-label-input">
                                    <label>
                                        <span class="label">Titulo acessorio</span>
                                        <input class="input" id="titulo-input" type="text" name="txtTitulo">
                                    </label>                                    
                                </div>
                                <div id="box-tipos-veiculo">
                                    <?php
                                        $lista_tipo_veiculo = new \Tabela\TipoVeiculo();
                                        $lista_tipo_veiculo = $lista_tipo_veiculo->buscar();
                                        foreach( $lista_tipo_veiculo as $tipo_veiculo ) {
                                    ?>
                                    <div class="box-label-input">
                                        <label>
                                            <input type="checkbox" name="chkTipoVeiculo[]" value="<?php echo $tipo_veiculo->id; ?>" />
                                            <span class="label-checkbox"><?php echo $tipo_veiculo->titulo; ?></span>
                                        </label>
                                    </div>
                                    <?php
                                        }
                                    ?>
                                </div>
                                <div id="botoes-acao">
                                    <span class="preset-botao botao js-botao-remocao" type="submit" name="btn_adicionar">Excluir</span>
                                    <div id="box-cancelar-adicionar">                                
                                        <input class="preset-input-submit botao" type="reset" name="btn_adicionar" value="Cancelar"/>
                                        <input class="preset-input-submit botao" type="submit" value="Salvar" name="btn_adicionar">
                                    </div>
                                </div>
                            </form>
                        </div>                        
                    </div>                    
                    <div id="box-listagem-acessorios"></div>
                </div>
            </div>
            <?php
                include("layout/footer.php");
            ?>
        </div>      
	</body>
</html>