<?php
    require_once("include/initialize.php");
    require_once("include/classes/tbl_beneficios_projeto.php");

    $dadosBeneficiosProjeto = new \Tabela\BeneficiosProjeto();
    $buscaDados = $dadosBeneficiosProjeto->buscar("id = 1");
    
    if( !empty($buscaDados[0]) ) $dadosBeneficiosProjeto = $buscaDados[0]; 
    
    $pasta_imagens = "img/uploads/conteudo/beneficios_projeto";
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Benefícios | City Share</title>
        <meta name="viewport" content="width=device-width" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="css/style.css">
        <link rel="icon" href="img/icones/logoCityShareIcon.png">
    </head>
    <body>
        <div id="container">
            <?php require_once("layout/header.php"); ?>
            <div class="main" id="pag-beneficios-projeto">                
                <div class="box-conteudo">
                    <section class="box-conteudo-apresentacao">
                        <h1 class="titulo-apresentacao"><?php echo $dadosBeneficiosProjeto->titulo; ?></h1>
                        <h2 class="subtitulo-apresentacao"><?php echo $dadosBeneficiosProjeto->introducao; ?></h2>
                    </section>
                </div>
                <div class="box-conteudo">
                    <section class="box-conteudo-apresentacao conteudo-horizontal-ltr">
                        <img class="imagem-apresentacao" src="<?php echo File::read($dadosBeneficiosProjeto->imagemA, $pasta_imagens); ?>" />
                        <!-- benefícios proprietário -->
                        <p class="texto-apresentacao"><?php echo $dadosBeneficiosProjeto->descricaoA; ?></p>
                    </section>
                </div>
                <div class="box-conteudo">
                    <section class="box-conteudo-apresentacao conteudo-horizontal-ltr">
                        <img class="imagem-apresentacao" src="<?php echo File::read($dadosBeneficiosProjeto->imagemB, $pasta_imagens); ?>" />
                        <!-- benefícios usuário -->
                        <p class="texto-apresentacao"><?php echo $dadosBeneficiosProjeto->descricaoB; ?></p>
                    </section>
                </div>
                <div class="box-conteudo">
                    <section class="box-conteudo-apresentacao conteudo-horizontal-ltr">
                        <img class="imagem-apresentacao" src="<?php echo File::read($dadosBeneficiosProjeto->imagemC, $pasta_imagens); ?>" />
                        <!-- benefícios gerais -->
                        <p class="texto-apresentacao"><?php echo $dadosBeneficiosProjeto->descricaoC; ?></p>
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