<?php
    require_once("include/initialize.php");
    require_once("include/classes/tbl_sobre_projeto.php");
    require_once("include/classes/tbl_home.php");
    require_once("include/classes/tbl_beneficios_projeto.php");
    require_once("include/classes/tbl_sobre_empresa.php");
    require_once("include/classes/tbl_usuario.php");
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Home | City Share</title>
        <meta name="viewport" content="width=device-width" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
        <link rel="stylesheet" href="css/style.css">
        <link rel="icon" href="img/icones/logoCityShareIcon.png">
        <style>
            .edgeLoad-EDGE-62639122 { visibility:hidden; }
        </style>
    </head>
    <body>
        <div id="container">
            <?php require_once("layout/header.php"); ?>
            <div class="main" id="pag-home">
                <div class="imagem-divisao-conteudo imagem-principal" id="banner-cityshare">
                    <video src="videos/background_cityshare2543x400.mp4" autoplay loop></video>
                </div>
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
                <div class="box-conteudo" id="box-como-funciona">
                    <section class="box-conteudo-apresentacao">
                       <?php
                            $dadosHome = new \Tabela\Home();
                            $buscaHome = $dadosHome->buscar("id = 1");
                            $dadosHome = ( !empty($buscaHome[0]) )? $buscaHome[0] : $dadosHome;
                        ?>
                        <h1 class="titulo-apresentacao"><?php echo $dadosHome->titulo; ?></h1>
                        <div id="container-animacao-como-funciona">
                            <div class="box-animacao">
                                <div id="Stage" class="EDGE-62639122"></div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="imagem-divisao-conteudo" id="banner2"></div>
                <section id="container-locadores-destaque">
                    <div id="horizontal-wrapper">
                        <?php 
                            $dadosUsuarios = new \Tabela\Usuario();
                            $limite = "";
                            
                            $listaUsuario = $dadosUsuarios->getTopUsuarios();
                            
                            for($i = 0; $i < 10; ++$i) {
                                
                                if( isset($listaUsuario[$i]) ) {
                                    $usuario = $listaUsuario[$i];   
                                } else {
                                    $usuario = new \Tabela\Usuario();
                                }
                        ?>                        
                        <section class="box-locador-destaque" <?php echo ( !isset($usuario->id) )? "style=\"opacity: 0.4;box-shadow: 0px 0px 0px black;\"" : ""; ?> >
                            <?php if( !empty($usuario->id) ) { ?>
                            <a href="perfil.php?id=<?php echo $usuario->id; ?>">
                            <?php } ?>
                                <?php if( !empty($usuario->id) ) { ?>
                                <div class="box-effect">
                                    <div class="hover-effect"></div>
                                </div>
                                <?php } ?>
                                <?php $caminhoFoto = "img/uploads/usuarios/"; ?>
                                <img class="foto-locador" src="<?php echo File::read($usuario->fotoPerfil, $caminhoFoto, "no_image.png")?>"/>
                            <?php if( !empty($usuario->id) ) { ?>
                            </a>                                                        
                            <?php } ?>
                            <h1 class="nome-locador"><?php echo ( isset($usuario->nome) )? $usuario->nome : ""; ?></h1>
                            <p class="localizacao-locador"><?php echo ( isset($usuario->estado) )? "Estado: " . $usuario->estado : ""; ?></p>
                            <div class="box-avaliacoes">
                                <p class="avaliacoes-locador"><?php echo ( isset($usuario->qtdAvaliacoes) )? "Avaliações: " . $usuario->qtdAvaliacoes : ""; ?></p>
                                <?php if( isset($usuario->mediaAvaliacao) ) { ?>
                                <div class="container-icone-avaliacoes">
                                    <?php                                                                                
                                        $lista_estrelas = [
                                            "icone-avaliacao inativa",
                                            "icone-avaliacao inativa",
                                            "icone-avaliacao inativa",
                                            "icone-avaliacao inativa",
                                            "icone-avaliacao inativa"
                                        ];
                                         
                                        $mediaNotasUsuario = round($usuario->mediaAvaliacao);                                                
                                
                                        for( $x = 0; $x < $mediaNotasUsuario; ++$x ) {
                                            $lista_estrelas[$x] = "icone-avaliacao";                           
                                        }                                                                            
                                
                                        foreach( $lista_estrelas as $classe_estrela ) {
                                            echo "<div class=\"" . $classe_estrela . "\"></div>";
                                        }                                                 
                                    ?>
                                </div>
                                <?php } ?>
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
        <script src="js/anim_edgePreload_locacao.js"></script>
        <script src="js/script.js"></script>
    </body>
</html>
