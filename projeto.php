<?php
    require_once("include/initialize.php");
    require_once("include/classes/tbl_sobre_projeto.php");
    require_once("include/classes/file.php");

    $infoSobreProjeto = new \Tabela\SobreProjeto();
    $infoSobreProjeto = $infoSobreProjeto->buscar()[0];
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Projeto | City Share</title>
        <meta name="viewport" content="width=device-width" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="css/style.css">
        <link rel="icon" href="img/icones/logoCityShareIcon.png">
    </head>
    <body>
        <div id="container">
            <?php require_once("layout/header.php"); ?>
            <div class="main" id="pag-sobre-projeto">
                <div class="imagem-divisao-conteudo imagem-principal"></div>
                <div class="box-conteudo">
                    <section class="box-conteudo-apresentacao conteudo-horizontal-ltr">
                        <h1 class="titulo-apresentacao"><?php echo $infoSobreProjeto->titulo; ?></h1>
                        <img class="imagem-apresentacao" src="<?php echo File::read($infoSobreProjeto->imagemA, "img/uploads/conteudo/sobre_projeto"); ?>" />
                        <p class="texto-apresentacao"><?php echo $infoSobreProjeto->descricaoA; ?></p>
                    </section>
                </div>
                <div class="box-conteudo">
                    <section class="box-conteudo-apresentacao conteudo-horizontal-rtl">
                        <img class="imagem-apresentacao" src="<?php echo File::read($infoSobreProjeto->imagemB, "img/uploads/conteudo/sobre_projeto"); ?>" />
                        <p class="texto-apresentacao"><?php echo $infoSobreProjeto->descricaoB; ?></p>
                    </section>
                </div>
                <div class="box-conteudo">
                    <section class="box-conteudo-apresentacao">
                        <p class="texto-apresentacao"><?php echo $infoSobreProjeto->conteudo; ?></p>
                    </section>
                </div>
            </div>
            <!-- CONTEUDO PRINCIPAL -->
        </div>
        <?php require_once("layout/footer.php"); ?>
        <script src="js/libs/jquery-3.1.1.min.js"></script>
        <script src="js/script.js"></script>
    </body>
</html>