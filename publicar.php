<?php
    require_once("include/initialize.php");
    require_once("include/functions.php");
    require_once("include/classes/tbl_fabricante_veiculo.php");
    require_once("include/classes/tbl_tipo_veiculo.php");
    require_once("include/classes/tbl_tipo_combustivel.php");
    require_once("include/classes/tbl_transmissao.php");
    require_once("include/classes/tbl_veiculo.php");
    require_once("include/classes/tbl_publicacao.php");
    require_once("include/classes/file.php");
    require_once("include/classes/sessao.php");
    require_once("include/classes/form_validate.php");

    $publicar = ( isset($_POST["btnPublicar"]) )? $_POST["btnPublicar"] : null;

    if( isset($publicar) ) {
        $db = new \DB\Database();
        
        $imagemPrincipal = ( isset($_FILES["flImagemPrincipal"]) )? $_FILES["flImagemPrincipal"] : null;
        $imagemA = ( isset($_FILES["flImagemA"]) )? $_FILES["flImagemA"] : null;
        $imagemB = ( isset($_FILES["flImagemB"]) )? $_FILES["flImagemB"] : null;
        $imagemC = ( isset($_FILES["flImagemC"]) )? $_FILES["flImagemC"] : null;
        $imagemD = ( isset($_FILES["flImagemD"]) )? $_FILES["flImagemD"] : null;
        $titulo = ( isset($_POST["txtTitulo"]) )? mysqli_real_escape_string( $db->conexao, $_POST["txtTitulo"] ) : null;
        $descricao = ( isset($_POST["txtDescricao"]) )? mysqli_real_escape_string( $db->conexao, $_POST["txtDescricao"] ) : null;
        $id_tipo = ( isset($_POST["slTipo"]) )? $_POST["slTipo"] : null;
        $id_fabricante = ( isset($_POST["slFabricante"]) )? $_POST["slFabricante"] : null;
        $id_modelo = ( isset($_POST["slModelo"]) )? (int) $_POST["slModelo"] : null;
        $id_combustivel = ( isset($_POST["slCombustivel"]) )? $_POST["slCombustivel"] : null;
        $id_transmissao = ( isset($_POST["slTransmissao"]) )? $_POST["slTransmissao"] : null;
        $quilometragemAtual = ( isset($_POST["txtQuilometragemAtual"]) )? mysqli_real_escape_string( $db->conexao, $_POST["txtQuilometragemAtual"] ) : null;
        $valorDiaria = ( isset($_POST["txtValorDiaria"]) )? mysqli_real_escape_string( $db->conexao, $_POST["txtValorDiaria"] ) : null;
        $valorCombustivel = ( isset($_POST["txtValorCombustivel"]) )? mysqli_real_escape_string( $db->conexao, $_POST["txtValorCombustivel"] ) : null;
        $limiteQuilometragem = ( isset($_POST["txtLimiteQuilometragem"]) )? mysqli_real_escape_string( $db->conexao, $_POST["txtLimiteQuilometragem"] ) : null;
        $valorQuilometragem = ( isset($_POST["txtValorQuilometragem"]) )? mysqli_real_escape_string( $db->conexao, $_POST["txtValorQuilometragem"] ) : null;
        $acessorios = ( isset($_POST["chkAcessorio"]) )? $_POST["chkAcessorio"] : null;
            
        $lista_required_input = [];
        $lista_required_input[] = $titulo;
        $lista_required_input[] = $descricao;
        $lista_required_input[] = $id_tipo;
        $lista_required_input[] = $id_fabricante;
        $lista_required_input[] = $id_modelo;
        $lista_required_input[] = $id_combustivel;
        $lista_required_input[] = $id_transmissao;
        $lista_required_input[] = $quilometragemAtual;
        $lista_required_input[] = $valorDiaria;
        $lista_required_input[] = $valorCombustivel;
        $lista_required_input[] = $limiteQuilometragem;
        $lista_required_input[] = $valorQuilometragem;
        $lista_required_input[] = $acessorios;
        
        if( !FormValidator::has_empty_input( $lista_required_input ) ) {
            $publicacao = new \Tabela\Publicacao();
                        
            $publicacao->titulo = $titulo;
            $publicacao->descricao = $descricao;
            $publicacao->valorDiaria = $valorDiaria;
            $publicacao->valorCombustivel = $valorCombustivel;
            $publicacao->valorQuilometragem = $valorQuilometragem;
            $publicacao->quilometragemAtual = $quilometragemAtual;
            $publicacao->limiteQuilometragem = $limiteQuilometragem;            
            $publicacao->dataPublicacao = get_data_atual();
            $publicacao->idVeiculo = $id_modelo;
            
            $status_publicacao_pendente = 3;
            $publicacao->idStatusPublicacao = $status_publicacao_pendente;
            
            $sessao = new Sessao();
                                    
            $publicacao->idUsuario = (int) $sessao->get("idUsuario");
            
            $id_publicacao = $publicacao->inserir();
            
            if( !empty($id_publicacao) ) {
                $publicacao->id = $id_publicacao;
                
                $caminho = "img/uploads/publicacoes";                
                
                $nome_arquivo_principal = "post_" . $id_publicacao . "_imagem_principal." . end( explode( ".", $imagemPrincipal["name"] ) );
                if( File::upload( $imagemPrincipal["tmp_name"], $nome_arquivo_principal, $caminho ) ) {
                    $publicacao->imagemPrincipal = $nome_arquivo_principal;
                }
                
                $nome_arquivo_a = "post_" . $id_publicacao . "_imagem_a." . end( explode( ".", $imagemA["name"] ) );
                if( File::upload( $imagemA["tmp_name"], $nome_arquivo_a, $caminho ) ) {
                    $publicacao->imagemA = $nome_arquivo_a;
                }
                
                $nome_arquivo_b = "post_" . $id_publicacao . "_imagem_b." . end( explode( ".", $imagemB["name"] ) );
                if( File::upload( $imagemB["tmp_name"], $nome_arquivo_b, $caminho ) ) {
                    $publicacao->imagemB = $nome_arquivo_b;
                }
                
                $nome_arquivo_c = "post_" . $id_publicacao . "_imagem_c." . end( explode( ".", $imagemC["name"] ) );
                if( File::upload( $imagemC["tmp_name"], $nome_arquivo_c, $caminho ) ) {
                    $publicacao->imagemC = $nome_arquivo_c;
                }
                
                $nome_arquivo_d = "post_" . $id_publicacao . "_imagem_d." . end( explode( ".", $imagemD["name"] ) );
                if( File::upload( $imagemD["tmp_name"], $nome_arquivo_d, $caminho ) ) {
                    $publicacao->imagemD = $nome_arquivo_d;
                }
                
                $publicacao->atualizar();
            }
        }
    }
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
                                    <div id="imagem-principal">
                                        <p id="label">Principal</p>
                                        <div class="box-botao-imagem">
                                            <div class="imagem"></div>
                                            <h1 class="label">A Definir</h1>
                                        </div>
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
                                    <input class="imagem-input" type="file" name="flImagemPrincipal" />
                                    <input class="imagem-input" type="file" name="flImagemA" />
                                    <input class="imagem-input" type="file" name="flImagemB" />
                                    <input class="imagem-input" type="file" name="flImagemC" />
                                    <input class="imagem-input" type="file" name="flImagemD" />
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
                    <div id="wrapper-info-veiculo">
                        <section class="box-info-veiculo">
                            <h1 class="titulo">Veículo</h1>
                            <div id="box-veiculo">
                               <div class="label-input">
                                    <p class="label">Tipo</p>
                                    <select class="preset-input-select js-select-tipo-veiculo" type="select" name="slTipo">
                                        <option selected disabled>Selecione um tipo</option>
                                        <?php
                                            $lista_tipos = new \Tabela\TipoVeiculo();
                                            $lista_tipos = $lista_tipos->buscar("visivel = 1");

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
                        </section>
                        <section class="box-info-locacao">
                            <h1 class="titulo">Locação</h1>
                            <div id="box-locacao">
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
                        </section>
                    </div>
                    <h1 class="titulo-separador">Acessórios</h1>
                    <div class="box-conteudo">
                        <div class="box-acessorios"></div>
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