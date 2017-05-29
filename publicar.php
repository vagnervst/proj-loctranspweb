<?php
    require_once("include/initialize.php");
    require_once("include/functions.php");
    require_once("include/classes/tbl_usuario.php");
    require_once("include/classes/tbl_plano_conta.php");
    require_once("include/classes/tbl_fabricante_veiculo.php");
    require_once("include/classes/tbl_tipo_veiculo.php");
    require_once("include/classes/tbl_tipo_combustivel.php");
    require_once("include/classes/tbl_transmissao.php");
    require_once("include/classes/tbl_veiculo.php");
    require_once("include/classes/tbl_publicacao.php");
    require_once("include/classes/file.php");
    require_once("include/classes/sessao.php");
    require_once("include/classes/form_validate.php");
    
    $sessao = new Sessao();
    $idUsuario = $sessao->get("idUsuario");
    $dadosUsuario = new \Tabela\Usuario();
    $dadosUsuario = $dadosUsuario->getDetalhesUsuario(" u.id = {$idUsuario} ")[0];
    
    $planoConta = new \Tabela\PlanoConta();
    $planoConta = $planoConta->getPlanos(null, null, " p.id = {$dadosUsuario->idPlanoConta} ")[0];

    $dadosPublicacao = new \Tabela\Publicacao();
    $modo = isset( $_GET["modo"] )? $_GET["modo"] : null;
    $idPublicacao = isset( $_GET["idPublicacao"] )? $_GET["idPublicacao"] : null;
    
    $txtBotao = "Publicar";
    
    $link = "";
    $editar = false;

    if( $modo == "editar" ) {
        
        $link = "?modo=editar";
        $txtBotao = "Atualizar";
        $editar = true;
        
        $dadosPublicacao = $dadosPublicacao->getDetalhesPublicacao(" u.id = {$idUsuario}  AND p.id = {$idPublicacao} ")[0];
        $titulo = $dadosPublicacao->titulo;
        $descricao = $dadosPublicacao->descricao;
        $quilometragemAtual = $dadosPublicacao->quilometragemAtual;
        $valorVeiculo = $dadosPublicacao->valorVeiculo;
        $valorDiaria = $dadosPublicacao->valorDiaria;
        $valorCombustivel = $dadosPublicacao->valorCombustivel;
        $limiteQuilometragem = $dadosPublicacao->limiteQuilometragem;
        $valorQuilometragem = $dadosPublicacao->valorQuilometragem;
        
        
    } else {
        
        $dadosPublicacao = $dadosPublicacao->getPublicacao(" u.id = {$idUsuario} ");
        $titulo = null;
        $descricao = null;
        $quilometragemAtual = null;
        $valorVeiculo = null;
        $valorDiaria = null;
        $valorCombustivel = null;
        $limiteQuilometragem = null;
        $valorQuilometragem = null;
    }

    $disabled = false;

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
        $valorVeiculo = ( isset($_POST["txtValorVeiculo"]) )? mysqli_real_escape_string( $db->conexao, $_POST["txtValorVeiculo"] ) : null;
        $acessorios = ( isset($_POST["chkAcessorio"]) )? $_POST["chkAcessorio"] : null;
            
        $lista_required_input = [];
        $lista_required_input[] = $titulo;        
        $lista_required_input[] = $id_tipo;        
        $lista_required_input[] = $id_modelo;                
        $lista_required_input[] = $quilometragemAtual;
        $lista_required_input[] = $valorDiaria;
        $lista_required_input[] = $valorCombustivel;
        $lista_required_input[] = $limiteQuilometragem;
        $lista_required_input[] = $valorQuilometragem;
        $lista_required_input[] = $valorVeiculo;
        $lista_required_input[] = $acessorios;                                                        
        
        if( !FormValidator::has_empty_input( $lista_required_input ) ) {
                
            $publicacao = new \Tabela\Publicacao();                            
            $publicacao->titulo = $titulo;
            $publicacao->descricao = $descricao;
            $publicacao->valorDiaria = (double) $valorDiaria;
            $publicacao->valorCombustivel = (double) $valorCombustivel;
            $publicacao->valorQuilometragem = (double) $valorQuilometragem;
            $publicacao->valorVeiculo = (double) $valorVeiculo;
            $publicacao->quilometragemAtual = (int) $quilometragemAtual;
            $publicacao->limiteQuilometragem = (int) $limiteQuilometragem;         
            $publicacao->dataPublicacao = get_data_atual_mysql();
            $publicacao->idVeiculo = (int) $id_modelo;
            $publicacao->disponivelOnline = 1;
            
            $status_publicacao_pendente = 3;
            $publicacao->idStatusPublicacao = $status_publicacao_pendente;
            
            $sessao = new Sessao();
                                    
            $publicacao->idUsuario = (int) $sessao->get("idUsuario");
            
            if( !$editar ) {
                
                $id_publicacao = $publicacao->inserir();
                
            } else {
                $id_publicacao = $publicacao->atualizar();
            
            }
            
            if( !empty($id_publicacao) ) {
                $publicacao->id = $id_publicacao;
                
                $caminho = "img/uploads/publicacoes";
                                
                $nome_arquivo_principal = "post_" . $id_publicacao . "_imagem_principal." . pathinfo( $imagemPrincipal["name"], PATHINFO_EXTENSION );                
                if( File::upload( $imagemPrincipal, $nome_arquivo_principal, $caminho ) ) {
                    $publicacao->imagemPrincipal = $nome_arquivo_principal;
                }
                
                $nome_arquivo_a = "post_" . $id_publicacao . "_imagem_a." . pathinfo( $imagemA["name"], PATHINFO_EXTENSION );
                if( File::upload( $imagemA, $nome_arquivo_a, $caminho ) ) {
                    $publicacao->imagemA = $nome_arquivo_a;
                }
                
                $nome_arquivo_b = "post_" . $id_publicacao . "_imagem_b." . pathinfo( $imagemB["name"], PATHINFO_EXTENSION );
                if( File::upload( $imagemB, $nome_arquivo_b, $caminho ) ) {
                    $publicacao->imagemB = $nome_arquivo_b;
                }
                
                $nome_arquivo_c = "post_" . $id_publicacao . "_imagem_c." . pathinfo( $imagemC["name"], PATHINFO_EXTENSION );
                if( File::upload( $imagemC, $nome_arquivo_c, $caminho ) ) {
                    $publicacao->imagemC = $nome_arquivo_c;
                }
                
                $nome_arquivo_d = "post_" . $id_publicacao . "_imagem_d." . pathinfo( $imagemD["name"], PATHINFO_EXTENSION );
                if( File::upload( $imagemD, $nome_arquivo_d, $caminho ) ) {
                    $publicacao->imagemD = $nome_arquivo_d;
                }
                
                
                $publicacao->atualizar(" id = {$idPublicacao} ");
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
                <form method="post" action="publicar.php<?php echo $link; ?>" enctype="multipart/form-data">
                    <div class="box-conteudo">
                        <?php 
                                                
                        if( count($dadosPublicacao) >= $planoConta->limitePublicacao ) {
                            $disabled = true;                           
                        ?>
                        <div id="box-limite-atingido">
                            <p>Você atingiu o seu limite de publicações!</p>
                        </div>
                        <?php } ?>
                        <?php                                     
                            if( !$disabled ) {
                        ?>
                        <div id="container-imagens-veiculo">
                            <div id="imagens">
                                <div id="wrapper-imagens">
                                    <div id="imagem-principal">
                                        <p id="label">Principal</p>
                                        <div class="box-botao-imagem">
                                            <?php if( $editar ) { ?>
                                            <div class="imagem" style="background-image: url('<?php echo $dadosPublicacao->imagemPrincipal; ?>')" ></div>
                                            <?php } else { ?>
                                            <div class="imagem"></div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="box-botao-imagem">
                                        <div class="imagem"></div>                                        
                                    </div>
                                    <div class="box-botao-imagem">
                                        <div class="imagem"></div>                                        
                                    </div>
                                    <div class="box-botao-imagem">
                                        <div class="imagem"></div>                                        
                                    </div>
                                    <div class="box-botao-imagem">
                                        <div class="imagem"></div>                                        
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
                        <?php } ?>
                        <div class="label-input">
                            <p class="label">Título</p>
                            <input class="preset-input-text" type="text" name="txtTitulo" <?php echo ( $disabled )? "disabled" : ""; ?> value="<?php echo $titulo; ?>"/>
                        </div>
                        <div class="label-input">
                            <p class="label">Descrição</p>
                            <textarea class="preset-input-textarea" name="txtDescricao" <?php echo ( $disabled )? "disabled" : ""; ?>><?php echo $descricao; ?></textarea>
                        </div>
                    </div>
                    <div id="wrapper-info-veiculo">
                        <section class="box-info-veiculo">
                            <h1 class="titulo">Veículo</h1>
                            <div id="box-veiculo">
                               <div class="label-input">
                                    <p class="label">Tipo</p>
                                    <select class="preset-input-select js-select-tipo-veiculo" type="select" name="slTipo" <?php echo ( $disabled )? "disabled" : ""; ?>>
                                        <?php if( $editar ) { ?>
                                        
                                        <option selected><?php echo $dadosPublicacao->tipoVeiculo; ?></option>
                                        
                                        <?php } else {?>
                                        
                                        <option selected disabled>Selecione um tipo</option>
                                        
                                        <?php } ?>
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
                                    <select class="preset-input-select js-select-fabricante" type="select" name="slFabricante" <?php echo ( $disabled )? "disabled" : ""; ?>>
                                        <?php if( $editar  ) { ?>
                                        <option selected><?php echo $dadosPublicacao->fabricante; ?></option>
                                        <?php } else { ?>
                                        <option selected disabled>Selecione um fabricante</option>
                                        <?php } ?>
                                    </select>
                                </div>                                
                                <div class="label-input">
                                    <p class="label">Tipo de Combustível</p>
                                    <select class="preset-input-select js-select-combustivel" type="select" name="slCombustivel" <?php echo ( $disabled )? "disabled" : ""; ?>>
                                        <?php if( $editar  ) { ?>
                                        <option selected><?php echo $dadosPublicacao->combustivel; ?></option>
                                        <?php } else { ?>
                                        <option selected disabled>Selecione um tipo de combustível</option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="label-input">
                                    <p class="label">Transmissão</p>
                                    <select class="preset-input-select js-select-transmissao" type="select" name="slTransmissao" <?php echo ( $disabled )? "disabled" : ""; ?>>
                                        <?php if( $editar  ) { ?>
                                        <option selected><?php echo $dadosPublicacao->trasmissao; ?></option>
                                        <?php } else { ?>
                                        <option selected disabled>Selecione um tipo de transmissão</option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="label-input">
                                    <p class="label">Portas</p>
                                    <select class="preset-input-select js-select-portas" type="select" name="slTransmissao" <?php echo ( $disabled )? "disabled" : ""; ?>>
                                        <option selected disabled>Selecione a quantidade de portas</option>
                                        <option>0</option>
                                        <option>2</option>
                                        <option>4</option>                                        
                                    </select>
                                </div>
                                <div class="label-input">
                                    <p class="label">Modelo</p>
                                    <select class="preset-input-select js-select-veiculo" type="select" name="slModelo" <?php echo ( $disabled )? "disabled" : ""; ?>>
                                        <?php if( $editar  ) { ?>
                                        <option selected><?php echo $dadosPublicacao->modeloVeiculo; ?></option>
                                        <?php } else { ?>
                                        <option selected disabled>Selecione um modelo</option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="label-input">
                                    <p class="label">Quilometragem</p>
                                    <input class="preset-input-text" type="text" name="txtQuilometragemAtual" <?php echo ( $disabled )? "disabled" : ""; ?> value="<?php echo $quilometragemAtual; ?>" />
                                </div>
                                <div class="label-input">
                                    <p class="label">Valor do Veículo</p>
                                    <input class="preset-input-text" type="text" name="txtValorVeiculo" <?php echo ( $disabled )? "disabled" : ""; ?> value="<?php echo $valorVeiculo; ?>"/>
                                </div>
                            </div>
                        </section>
                        <section class="box-info-locacao">
                            <h1 class="titulo">Locação</h1>
                            <div id="box-locacao">
                                <div class="label-input">
                                    <p class="label">Valor da Diária</p>
                                    <input class="preset-input-text" type="text" name="txtValorDiaria" <?php echo ( $disabled )? "disabled" : ""; ?> value="<?php echo $valorDiaria; ?>"/>
                                </div>
                                <div class="label-input">
                                    <p class="label">Valor do Combustível por Litro</p>
                                    <input class="preset-input-text" type="text" name="txtValorCombustivel" <?php echo ( $disabled )? "disabled" : ""; ?> value="<?php echo $valorCombustivel; ?>"/>
                                </div>
                                <div class="label-input">
                                    <p class="label">Limite de Quilometragem</p>
                                    <input class="preset-input-text" type="text" name="txtLimiteQuilometragem" <?php echo ( $disabled )? "disabled" : ""; ?> value="<?php echo $limiteQuilometragem; ?>"/>
                                </div>
                                <div class="label-input">
                                    <p class="label">Valor por Quilometragem Excedida</p>
                                    <input class="preset-input-text" type="text" name="txtValorQuilometragem" <?php echo ( $disabled )? "disabled" : ""; ?> value="<?php echo ($valorQuilometragem); ?>" />
                                </div>
                            </div>
                        </section>
                    </div>
                    <?php
                            if( !$disabled ) {
                        ?>
                    <h1 class="titulo-separador">Acessórios</h1>
                    <div class="box-conteudo">
                        <div class="box-acessorios"></div>                        
                        <input class="preset-input-submit" id="botao-publicar" type="submit" value="<?php echo $txtBotao ?>" name="btnPublicar" />
                    </div>
                    <?php } ?>
                </form>
            </div>
            <!-- CONTEUDO PRINCIPAL -->
        </div>
        <?php require_once("layout/footer.php"); ?>
        <script src="js/libs/jquery-3.1.1.min.js"></script>
        <script src="js/script.js"></script>
    </body>
</html>