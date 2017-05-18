<!DOCTYPE html>
<?php 
    require_once("../include/initialize.php");
    require_once("../include/classes/tbl_banco.php");
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
            <div class="CMS_main" id="pag-banco">
                <?php include("layout/menu.php") ?>
                <div id="box-caminho">
                    <a href="home.php" class="link-caminho">Home</a> &gt; 
                    <a href="cityshare.php" class="link-caminho">City Share</a> &gt; 
                    <a href="financeiro.php" class="link-caminho">Financeiro</a> &gt; 
                    <a href="banco.php" class="link-caminho">Bancos</a>
                </div>
                <div class="box-conteudo">
                    <div id="box-novo-registro">
                        <form class="js-modo-insert" method="post" action="#" id="form-modificacao">
                            <div class="titulo-sessao">Cadastro de Banco</div>
                            <div id="box-campos-fabricante">
                                <div class="box-input-pagina">
                                    <label class="titulo-input">Titulo Banco:</label>
                                    <input type="text" name="txt_titulo" class="input-pagina" required>
                                </div>
                                <div class="box-input-pagina">
                                    <label class="titulo-input">Codigo Banco:</label>
                                    <input type="text" name="txt_codigo" class="input-pagina" required>
                                </div>
                                 <div class="box-input-pagina">
                                    <label class="titulo-input">Quantidade de digitos verificadores:</label>
                                    <input type="text" name="txt_qtd_digitos" class="input-pagina" required>
                                </div>
                                <div id="box-acoes">
                                    <span type="submit" class="preset-botao js-botao-remocao btn">Excluir</span>
                                    <div id="box-salvar-cancelar">
                                        <input type="reset" class="preset-input-submit btn" value="Cancelar" required>
                                        <input type="submit" value="Salvar" name="btn_" class="preset-input-submit btn">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="titulo-sessao"><p>Bancos cadastrados</p></div>
                    <div id="box-listagem-bancos"></div>
                </div>
            </div>
            <?php
            include("layout/footer.php");
            ?>
        </div>
    </body>
</html>