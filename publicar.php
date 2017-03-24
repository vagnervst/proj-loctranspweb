<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Home - City Share</title>
        <meta name="viewport" content="width=device-width" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="css/style.css">
        <link rel="icon" href="img/icones/logoCityShareIcon.png">
    </head>
    <body>
        <div id="container">
            <?php require_once("layout/header.php"); ?>
            <div class="main" id="pag-publicar">
                <form>
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
                                    <input class="imagem-input" type="file" />
                                    <input class="imagem-input" type="file" />
                                    <input class="imagem-input" type="file" />
                                    <input class="imagem-input" type="file" />
                                    <input class="imagem-input" type="file" />
                                </div>
                            </div>
                        </div>
                        <div class="label-input">
                            <p class="label">Título</p>
                            <input class="preset-input-text" type="text"/>
                        </div>
                        <div class="label-input">
                            <p class="label">Descrição</p>
                            <textarea class="preset-input-textarea"></textarea>
                        </div>
                    </div>
                    <h1 class="titulo-separador">Veículo</h1>
                    <div class="box-conteudo" id="box-veiculo">
                        <div class="label-input">
                            <p class="label">Marca</p>
                            <select class="preset-input-select" type="select">
                                <option selected disabled>Selecione uma marca</option>
                            </select>
                        </div>
                        <div class="label-input">
                            <p class="label">Modelo</p>
                            <select class="preset-input-select" type="select">
                                <option selected disabled>Selecione uma marca</option>
                            </select>
                        </div>
                        <div class="label-input">
                            <p class="label">Tipo de Combustível</p>
                            <select class="preset-input-select" type="select">
                                <option selected disabled>Selecione uma marca</option>
                            </select>
                        </div>
                        <div class="label-input">
                            <p class="label">Transmissão</p>
                            <select class="preset-input-select" type="select">
                                <option selected disabled>Selecione uma marca</option>
                            </select>
                        </div>
                        <div class="label-input">
                            <p class="label">Quilometragem</p>
                            <input class="preset-input-text" type="text"/>
                        </div>
                    </div>
                    <h1 class="titulo-separador">Locação</h1>
                    <div class="box-conteudo" id="box-locacao">
                        <div class="label-input">
                            <p class="label">Valor da Diária</p>
                            <input class="preset-input-text" type="text"/>
                        </div>
                        <div class="label-input">
                            <p class="label">Valor do Combustível por Litro</p>
                            <input class="preset-input-text" type="text"/>
                        </div>
                        <div class="label-input">
                            <p class="label">Limite de Quilometragem</p>
                            <input class="preset-input-text" type="text"/>
                        </div>
                        <div class="label-input">
                            <p class="label">Valor por Quilometragem Excedida</p>
                            <input class="preset-input-text" type="text"/>
                        </div>
                    </div>
                    <h1 class="titulo-separador">Acessórios</h1>
                    <div class="box-conteudo">
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
                        <div class="label-checkbox">                        
                            <label>
                                <input type="checkbox"/>
                                <span class="label">Acessório</span>
                            </label>
                        </div>
                        <input class="preset-input-submit" id="botao-publicar" type="submit" value="Publicar" />
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