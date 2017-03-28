<?php 
    require_once("include/initialize.php");
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Home | City Share</title>
        <meta name="viewport" content="width=device-width" />
        <meta charset="utf-8" />
        <link rel="stylesheet" href="css/style.css">
        <link rel="icon" href="img/icones/logoCityShareIcon.png">
    </head>
    <body>
        <div id="container">
            <?php require_once("layout/header.php"); ?>            
            <div class="main" id="pag-home">
                <div class="imagem-divisao-conteudo imagem-principal" id="banner-cityshare"></div>
                <div class="box-conteudo">
                    <section class="box-conteudo-apresentacao conteudo-horizontal-ltr">
                       <?php 
                            $dadosProjeto = new \Tabela\SobreProjeto();
                            $buscaProjeto = $dadosProjeto->buscar("id = 1");
                            $dadosProjeto = ( !empty($buscaProjeto[0]) )? $buscaProjeto[0]:$dadosProjeto;
                        ?>
                        <h1 class="titulo-apresentacao"><?php echo $dadosProjeto->titulo; ?></h1>
                        <img class="imagem-apresentacao" src="<?php echo File::read($dadosProjeto->previaImagem, "img/uploads/conteudo/sobre_projeto"); ?>" />
                        <p class="texto-apresentacao"><?php echo $dadosProjeto->previaTexto; ?>
                            <span class="botao-exibir-mais"><a href="projeto.php">Ler mais...</a></span>
                        </p>
                    </section>
                </div>
                <div class="imagem-divisao-conteudo" id="banner1"></div>
                <div class="box-conteudo">
                    <section class="box-conteudo-apresentacao">
                       <?php 
                            $dadosHome = new \Tabela\Home();
                            $buscaHome = $dadosHome->buscar("id = 1");
                            $dadosHome = ( !empty($buscaHome[0]) )? $buscaHome[0] : $dadosHome;
                        ?>
                        <h1 class="titulo-apresentacao"><?php echo $dadosHome->titulo; ?></h1>
                        <img class="imagem-apresentacao" src="<?php echo File::read($dadosHome->imagemA, "img/uploads/conteudo/home"); ?>" />
                    </section>
                </div>
                <div class="imagem-divisao-conteudo" id="banner2"></div>                
                <section id="container-locadores-destaque">
                    <div id="horizontal-wrapper">
                        <?php for($i = 0; $i < 10; ++$i) { ?>
                        <section class="box-locador-destaque">
                            <a href="perfil.php">
                                <div class="box-effect">
                                    <div class="hover-effect"></div>
                                </div>
                                <img class="foto-locador" src="img/link_face.jpg"/>
                            </a>
                            <h1 class="nome-locador">Nome locador</h1>
                            <p class="localizacao-locador">Estado: SP</p>                        
                            <div class="box-avaliacoes">
                                <p class="avaliacoes-locador">Avaliações: 41</p>
                                <div class="container-icone-avaliacoes">
                                    <div class="icone-avaliacao"></div>
                                    <div class="icone-avaliacao"></div>
                                    <div class="icone-avaliacao"></div>
                                    <div class="icone-avaliacao"></div>
                                    <div class="icone-avaliacao"></div>
                                </div>
                            </div>
                        </section>
                        <?php } ?>
                    </div>
                </section>
                <div class="box-conteudo">
                    <section class="box-conteudo-apresentacao conteudo-horizontal-rtl">
                        <?php
                            $dadosBeneficiosProjeto = new \Tabela\BeneficiosProjeto();
                            $buscaBeneficios = $dadosBeneficiosProjeto->buscar("id = 1");
                            $dadosBeneficiosProjeto = ( !empty($buscaBeneficios[0]) )? $buscaBeneficios[0] : $dadosBeneficiosProjeto;
                        ?>
                        <h1 class="titulo-apresentacao"><?php echo $dadosBeneficiosProjeto->titulo; ?></h1>                        
                        <img class="imagem-apresentacao" src="<?php echo File::read($dadosBeneficiosProjeto->previaImagem, "img/uploads/conteudo/beneficios_projeto"); ?>" />
                        <p class="texto-apresentacao"><?php echo $dadosBeneficiosProjeto->previaTexto; ?>
                            <span class="botao-exibir-mais"><a href="beneficios.php">Ler mais...</a></span>
                        </p>
                    </section>
                </div>
                <div class="imagem-divisao-conteudo" id="banner3"></div>
                <div class="box-conteudo">
                    <section class="box-conteudo-apresentacao">
                        <?php
                            $dadosSobreEmpresa = new \Tabela\SobreEmpresa();
                            $buscaEmpresa = $dadosSobreEmpresa->buscar("id = 1");
                            $dadosSobreEmpresa = ( !empty($buscaEmpresa[0]) )? $buscaEmpresa[0] : $dadosSobreEmpresa;
                        ?>
                        <h1 class="titulo-apresentacao"><?php echo $dadosSobreEmpresa->titulo; ?></h1>
                        <p class="texto-apresentacao">
                            <?php echo $dadosSobreEmpresa->previaTexto; ?>
                            <span class="botao-exibir-mais"><a href="empresa.php">Ler mais...</a></span>
                        </p>                        
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