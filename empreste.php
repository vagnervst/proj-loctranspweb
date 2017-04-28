<?php
    require_once("include/initialize.php");
    require_once("include/classes/tbl_empreste.php");
    
    $dadosEmpreste = new \Tabela\Empreste();
    $buscaDados = $dadosEmpreste->buscar("id = 1");
    
    if( !empty($buscaDados[0]) ) $dadosEmpreste = $buscaDados[0]; 
    
    $pasta_imagens = "img/uploads/conteudo/empreste";
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Empreste | City Share</title>
        <meta name="viewport" content="width=device-width" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="css/style.css">
        <link rel="icon" href="img/icones/logoCityShareIcon.png">
        <style>
            .edgeLoad-EDGE-135255358 { visibility:hidden; }
        </style>
    </head>
    <body>
        <div id="container">
            <?php require_once("layout/header.php"); ?>
            <div class="main" id="pag-empreste">
                <div class="imagem-divisao-conteudo imagem-principal" id="banner1"></div>
                <div class="box-conteudo">
                    <section class="box-conteudo-apresentacao">
                        <h1 class="titulo-apresentacao"><?php echo $dadosEmpreste->titulo; ?></h1>                        
                        <p class="texto-apresentacao"><?php echo $dadosEmpreste->descricao; ?></p>                        
                    </section>
                </div>
                <div class="imagem-divisao-conteudo" id="banner2"></div>
                <div class="box-conteudo" id="box-animacao">
                    <section class="box-conteudo-apresentacao">
                        <h1 class="titulo-apresentacao"><?php echo $dadosEmpreste->tituloA; ?></h1>
                        <div id="container-animacao">
                            <div id="box-animacao-como-funciona">
                                <div id="Stage" class="EDGE-135255358"></div>    
                            </div>
                        </div>
                    </section>
                </div>                
            </div>
            <!-- CONTEUDO PRINCIPAL -->
        </div>
        <?php require_once("layout/footer.php"); ?>
        <script src="js/libs/jquery-3.1.1.min.js"></script>
        <script type="text/javascript" charset="utf-8" src="js/anim_edgePreload_publicacao.js"></script>
        <script src="js/script.js"></script>
    </body>
</html>