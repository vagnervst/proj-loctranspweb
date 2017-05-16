<?php
    require_once("include/functions.php");
    require_once("include/initialize.php");
    require_once("include/classes/tbl_publicacao.php");
    require_once("include/classes/tbl_usuario.php");
    require_once("include/classes/tbl_cnh.php");
    require_once("include/classes/sessao.php");

    $id_publicacao = ( isset($_GET["id"]) )? (int) $_GET["id"] : null;
        
    $info_publicacao = new \Tabela\Publicacao();
    $info_publicacao = $info_publicacao->getDetalhesPublicacao(null, null, "p.id = " . $id_publicacao)[0];        

    if( empty($info_publicacao) ) redirecionar_para("index.php");

    $id_usuario = new Sessao();
    $id_usuario = $id_usuario->get("idUsuario");  
    
    
    $info_usuario = new \Tabela\Usuario();
    if( !empty($id_usuario) ) {    
        $info_usuario = $info_usuario->buscar( "id = {$id_usuario}" )[0];
    }
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Veículo | City Share</title>
        <meta name="viewport" content="width=device-width"/>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="css/style.css">
        <link rel="icon" href="img/icones/logoCityShareIcon.png">
    </head>
    <body>
        <div id="container">
            <?php require_once("layout/header.php"); ?>            
            <div class="main" id="pag-detalhes-veiculo">
                <div id="container-modals">
                    <section class="modal js-modal1">
                        <h1 class="titulo">Dados Pessoais</h1>
                        <div class="box-label-info">
                            <p class="label">Nome:</p>
                            <p class="info"><?php echo $info_usuario->nome . " " . $info_usuario->sobrenome; ?></p>
                        </div>
                        <div class="box-label-info">
                            <p class="label">Valor do Combustível (L):</p>
                            <p class="info"><?php echo $info_publicacao->valorCombustivel; ?></p>
                        </div>
                        <div class="box-label-info">
                            <p class="label">Valor por Quilometragem Excedida:</p>
                            <p class="info"><?php echo $info_publicacao->valorQuilometragem; ?></p>
                        </div>
                        <div class="box-label-info">
                            <p class="label">Valor das Diárias:</p>
                            <p class="info" id="label-total-diarias">XXXX</p>
                        </div>
                        <div class="box-info-horizontal">
                            <div class="box-label-info">
                                <p class="label">Retirada</p>
                                <p class="info" id="label-data-retirada">XX/XX/XX XX:XX</p>
                            </div>
                            <div class="box-label-info">
                                <p class="label">Entrega</p>
                                <p class="info" id="label-data-devolucao">XX/XX/XX XX:XX</p>
                            </div>
                        </div>
                        <div class="box-label-input">
                            <label><span class="label">CNH:</span>
                                <select class="preset-input-select input" id="select-cnh">
                                    <option selected disabled>Selecione a CNH</option>
                                    <?php
                                        $lista_cnh = $info_usuario->getListaCnh();
                                        foreach( $lista_cnh as $cnh ) {
                                    ?>
                                    <option value="<?php echo $cnh->id; ?>"><?php echo $cnh->numeroRegistro; ?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </label>
                        </div>
                        <span class="preset-botao btn-avancar js-modal2" id="btn-confirmar-info">Confirmar</span>
                    </section>                    
                    <section class="modal js-modal2">
                        <div class="box-confirmacao">
                            <h1 class="titulo">Solicitação Enviada</h1>
                            <p class="descricao">Aguarde confirmação do locador</p>
                        </div>
                        <span class="preset-botao btn-avancar" id="botao-concluido">Ok</span>
                    </section>
                </div>
                <div id="slide-imagens-veiculo">
                    <span class="botao-slide" id="botao-prev"></span>
                    <span class="botao-slide" id="botao-next"></span>
                    <div id="container-imagens">       
                        <?php 
                            $info_publicacao->titulo;
                        
                        ?>
                        
                        <div class="imagem" style="background-image: url(<?php  ?>)"></div>
                        
                    </div>
                    <div id="container-contador">
                        <div class="contador"></div>
                        <div class="contador"></div>
                        <div class="contador"></div>
                        <div class="contador"></div>
                        <div class="contador"></div>
                    </div>
                    <div id="box-botao-expansao">
                        <span id="botao-expansao"></span>    
                    </div>
                </div>
                <div class="box-conteudo">                        
                    <section class="box-veiculo">                        
                        <h1 id="titulo-veiculo"><?php echo $info_publicacao->titulo; ?></h1>
                        <p id="modelo-veiculo"><?php echo $info_publicacao->modeloVeiculo; ?></p>
                        <div id="info-veiculo">
                            <div id="box-valores-veiculo">
                                <div class="box-label-valor">
                                    <p class="label">Diária:</p>
                                    <p class="valor">R$<?php echo $info_publicacao->valorDiaria; ?></p>
                                </div>
                                <div class="box-label-valor">
                                    <p class="label">Combustível (L):</p>
                                    <p class="valor">R$<?php echo $info_publicacao->valorCombustivel; ?></p>
                                </div>
                                <div class="box-label-valor">
                                    <p class="label">Valor por Distância Excedida (Km):</p>
                                    <p class="valor">R$<?php echo $info_publicacao->valorQuilometragem; ?></p>
                                </div>
                                <div class="box-label-valor" id="box-limite-distancia">
                                    <p class="label">Limite de Distância (Km):</p>
                                    <p class="valor"><?php echo $info_publicacao->limiteQuilometragem; ?></p>
                                </div>
                            </div>                            
                            <div id="box-locacao">
                                <div class="box-data">
                                    <p class="titulo">Retirada</p>
                                    <div class="box-label-data">                                    
                                        <p class="label">Data:</p>
                                        <input class="preset-input-text data-input js-mask" id="data-retirada" type="text" placeholder="DD/MM/AAAA" data-mask="DD#/DD#/DDDD" />
                                    </div>
                                    <div class="box-label-data">                                    
                                        <p class="label">Hora:</p>
                                        <input class="preset-input-text hora-input js-mask" id="hora-retirada" type="text" placeholder="HH:MM" data-mask="DD#:DD" />
                                    </div>                                
                                </div>
                                <div class="box-data">
                                    <p class="titulo">Devolução</p>
                                    <div class="box-label-data">                                    
                                        <p class="label">Data:</p>
                                        <input class="preset-input-text data-input js-mask" id="data-devolucao" type="text" placeholder="DD/MM/AAAA" data-mask="DD#/DD#/DDDD" />
                                    </div>
                                    <div class="box-label-data">
                                        <p class="label">Hora:</p>
                                        <input class="preset-input-text hora-input js-mask" id="hora-devolucao" type="text" placeholder="HH:MM" data-mask="DD#:DD" />
                                    </div>                                
                                </div>
                                <?php 
                                    if(empty($id_usuario)){
                                        ?>
                                            <a href="login.php"><span class="preset-botao" >Alugar</span></a>
                                        <?php
                                    }else{
                                        ?>
                                        <span class="preset-botao js-modal1" id="botao-alugar">Alugar</span>
                                        <?php 
                                    }
                                ?>
                                
                            </div>
                        </div>
                    </section>
                </div>
                <section id="box-previa-locador">
                    <img id="imagem-locador" src="img/image_teste.jpg" />
                    <div id="info-locador">
                        <h1 id="nome-locador"><?php echo $info_publicacao->nomeLocador . " " . $info_publicacao->sobrenomeLocador; ?></h1>
                        <div id="box-reputacao-locador">
                            <p id="label-reputacao">Reputação do locador</p>
                            <div class="container-icone-avaliacoes">
                                <div class="icone-avaliacao"></div>
                                <div class="icone-avaliacao"></div>
                                <div class="icone-avaliacao"></div>
                                <div class="icone-avaliacao"></div>
                                <div class="icone-avaliacao"></div>
                            </div>
                        </div>
                    </div>
                </section>
                <div class="box-conteudo">
                    <section class="box-veiculo">
                        <section id="box-especificacoes-veiculos">
                            <h1 id="titulo">Especificações</h1>
                            <p id="titulo-descricao">Descrição</p>
                            <p id="conteudo-descricao"><?php echo $info_publicacao->descricao; ?></p>
                            <section id="box-acessorios-veiculo">
                                <h1 id="titulo-acessorios">Acessórios</h1>
                                <ul id="lista-acessorios">
                                    <li>Item 1</li>
                                    <li>Item 2</li>
                                    <li>Item 3</li>
                                    <li>Item 4</li>
                                </ul>
                            </section>
                        </section>
                    </section>
                </div>
                <section id="container-perguntas">
                    <h1 id="titulo-container-perguntas">Perguntas</h1>
                    <div class="box-pergunta">
                        <div class="box-info">
                            <p class="titulo">Nome do Usuário</p>
                            <p class="data">01/01/01</p>
                        </div>
                        <p class="pergunta">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus odio sem, imperdiet non lacus vel, dictum venenatis mi. Cras porttitor nec orci in semper. Etiam viverra fringilla metus posuere ultricies. Nullam non ipsum sit amet nisl lobortis convallis. Pellentesque nec purus ligula. Maecenas bibendum pharetra tellus et sagittis. Cras aliquam condimentum metus, tristique dapibus felis. Proin id risus commodo, consectetur ligula sit amet, vestibulum velit. Fusce vel rutrum diam. Aliquam dolor eros, vestibulum id ipsum ac, interdum lobortis arcu. Etiam eget nibh at libero pharetra efficitur. Pellentesque libero orci, congue quis lectus at, posuere rhoncus orci. Ut urna lectus, sodales et urna nec, faucibus sodales magna.
                        </p>
                        <section class="box-resposta">                            
                            <div class="box-info">
                                <p class="titulo">Resposta do Locador</p>
                                <p class="data">01/01/01</p>
                            </div>
                            <p class="resposta">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus odio sem, imperdiet non lacus vel, dictum venenatis mi. Cras porttitor nec orci in semper. Etiam viverra fringilla metus posuere ultricies. Nullam non ipsum sit amet nisl lobortis convallis. Pellentesque nec purus ligula. Maecenas bibendum pharetra tellus et sagittis. Cras aliquam condimentum metus, tristique dapibus felis. Proin id risus commodo, consectetur ligula sit amet, vestibulum velit. Fusce vel rutrum diam. Aliquam dolor eros, vestibulum id ipsum ac, interdum lobortis arcu. Etiam eget nibh at libero pharetra efficitur. Pellentesque libero orci, congue quis lectus at, posuere rhoncus orci. Ut urna lectus, sodales et urna nec, faucibus sodales magna.
                            </p>
                        </section>
                    </div>
                    <section id="box-adicionar-pergunta">
                        <h1 id="titulo">Pergunte!</h1>
                        <div id="box-conteudo-pergunta">
                            <form method="post">
                                <textarea class="preset-input-textarea" id="conteudo-pergunta" cols="50" rows="8"></textarea>
                                <input class="preset-input-submit" id="botao-perguntar" type="submit"/>
                            </form>
                        </div>
                    </section>
                </section>
            </div>
            <!-- CONTEUDO PRINCIPAL -->
        </div>
        <?php require_once("layout/footer.php"); ?>                
        <script src="js/script.js"></script>
    </body>
</html>