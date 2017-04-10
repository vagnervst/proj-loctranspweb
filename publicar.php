<?php
    require_once("include/initialize.php");
    require_once("include/classes/tbl_fabricante_veiculo.php");
    require_once("include/classes/tbl_tipo_veiculo.php");
    require_once("include/classes/tbl_tipo_combustivel.php");
    require_once("include/classes/tbl_transmissao.php");
    require_once("include/classes/tbl_veiculo.php");
?>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Publicar - City Share</title>
        <meta name="viewport" content="width=device-width" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="css/style.css">
        <link rel="icon" href="img/icones/logoCityShareIcon.png">
    </head>
    <body>
        <div id="container">
            <?php require_once("layout/header.php"); ?>
            <div class="main" id="pag-publicar">
                <form method="post" action="publicar.php" enctype="multipart/form-data">
                    <div class="box-conteudo">
                        <div id="container-imagens-veiculo">
                            <div id="imagens">
                                <div id="wrapper-imagens">
                                    <div class="box-botao-imagem">
                                        <div class="imagem"></div>
                                        <h1 class="label">A Definir</h1>
                                    </div>
                                    <div class="box-botao-imagem">
                                        <div class="imagem"></div>
                                        <h1 class="label">A Definir</h1>
                                    </div>
                                    <div class="box-botao-imagem">
                                        <div class="imagem"></div>
                                        <h1 class="label">A Definir</h1>
                                    </div>
                                    <div class="box-botao-imagem">
                                        <div class="imagem"></div>
                                        <h1 class="label">A Definir</h1>
                                    </div>
                                    <div class="box-botao-imagem">
                                        <div class="imagem"></div>
                                        <h1 class="label">A Definir</h1>
                                    </div>
                                </div>
                                <div id="file-inputs">
                                    <input class="imagem-input" type="file" name="flImagem1" />
                                    <input class="imagem-input" type="file" name="flImagem2" />
                                    <input class="imagem-input" type="file" name="flImagem3" />
                                    <input class="imagem-input" type="file" name="flImagem4" />
                                    <input class="imagem-input" type="file" name="flImagem5" />
                                </div>
                            </div>
                        </div>
                        <div class="label-input">
                            <p class="label">Título</p>
                            <input class="preset-input-text" type="text" name="txtTitulo"/>
                        </div>
                        <div class="label-input">
                            <p class="label">Descrição</p>
                            <textarea class="preset-input-textarea" name="txtDescricao"></textarea>
                        </div>
                    </div>
                    <h1 class="titulo-separador">Veículo</h1>
                    <div class="box-conteudo" id="box-veiculo">
                       <div class="label-input">
                            <p class="label">Tipo</p>
                            <select class="preset-input-select js-select-tipo-veiculo" type="select" name="slFabricante">
                                <option selected disabled>Selecione um tipo</option>
                                <?php
                                    $lista_tipos = new \Tabela\TipoVeiculo();
                                    $lista_tipos = $lista_tipos->buscar();
                                    
                                    foreach($lista_tipos as $tipo) {
                                ?>
                                <option value="<?php echo $tipo->id;?>"><?php echo $tipo->titulo; ?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="label-input">
                            <p class="label">Fabricante</p>
                            <select class="preset-input-select js-select-fabricante" type="select" name="slFabricante">
                                <option selected disabled>Selecione um fabricante</option>                                
                            </select>
                        </div>
                        <div class="label-input">
                            <p class="label">Modelo</p>
                            <select class="preset-input-select js-select-veiculo" type="select" name="slModelo">
                                <option selected disabled>Selecione um modelo</option> 
                            </select>
                        </div>
                        <div class="label-input">
                            <p class="label">Tipo de Combustível</p>
                            <select class="preset-input-select js-select-combustivel" type="select" name="slCombustivel">
                                <option selected disabled>Selecione um tipo de combustível</option>                                
                            </select>
                        </div>
                        <div class="label-input">
                            <p class="label">Transmissão</p>
                            <select class="preset-input-select js-select-transmissao" type="select" name="slTransmissao">
                                <option selected disabled>Selecione um tipo de transmissão</option>                                
                            </select>
                        </div>
                        <div class="label-input">
                            <p class="label">Quilometragem</p>
                            <input class="preset-input-text" type="text" name="txtQuilometragemAtual"/>
                        </div>
                    </div>
                    <h1 class="titulo-separador">Locação</h1>
                    <div class="box-conteudo" id="box-locacao">
                        <div class="label-input">
                            <p class="label">Valor da Diária</p>
                            <input class="preset-input-text" type="text" name="txtValorDiaria"/>
                        </div>
                        <div class="label-input">
                            <p class="label">Valor do Combustível por Litro</p>
                            <input class="preset-input-text" type="text" name="txtValorCombustivel"/>
                        </div>
                        <div class="label-input">
                            <p class="label">Limite de Quilometragem</p>
                            <input class="preset-input-text" type="text" name="txtLimiteQuilometragem"/>
                        </div>
                        <div class="label-input">
                            <p class="label">Valor por Quilometragem Excedida</p>
                            <input class="preset-input-text" type="text" name="txtValorQuilometragem"/>
                        </div>
                    </div>
                    <h1 class="titulo-separador">Acessórios</h1>
                    <div class="box-conteudo">
                        <div class="label-checkbox">                        
                            <label>
                                <input type="checkbox" name="chkAcessorio[]"/>
                                <span class="label">Acessório</span>
                            </label>
                        </div>
                        <div class="label-checkbox">                        
                            <label>
                                <input type="checkbox"/>
                                <span class="label">Acessório</span>
                            </label>
                        </div>
                        <div class="label-checkbox">                        
                            <label>
                                <input type="checkbox"/>
                                <span class="label">Acessório</span>
                            </label>
                        </div>
                        <div class="label-checkbox">                        
                            <label>
                                <input type="checkbox"/>
                                <span class="label">Acessório</span>
                            </label>
                        </div>
                        <div class="label-checkbox">                        
                            <label>
                                <input type="checkbox"/>
                                <span class="label">Acessório</span>
                            </label>
                        </div>
                        <input class="preset-input-submit" id="botao-publicar" type="submit" value="Publicar" name="btnPublicar" />
                    </div>
                </form>
            </div>
            <!-- CONTEUDO PRINCIPAL -->
        </div>
        <?php require_once("layout/footer.php"); ?>
        <script src="js/libs/jquery-3.1.1.min.js"></script>
        <script src="js/script.js"></script>
    </body>
</html>