<?php
    require_once("include/initialize.php");
    require_once("include/classes/tbl_veiculo.php");
    require_once("include/classes/tbl_publicacao.php");

    $pesquisa = ( isset($_POST["txtPesquisa"]) )? $_POST["txtPesquisa"] : null;
    $dadosPublicacao = new \Tabela\Publicacao();
    $pagina_atual = ( isset($_GET['p']) )? $_GET["p"] : 1;
    $itens_por_pagina = 10;

    if( isset($_POST["btnBuscar"]) ) {
        $listaPublicacao = $dadosPublicacao->getPublicacaoPaginacao( $itens_por_pagina, $pagina_atual, " p.titulo LIKE '%{$pesquisa}%' OR p.descricao LIKE '%{$pesquisa}%' " );
    } else {
        $listaPublicacao = $dadosPublicacao->getPublicacaoPaginacao( $itens_por_pagina, $pagina_atual );
    }

    if( isset($_POST["btnFiltrar"]) ) {
        
    }
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Alugue | City Share</title>
        <meta name="viewport" content="width=device-width" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="css/style.css">
        <link rel="icon" href="img/icones/logoCityShareIcon.png">
    </head>
    <body>
        <div id="container">
            <?php $contexto = "alugue"; ?>
            <?php require_once("layout/header.php"); ?>
            <section class="js-popup-painel painel-mobile" id="box-mobile-filtragem">
                <h1 id="titulo">Filtragem</h1>
                <form method="post" action="#">                    
                    <div class="box-opcoes-select">
                        <p class="label">Estado</p>
                        <select class="preset-input-select select">
                            <option>Estado</option>
                        </select>
                    </div>
                    <div class="box-opcoes-select">
                        <p class="label">Cidade</p>
                        <select class="preset-input-select select">
                            <option>Cidade</option>
                        </select>
                    </div>
                    <div class="box-opcoes-select">
                        <p class="label">Tipo de Transporte</p>
                        <select class="preset-input-select select">
                            <option>Bicicleta</option>
                        </select>
                    </div>
                    <div class="box-filtragem-valor">
                        <p class="label">Valor da Diária</p>
                        <div class="box-valores">
                            <p class="label-intervalo">De:</p>
                            <input class="preset-input-text txt-valor" type="text" />
                            <p class="label-intervalo">A:</p>
                            <input class="preset-input-text txt-valor" type="text" />
                        </div>
                        <div class="box-ordem">
                            <label>
                                <input class="opcao-ordem" type="radio" name="rdoOrdem"/>
                                <span class="label-ordem">Crescente</span>
                            </label>                        
                            <label>
                                <input class="opcao-ordem" type="radio" name="rdoOrdem"/>
                                <span class="label-ordem">Decrescente</span>
                            </label>
                        </div>
                    </div>
                    <div class="box-filtragem-valor">
                        <p class="label">Valor do Combustível</p>
                        <div class="box-valores">
                            <p class="label-intervalo">De:</p>
                            <input class="preset-input-text txt-valor" type="text" />
                            <p class="label-intervalo">A:</p>
                            <input class="preset-input-text txt-valor" type="text" />
                        </div>
                    </div>
                    <div class="box-filtragem-valor">
                        <p class="label">Quilometragem do Veículo</p>
                        <div class="box-valores">
                            <p class="label-intervalo">De:</p>
                            <input class="preset-input-text txt-valor" type="text" />
                            <p class="label-intervalo">A:</p>
                            <input class="preset-input-text txt-valor" type="text" />
                        </div>
                    </div>
                    <div class="box-filtragem-valor">
                        <p class="label">Limite de Distância</p>
                        <div class="box-valores">
                            <p class="label-intervalo">De:</p>
                            <input class="preset-input-text txt-valor" type="text" />
                            <p class="label-intervalo">A:</p>
                            <input class="preset-input-text txt-valor" type="text" />
                        </div>
                    </div>
                    <div class="box-opcoes-select">
                        <p class="label">Avaliação Mínima</p>
                        <select class="preset-input-select select">
                            <option>0</option>
                        </select>
                    </div>
                    <input class="preset-input-submit botao-submit" name="btnFiltrar" type="submit" value="Filtrar" />
                </form>
            </section>
            <!-- MENU DE FILTRAGEM - MOBILE -->
            <div class="main" id="pag-listagem-veiculos">                
                <div class="box-conteudo">
                    <div id="box-pesquisa">
                        <form method="post" action="#">
                            <input class="preset-input-text " id="texto-pesquisa" name="txtPesquisa" type="text" placeholder="Pesquisar..." />
                            <input class="preset-input-submit " id="botao-pesquisa" name="btnBuscar" type="submit" value="Buscar" />
                        </form>
                    </div>
                    <div id="lista-veiculos">
                        <?php
                                                        
                            foreach( $listaPublicacao as $publicacao ) { 
                        ?>
                        <section class="box-veiculo">
                            <a href="veiculo.php?id=<?php echo $publicacao->id; ?>"><img class="imagem-veiculo" src="img/image_teste.jpg" /></a>
                            <div class="box-info-veiculo">                                
                                <h1 class="titulo-veiculo"><?php echo $publicacao->titulo; ?></h1>
                                <div class="box-valor-diaria">
                                    <p class="valor-diaria">R$<?php echo $publicacao->valorDiaria; ?>
                                        <span class="label-diaria">diária</span>
                                    </p>
                                </div>
                            </div>
                            <p class="modelo-veiculo"><?php echo $publicacao->modeloVeiculo; ?></p>
                            <div class="box-info-valores">
                                <p class="valor-combustivel">Valor do Combustível</p>
                                <p class="valor">R$<?php echo $publicacao->valorCombustivel; ?></p>
                                <p class="valor-quilometragem">Valor por Quilometragem Excedida</p>
                                <p class="valor">R$<?php echo $publicacao->valorQuilometragem; ?></p>
                            </div>
                            <div class="box-avaliacoes">
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
                    <div id="box-paginas">
                        <div id="box-botoes-mobile">
                            <div class="box-botoes-pagina" id="box-botoes-prev">
                                <a class="preset-botao botao-pagina" id="link-pagina-prev" href="#">Anterior</a>
                                <div id="box-primeira-pagina">
                                    <a class="preset-botao botao-pagina" href="#">Primeira</a>
                                </div>
                            </div>
                            <div id="box-numero-paginas">
                                <p id="label-pagina-atual">1</p>
                                <p id="label-total-paginas">1</p>
                            </div>
                            <div class="box-botoes-pagina" id="box-botoes-next">
                                <a class="preset-botao botao-pagina" id="link-pagina-next" href="#">Próxima</a>
                                <div id="box-ultima-pagina">
                                    <a class="preset-botao botao-pagina" href="#">Última</a>
                                </div>
                            </div>
                        </div>
                        <div id="box-botoes-desktop">
                            <a class="preset-botao botao-pagina" href="#">Primeira</a>
                            <a class="preset-botao botao-pagina" href="#">Anterior</a>
                            <p id="pagina-atual"><?php echo $pagina_atual; ?> |</p>
                            <p id="total-paginas"><?php echo "";?></p>
                            <a class="preset-botao botao-pagina" href="#">Próxima</a>
                            <a class="preset-botao botao-pagina" href="#">Ultima</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- CONTEUDO PRINCIPAL -->
        </div>
        <footer>
            <div id="box-rodape">
                <section id="box-mapa-site">
                    <h1>Mapa do Site</h1>
                    <ul id="lista-paginas">
                        <li><a href="index.html">Home</a></li>
                        <li><a href="alugue.html">Alugue</a></li>
                        <li><a href="empreste.html">Empreste</a></li>
                        <li><a href="projeto.html">Sobre o Projeto</a></li>
                        <li><a href="beneficios.html">Benefícios do Projeto</a></li>
                        <li><a href="empresa.html">A Empresa</a></li>
                        <li><a href="contato.html">Contato</a></li>
                    </ul>
                </section>
                <p id="declaracao-copyright">&copy; City Share 2017 Cityshare.com.br - Todos os Direitos Reservados</p>
            </div>
        </footer>
        <!-- RODAPÉ -->
        <script src="js/libs/jquery-3.1.1.min.js"></script>
        <script src="js/script.js"></script>
    </body>
</html>