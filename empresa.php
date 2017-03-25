<?php
    require_once("include/initialize.php");

    $dadosSobreEmpresa = new \Tabela\SobreEmpresa();
    $dadosSobreEmpresa = $dadosSobreEmpresa->buscar("id = 1")[0];
    $pasta_imagens = "img/uploads/conteudo/sobre_empresa";
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Empresa | City Share</title>
        <meta name="viewport" content="width=device-width"/>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="css/style.css">
        <link rel="icon" href="img/icones/logoCityShareIcon.png">
    </head>
    <body>
        <div id="container">
            <?php require_once("layout/header.php"); ?>
            <div class="main" id="pag-sobre-empresa">
                <div class="box-conteudo">
                    <section class="box-conteudo-apresentacao" id="apresentacao-empresa">
                        <h1 class="titulo-apresentacao"><?php echo $dadosSobreEmpresa->titulo; ?></h1>
                        <p class="subtitulo"><?php echo $dadosSobreEmpresa->introducao; ?></p>
                    </section>
                    <section class="box-conteudo-apresentacao box-conteudo-empresa">
                        <h1 class="titulo-empresa"><?php echo $dadosSobreEmpresa->tituloA; ?></h1>
                    </section>
                </div>
                <img class="logo-empresa" src="<?php echo File::read($dadosSobreEmpresa->imagemA, $pasta_imagens); ?>" />
                <div class="box-conteudo">
                    <section class="box-conteudo-apresentacao box-conteudo-empresa">                                                
                        <p class="texto-empresa"><?php echo $dadosSobreEmpresa->descricaoA; ?></p>
                    </section>
                </div>                
                <div class="box-conteudo">
                    <section class="box-conteudo-apresentacao box-conteudo-empresa">
                        <h1 class="titulo-empresa"><?php echo $dadosSobreEmpresa->tituloB; ?></h1>                        
                    </section>
                </div>
                <img class="logo-empresa" src="<?php echo File::read($dadosSobreEmpresa->imagemB, $pasta_imagens); ?>" />
                <div class="box-conteudo">
                    <section class="box-conteudo-apresentacao box-conteudo-empresa">
                        <p class="texto-empresa"><?php echo $dadosSobreEmpresa->descricaoB; ?></p>
                    </section>
                </div>                
            </div>
        </div>
        <?php require_once("layout/footer.php"); ?>
        <script src="js/libs/jquery-3.1.1.min.js"></script>
        <script src="js/script.js"></script>
    </body>
</html>