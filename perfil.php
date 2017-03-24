<!doctype html>
<html>
    <head>
        <title>Perfil de "NomeUsuário" |City Share</title>
        <meta name="viewport" content="width=device-width" />
        <meta charset="utf-8" />
        <link rel="stylesheet" href="css/style.css">
        <link rel="icon" href="img/icones/logoCityShareIcon.png">
    </head>
    <body>
        <div id="container">
            <?php require_once("layout/header.php"); ?>
            <div class="main" id="pag-perfil-usuario">
                <div class="box-conteudo">
                    <div id="box-info-usuario">
                        <div id="box-info-pessoal-usuario">
                            <div id="box-foto">
                                <img id="foto-usuario" src="img/link_face.jpg"/>
                            </div>
                            <section id="box-info">
                                <h1 id="nome">Nome Completo</h1>
                                <p class="label-info">Localização: <span class="info">SP, Cidade</span></p>
                                <p class="label-info">Empréstimos: <span class="info">XX</span></p>
                                <p class="label-info">Locações: <span class="info">XX</span></p>
                                <div class="container-icone-avaliacoes">
                                    <div class="icone-avaliacao"></div>
                                    <div class="icone-avaliacao"></div>
                                    <div class="icone-avaliacao"></div>
                                    <div class="icone-avaliacao"></div>
                                    <div class="icone-avaliacao"></div>
                                </div>
                            </section>
                        </div>                        
                    </div>
                    <section id="box-info-publicacoes">
                        <h1 id="titulo">Publicações</h1>
                        <div id="container-publicacoes">
                            <div class="box-publicacao">
                                <a href="#">
                                    <div class="foto-publicacao"></div>
                                </a>
                                <section class="box-info-publicacao">
                                    <h1 class="titulo">Titulo publicação</h1>
                                    <p class="modelo-veiculo">Modelo do Veículo</p>
                                    <div class="box-diaria">
                                        <p class="diaria">R$00,00</p>
                                        <p class="label-diaria">diária</p>
                                    </div>
                                </section>                                
                            </div>
                            <div class="box-publicacao">
                                <a href="#">
                                    <div class="foto-publicacao"></div>
                                </a>
                                <section class="box-info-publicacao">
                                    <h1 class="titulo">Titulo publicação</h1>
                                    <p class="modelo-veiculo">Modelo do Veículo</p>
                                    <div class="box-diaria">
                                        <p class="diaria">R$00,00</p>
                                        <p class="label-diaria">diária</p>
                                    </div>
                                </section>                                
                            </div>
                        </div>
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