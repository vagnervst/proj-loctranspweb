<?php
    require_once("include/initialize.php");
    require_once("include/classes/tbl_veiculo.php");
    require_once("include/classes/tbl_publicacao.php");
    require_once("include/classes/tbl_estado.php");
    require_once("include/classes/tbl_cidade.php");
    require_once("include/classes/tbl_tipo_veiculo.php");
    require_once("include/classes/tbl_usuario.php");

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
        
        $estado = isset( $_POST["slEstado"] )? $_POST["slEstado"] : null;
        $cidade = isset( $_POST["slCidade"] )? $_POST["slCidade"] : null;
        $tipoVeiculo = isset( $_POST["slTipoVeiculo"] )? $_POST["slTipoVeiculo"] : null;
        $vlDiariaMinimo = isset( $_POST["vlDiariaMinimo"] )? $_POST["vlDiariaMinimo"] : null;
        $vlDiariaMaximo = isset( $_POST["vlDiariaMaximo"] )? $_POST["vlDiariaMaximo"] : null;
        $ordem = isset( $_POST["rdoOrdem"] )? $_POST["rdoOrdem"] : null;
        $vlCombustivelMinimo = isset( $_POST["vlCombustivelMinimo"] )? $_POST["vlCombustivelMinimo"] : null;
        $vlCombustivelMaximo = isset( $_POST["vlCombustivelMaximo"] )? $_POST["vlCombustivelMaximo"] : null;
        $vlQuilometragemMinimo = isset( $_POST["vlQuilometragemMinimo"] )? $_POST["vlQuilometragemMinimo"] : null;
        $vlQuilometragemMaximo = isset( $_POST["vlQuilometragemMaximo"] )? $_POST["vlQuilometragemMaximo"] : null;
        $limiteDistanciaMinimo = isset( $_POST["limiteDistanciaMinimo"] )? $_POST["limiteDistanciaMinimo"] : null;
        $limiteDistanciaMaximo = isset( $_POST["limiteDistanciaMaximo"] )? $_POST["limiteDistanciaMaximo"] : null;
        $avaliacaoMinima = isset( $_POST["slAvaliacaoMinima"] )? $_POST["slAvaliacaoMinima"] : null;
        
        $whereValorDiaria = " p.valorDiaria BETWEEN {$vlDiariaMinimo} AND {$vlDiariaMaximo} ";
        $whereValorCombustivel = " p.valorCombustivel BETWEEN {$vlCombustivelMinimo} AND {$vlCombustivelMaximo} ";
        $whereValorQuilometragem = " p.valorQuilometragem BETWEEN {$vlQuilometragemMinimo} AND {$vlQuilometragemMaximo} ";
        $whereLimiteDistancia = " p.limiteQuilometragem BETWEEN {$limiteDistanciaMinimo} AND {$limiteDistanciaMaximo} ";
        $whereAvaliacaoMinima = " (SELECT (SUM(av.nota)/(SELECT COUNT(id) FROM tbl_avaliacao WHERE idUsuarioAvaliado = u.id))) <= {$avaliacaoMinima} ";
        $whereEstado = " c.idEstado = {$estado} ";
        $whereCidade = " u.idCidade = {$cidade} ";
        $whereTipoVeiculo = " tp.id = {$tipoVeiculo} ";
        
        if( $ordem == "crescente" ) {
            
            $ordem = " p.valorDiaria ASC ";
            
        } else {
            
            $ordem = " p.valorDiaria DESC ";
            
        }
        
        $where = "";
        $listaWhere = [];
        if( $vlDiariaMinimo != null and $vlDiariaMaximo != null ) { $listaWhere[] = $whereValorDiaria; }
        if( $vlCombustivelMinimo != null and $vlCombustivelMaximo != null ) { $listaWhere[] = $whereValorCombustivel; }
        if( $vlQuilometragemMinimo != null and $vlQuilometragemMaximo != null ) { $listaWhere[] = $whereValorQuilometragem; }
        if( $limiteDistanciaMinimo != null and $limiteDistanciaMaximo != null ) { $listaWhere[] = $whereLimiteDistancia; }
        if( $avaliacaoMinima != null ) { $listaWhere[] = $whereAvaliacaoMinima; }
        if( $estado != null ) { $listaWhere[] = $whereEstado; }
        if( $cidade != null ) { $listaWhere[] = $whereCidade; }
        if( $tipoVeiculo != null ) { $listaWhere[] = $whereTipoVeiculo; }
        
        for( $i = 0; $i < count($listaWhere); ++$i ) {
            if( $i == 0 ) {
                $where .= " {$listaWhere[$i]} ";
            } else {
                $where .= " AND {$listaWhere[$i]} ";
            }
        }
        
        $listaPublicacao = $dadosPublicacao->getDetalhesPublicacao( $itens_por_pagina, $pagina_atual, " {$where} ORDER BY {$ordem} " );
        
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
                        <select class="preset-input-select select" name="slEstado">
                            <option class="option" selected disabled>Selecione..</option>
                            <?php
                                $buscaEstado = new \Tabela\Estado();
                                $listaEstado = $buscaEstado->buscar();
                            
                                for( $i = 0; $i < count($listaEstado); ++$i ) {
                            ?>
                            <option class="option" value="<?php echo $listaEstado[$i]->id; ?>"><?php echo $listaEstado[$i]->nome; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="box-opcoes-select">
                        <p class="label">Cidade</p>
                        <select class="preset-input-select select" name="slCidade">
                            <option selected disabled>Selecione..</option>
                            <?php 
                                $buscaCidade = new \Tabela\Cidade();
                                $listaCidade = $buscaCidade->buscar();
                            
                                for( $i = 0; $i < count($listaCidade); ++$i ) {
                            ?>
                            <option value="<?php echo $listaCidade[$i]->id; ?>"><?php echo $listaCidade[$i]->nome; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="box-opcoes-select">
                        <p class="label">Tipo de Transporte</p>
                        <select class="preset-input-select select" name="slTipoVeiculo">
                            <option selected disabled>Selecione..</option>
                            <?php
                                $buscaTipoVeiculo = new \Tabela\TipoVeiculo();
                                $listaTipoVeiculo = $buscaTipoVeiculo->buscar();
                            
                                for( $i = 0; $i < count($listaTipoVeiculo); ++$i ) {
                            ?>
                            <option value="<?php echo $listaTipoVeiculo[$i]->id; ?>"><?php echo $listaTipoVeiculo[$i]->titulo; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="box-filtragem-valor">
                        <p class="label">Valor da Diária</p>
                        <div class="box-valores">
                            <p class="label-intervalo">De:</p>
                            <input class="preset-input-text txt-valor" type="text" name="vlDiariaMinimo" />
                            <p class="label-intervalo">A:</p>
                            <input class="preset-input-text txt-valor" type="text" name="vlDiariaMaximo" />
                        </div>
                        <div class="box-ordem">
                            <label>
                                <input class="opcao-ordem" type="radio" name="rdoOrdem" value="crescente"/>
                                <span class="label-ordem">Crescente</span>
                            </label>                        
                            <label>
                                <input class="opcao-ordem" type="radio" name="rdoOrdem" value="decrescente"/>
                                <span class="label-ordem">Decrescente</span>
                            </label>
                        </div>
                    </div>
                    <div class="box-filtragem-valor">
                        <p class="label">Valor do Combustível</p>
                        <div class="box-valores">
                            <p class="label-intervalo">De:</p>
                            <input class="preset-input-text txt-valor" type="text" name="vlCombustivelMinimo"/>
                            <p class="label-intervalo">A:</p>
                            <input class="preset-input-text txt-valor" type="text" name="vlCombustivelMaximo"/>
                        </div>
                    </div>
                    <div class="box-filtragem-valor">
                        <p class="label">Quilometragem do Veículo</p>
                        <div class="box-valores">
                            <p class="label-intervalo">De:</p>
                            <input class="preset-input-text txt-valor" type="text" name="vlQuilometragemMinimo"/>
                            <p class="label-intervalo">A:</p>
                            <input class="preset-input-text txt-valor" type="text" name="vlQuilometragemMaximo"/>
                        </div>
                    </div>
                    <div class="box-filtragem-valor">
                        <p class="label">Limite de Distância</p>
                        <div class="box-valores">
                            <p class="label-intervalo">De:</p>
                            <input class="preset-input-text txt-valor" type="text" name="limiteDistanciaMinimo"/>
                            <p class="label-intervalo">A:</p>
                            <input class="preset-input-text txt-valor" type="text" name="limiteDistanciaMaximo"/>
                        </div>
                    </div>
                    <div class="box-opcoes-select">
                        <p class="label">Avaliação Mínima</p>
                        <select class="preset-input-select select" name="slAvaliacaoMinima">
                            <option selected disabled>Selecione..</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
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
                            $dadosPublicacao = new \Tabela\Publicacao();
                            $pagina_atual = ( isset($_GET['p']) )? $_GET["p"] : 1;
                            $itens_por_pagina = 10;
                            
                            $listaPublicacao = $dadosPublicacao->getPublicacaoPaginacao( $itens_por_pagina, $pagina_atual, "p.idStatusPublicacao = 1" );
                            
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
                    <?php if( count($listaPublicacao) > 0 ) { ?>
                    <?php
                        $totalPaginas = $listaPublicacao[0]->totalPublicacoes / $itens_por_pagina;
                        var_dump($listaPublicacao[0]);
    
                        $proxima_pagina = ( ($pagina_atual + 1) > $totalPaginas )? $pagina_atual + 1 : $pagina_atual;
                        $pagina_anterior = ( ($pagina_atual - 1) > 0 )? $pagina_atual - 1 : $pagina_atual;
                    ?>
                    <div id="box-paginas">
                        <div id="box-botoes-mobile">
                            <div class="box-botoes-pagina" id="box-botoes-prev">
                                <a class="preset-botao botao-pagina" id="link-pagina-prev" href="alugue.php?p=<?php echo $pagina_anterior; ?>">Anterior</a>
                                <div id="box-primeira-pagina">
                                    <a class="preset-botao botao-pagina" href="alugue.php?p=1">Primeira</a>
                                </div>
                            </div>
                            <div id="box-numero-paginas">
                                <p id="label-pagina-atual"><?php echo $pagina_atual; ?></p>
                                <p id="label-total-paginas"><?php echo $totalPaginas; ?></p>
                            </div>
                            <div class="box-botoes-pagina" id="box-botoes-next">
                                <a class="preset-botao botao-pagina" id="link-pagina-next" href="alugue.php?p=<?php echo $proxima_pagina; ?>">Próxima</a>
                                <div id="box-ultima-pagina">
                                    <a class="preset-botao botao-pagina" href="alugue.php?p=<?php echo $totalPaginas; ?>">Última</a>
                                </div>
                            </div>
                        </div>
                        <div id="box-botoes-desktop">
                            <a class="preset-botao botao-pagina" href="alugue.php?p=1">Primeira</a>
                            <a class="preset-botao botao-pagina" href="alugue.php?p=<?php echo $pagina_anterior; ?>">Anterior</a>
                            <p id="pagina-atual"><?php echo $pagina_atual; ?> |</p>                                                    
                            <p id="total-paginas"><?php echo $totalPaginas; ?></p>
                            <a class="preset-botao botao-pagina" href="alugue.php?p=<?php echo $proxima_pagina; ?>">Próxima</a>
                            <a class="preset-botao botao-pagina" href="alugue.php?p=<?php echo $totalPaginas; ?>">Ultima</a>
                        </div>
                    </div>
                    <?php } ?>
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