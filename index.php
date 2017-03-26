<?php 
    require_once("include/initialize.php");
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Home | City Share</title>
        <meta name="viewport" content="width=device-width" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="css/style.css">
        <link rel="icon" href="img/icones/logoCityShareIcon.png">
    </head>
    <body>
        <div id="container">
            <?php require_once("layout/header.php"); ?>
            <div class="main" id="pag-home">
                <div class="imagem-divisao-conteudo imagem-principal"></div>
                <div class="box-conteudo">
                    <section class="box-conteudo-apresentacao conteudo-horizontal-ltr">
                        <h1 class="titulo-apresentacao">O que é?</h1>
                        <img class="imagem-apresentacao" src="img/image_teste.jpg" />
                        <p class="texto-apresentacao">
                            O City Share é um projeto da empresa de mesmo nome que consiste em um sistema de empréstimo de veículos implantado em municípios onde o usuário (físico ou jurídico) poderá disponibilizar sua bicicleta, moto ou carro o qual não utiliza ou tenha sobrando para aluguel.<br>
                            O sistema é voltado tanto para usuários que desejam alugar quanto disponibilizar para aluguel. Nele você poderá encontrar o carro perfeito para passeios ou até mesmo o carro dos seus sonhos, basta fazer uma pequena pesquisa!<br>
                            Tem algum carro parado ou obsoleto? Cadastre ele e fature um dinheiro extra com o aluguel!<br>
                            Bicicletas também são bem-vindas! Se você não usa sua bicicleta, coloque-a em nosso site, com certeza alguém fará bom uso dela, e você ainda ganha com isso!<br>
                            <br>
                            Cadastre-se agora e comece a usar o nosso sistema!
                            <span class="botao-exibir-mais"><a href="projeto.php">Ler mais...</a></span>
                        </p>
                    </section>
                </div>
                <div class="imagem-divisao-conteudo"></div>
                <div class="box-conteudo">
                    <section class="box-conteudo-apresentacao">
                        <h1 class="titulo-apresentacao">Como funciona?</h1>
                        <img class="imagem-apresentacao" src="img/image_teste.jpg" />
                    </section>
                </div>
                <div class="imagem-divisao-conteudo"></div>                
                <section id="container-locadores-destaque">
                    <div id="horizontal-wrapper">
                        <?php for($i = 0; $i < 10; ++$i) { ?>
                        <section class="box-locador-destaque">
                            <a href="perfil.php"><img class="foto-locador" src="img/link_face.jpg"/></a>
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
                        <img class="imagem-apresentacao" src="img/image_teste.jpg" />
                        <p class="texto-apresentacao"><?php echo $dadosBeneficiosProjeto->previaTexto; ?>
                            <span class="botao-exibir-mais"><a href="beneficios.php">Ler mais...</a></span>
                        </p>
                    </section>
                </div>
                <div class="imagem-divisao-conteudo"></div>
                <div class="box-conteudo">
                    <section class="box-conteudo-apresentacao">
                        <?php 
                            $dadosSobreEmpresa = new \Tabela\SobreEmpresa();
                            $dadosSobreEmpresa = $dadosSobreEmpresa->buscar("id = 1")[0];
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