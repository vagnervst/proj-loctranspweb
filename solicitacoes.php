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
            <div class="main" id="pag-solicitacoes">
                <div id="container-modo-visualizacao">
                    <div id="box-botoes">
                        <span class="preset-botao botao">Pedidos</span>
                        <span class="preset-botao botao">Solicitações</span>
                    </div>
                </div>
                <div class="box-conteudo">
                    <div id="box-filtragem">
                        <select class="preset-input-select" id="select-status" name="slStatus">
                            <option selected disabled>Filtrar</option>
                        </select>
                    </div>
                    <div id="box-listagem">
                       <?php for($i = 0; $i < 10; ++$i) { ?>
                        <div class="box-pedido">
                            <div class="wrapper-box-info">
                                <div class="box-foto-info">
                                    <div class="box-foto">
                                        <a href="#"><img class="foto-pedido" src="" /></a>
                                    </div>
                                    <div class="box-info">
                                        <p class="valor-diaria">R$XX,XX</p>
                                        <p class="modelo-veiculo">Modelo Veículo</p>
                                        <div class="box-icone-data">
                                            <img class="icone" src="" />
                                            <p class="data">XX/XX/XX XX:XX</p>
                                        </div>
                                        <div class="box-icone-data">
                                            <img class="icone" src="" />
                                            <p class="data">XX/XX/XX XX:XX</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-info-locador">
                                    <div class="info-locador">
                                        <p class="status">Status</p>
                                        <p class="nome-locador">Nome Locador</p>
                                        <div class="box-avaliacoes">
                                            <div class="container-icone-avaliacoes">
                                                <div class="icone-avaliacao"></div>
                                                <div class="icone-avaliacao"></div>
                                                <div class="icone-avaliacao"></div>
                                                <div class="icone-avaliacao"></div>
                                                <div class="icone-avaliacao"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>                                                        
                        </div>
                        <div class="box-solicitacao">
                            <div class="wrapper-box-info">
                                <div class="box-foto-info">
                                    <div class="box-foto">
                                        <a href="#"><img class="foto-pedido" src="" /></a>
                                    </div>
                                    <div class="box-info">
                                        <p class="valor-diaria">R$XX,XX</p>
                                        <p class="modelo-veiculo">Modelo Veículo</p>
                                        <div class="box-icone-data">
                                            <img class="icone" src="" />
                                            <p class="data">XX/XX/XX XX:XX</p>
                                        </div>
                                        <div class="box-icone-data">
                                            <img class="icone" src="" />
                                            <p class="data">XX/XX/XX XX:XX</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-info-locatario">
                                    <div class="info-locatario">
                                        <p class="nome-locatario">Nome Locatario</p>
                                        <p class="localizacao-locatario">SP, cidade</p>
                                        <div class="box-avaliacoes">                                            
                                            <div class="container-icone-avaliacoes">
                                                <div class="icone-avaliacao"></div>
                                                <div class="icone-avaliacao"></div>
                                                <div class="icone-avaliacao"></div>
                                                <div class="icone-avaliacao"></div>
                                                <div class="icone-avaliacao"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box-acoes">
                                        <div class="box-botoes">
                                            <span class="preset-botao botao">Aceitar</span>
                                            <span class="preset-botao botao">Recusar</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <div id="box-paginas">
                            <span class="preset-botao botao-pagina">Anterior</span>
                            <p class="numero-paginas">1 - 5</p>                            
                            <span class="preset-botao botao-pagina">Próxima</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- CONTEUDO PRINCIPAL -->
        </div>
        <?php require_once("layout/footer.php"); ?>
        <script src="js/libs/jquery-3.1.1.min.js"></script>
        <script src="js/script.js"></script>
    </body>
</html>