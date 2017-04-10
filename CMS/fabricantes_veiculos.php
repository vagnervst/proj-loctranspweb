<!DOCTYPE html>
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
    </head>
    <body>
        <div id="container">
            <?php
            include("layout/header.php");
            ?>
            <div class="CMS_main" id="pag-fabricante-veiculo">
                <div class="box-menu-lateral">
                    <div class="menu-lateral">
                        <ul>
                            <li class="botao-menu-lateral">
                                <a href="CMS_home.php">Home</a>
                                <img src="Image/50x50.gif" />
                            </li>
                            <li class="botao-menu-lateral">
                                <a href="CMS_clientes.php">Clientes</a>
                                <img src="Image/50x50.gif" />
                            </li>
                            <li class="botao-menu-lateral">
                                <a href="CMS_cityshare.php">City Share</a>
                                <img src="Image/50x50.gif" />
                            </li>
                            <li class="botao-menu-lateral">
                                <a href="#">Desktop</a>
                                <img src="Image/50x50.gif" />
                            </li>
                        </ul>
                    </div>
                </div>
                <div id="box-caminho">
                    <a href="CMS_home.php" class="link-caminho">Home</a> ><a href="CMS_cityshare.php" class="link-caminho"> City Share</a> ><a href="veiculos.php" class="link-caminho"> Veículos</a> ><a href="fabricantes_veiculos.php" class="link-caminho"> Fabricantes</a>
                </div>
                <div class="box-conteudo">
                    <div id="box-novo-registro">
                        <form class="js-modo-insert" method="post" action="#" id="form-modificacao">
                            <div class="titulo-sessao">Cadastro de fabricante</div>
                            <div id="box-campos-fabricante">
                                <div class="box-input-pagina">
                                    <label class="titulo-input">Titulo fabricante</label>
                                    <input type="text" name="txt_titulo" class="input-pagina" required>
                                </div>
                                <div id="box-tipos-veiculo">
                                    <?php
                                        $lista_tipos = new \Tabela\TipoVeiculo();
                                        $lista_tipos = $lista_tipos->buscar();
                                        
                                        foreach( $lista_tipos as $tipo ) {
                                    ?>
                                    <div class="box-tipo-veiculo">
                                        <label>
                                            <input type="checkbox" name="chkTipoVeiculo[]" value="<?php echo $tipo->id; ?>">
                                            <?php echo $tipo->titulo; ?>
                                        </label>
                                    </div>
                                    <?php
                                        }
                                    ?>
                                </div>
                                <div id="box-acoes">
                                    <span type="submit" class="preset-botao js-botao-remocao btn">Excluir</span>
                                    <div id="box-salvar-cancelar">
                                        <input type="reset" class="preset-input-submit btn" value="Cancelar" required>
                                        <input type="submit" value="Salvar" name="btn_adicionar" class="preset-input-submit btn">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="titulo-sessao"><p>Fabricantes cadastrados</p></div>
                    <div id="box-listagem-fabricantes"></div>
                </div>
            </div>
            <?php
            include("layout/footer.php");
            ?>
        </div>
    </body>
</html>