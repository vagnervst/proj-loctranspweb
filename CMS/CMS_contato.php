<?php 
    require_once("../include/initialize.php"); 
    $dadosFaleConosco = new \Tabela\FaleConosco();
    $buscaDados = $dadosFaleConosco->buscar("id = 1");
    
    if( !empty($buscaDados[0]) ) $dadosFaleConosco = $buscaDados[0]; 

    $formSubmit = ( isset($_POST["formSubmit"]) )? $_POST["formSubmit"] : null;
    
    if( !empty($formSubmit) ) {                
        $titulo = ( isset( $_POST["txtTituloA"] ) )? $_POST["txtTituloA"] : null;
        $descricao = ( isset( $_POST["txtDescricao"] ) )? $_POST["txtDescricao"] : null;
        $tituloPerguntas = ( isset( $_POST["txtTituloB"] ) )? $_POST["txtTituloB"] : null;
        $email = ( isset( $_POST["txtEmail"] ) )? $_POST["txtEmail"] : null;
        $telefone = ( isset( $_POST["txtTelefone"] ) )? $_POST["txtTelefone"] : null;
        $atendimento = ( isset( $_POST["txtAtendimento"] ) )? $_POST["txtAtendimento"] : null;
        $endereco = ( isset( $_POST["txtEndereco"] ) )? $_POST["txtEndereco"] : null;
        
        $listaRequiredInputs = [];
        $listaRequiredInputs[] = $titulo;
        $listaRequiredInputs[] = $descricao;
        $listaRequiredInputs[] = $tituloPerguntas;
        $listaRequiredInputs[] = $email;
        $listaRequiredInputs[] = $telefone;
        $listaRequiredInputs[] = $atendimento;
        $listaRequiredInputs[] = $endereco;
        
        if( !FormValidator::has_empty_input( $listaRequiredInputs ) ) {
            $objFaleConosco = new \Tabela\FaleConosco();
            
            $objFaleConosco->tituloA = $titulo;
            $objFaleConosco->descricaoA = $descricao;
            $objFaleConosco->tituloB = $tituloPerguntas;
            $objFaleConosco->email = $email;
            $objFaleConosco->telefone = $telefone;
            $objFaleConosco->horarioAtendimento = $atendimento;
            $objFaleConosco->endereco = $endereco;
            
            if( empty($buscaDados[0]) ) {                
                $objFaleConosco->inserir();
            } else {                
                $objFaleConosco->id = 1;
                $objFaleConosco->atualizar();
            }
        }
        
        redirecionar_para("CMS_contato.php");
    }
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>
            CMS - Conteúdo | City Share
		</title>
        <link rel="stylesheet" type="text/css" href="CSS/Style.css">
	</head>
	<body>
        <div id="container">
            <?php
                include("layout/header.php");
            ?>
            <div class="CMS_main" id="pag-cityshare-contato">
                <div class="box-menu-lateral">
                     <div class="menu-lateral">
                        <ul>
                            <li class="botao-menu-lateral">
                                <a href="CMS_home.php">Home</a>
                                <img src="Image/50x50.gif"/>
                            </li>
                            <li class="botao-menu-lateral">
                                <a href="CMS_clientes.php">Clientes</a>
                                <img src="Image/50x50.gif"/>
                            </li>
                            <li class="botao-menu-lateral">
                                <a href="CMS_cityshare.php">City Share</a>
                                <img src="Image/50x50.gif"/>
                            </li>
                            <li class="botao-menu-lateral">
                                <a href="#">Desktop</a>
                                <img src="Image/50x50.gif"/>
                            </li>
                        </ul>
                    </div>
                </div>
                <div id="box-caminho">
                    <a href="CMS_home.php" class="link-caminho" >Home</a> &gt; <a href="CMS_cityshare.php" class="link-caminho"> City Share</a> &gt; <a href="CMS_cityshare_conteudo.php" class="link-caminho">Conteúdo</a> &gt; <a href="CMS_contato.php" class="link-caminho" >Contato</a>
                </div>
                <div class="box-conteudo">
                    <div class="titulo-sesssao">
                        Fale conosco
                    </div>
                    <div id="container-fale-conosco">
                       <form method="post" action="CMS_contato.php">
                            <div class="box-input-pagina">
                                <label class="titulo-input">Título</label>
                                <input type="text" class="input-pagina" name="txtTituloA" value="<?php echo $dadosFaleConosco->tituloA;?>" required />
                            </div>
                            <div class="box-input-pagina">
                                <label class="titulo-input">Descrição</label>
                                <input type="text" class="input-pagina" name="txtDescricao" value="<?php echo $dadosFaleConosco->descricaoA;?>" required />
                            </div>
                            <div class="item-fale-conosco">
                                <div class="titulo-input">
                                    Email
                                </div>
                                <input type="text" class="input-pagina" name="txtEmail" value="<?php echo $dadosFaleConosco->email;?>" required />
                            </div>
                            <div class="item-fale-conosco">
                                <div class="titulo-input">
                                    Telefone
                                </div>
                                <input type="text" class="input-pagina" name="txtTelefone" value="<?php echo $dadosFaleConosco->telefone;?>" required />
                            </div>
                            <div class="item-fale-conosco">
                                <div class="titulo-input">
                                    Atendimento
                                </div>
                                <input type="text" class="input-pagina" name="txtAtendimento" value="<?php echo $dadosFaleConosco->horarioAtendimento;?>" required />
                            </div>
                            <div class="item-fale-conosco">
                                <div class="titulo-input">
                                    Endereço
                                </div>
                                <input type="text" class="input-pagina" name="txtEndereco" value="<?php echo $dadosFaleConosco->endereco;?>" required />
                            </div>
                            <div class="box-input-pagina">
                                <label class="titulo-input">Título Perguntas</label>
                                <input type="text" class="input-pagina" name="txtTituloB" value="<?php echo $dadosFaleConosco->tituloB;?>" required/>
                            </div>
                            <input class="preset-input-submit botao-submit" type="submit" name="formSubmit" value="Salvar" />
                        </form>
                    </div>
                    <div class="titulo-sesssao">
                        Perguntas frequentes
                    </div>
                    <div id="container-perguntas">                        
                        <div class="pergunta-combotao">
                            <form method="post" id="form-add-pergunta">
                                <div class="box-label-input">
                                    <label class="titulo-input"><span class="label">Pergunta</span>
                                        <input class="input-pagina input" type="text" name="txtPergunta">
                                    </label>
                                </div>
                                <div class="box-label-input">
                                    <label class="titulo-input"><span class="label">Resposta</span>
                                        <input class="input-pagina input" type="text" name="txtResposta">
                                    </label>
                                </div>
                                <input class="preset-botao" type="submit" name="btnAdd" value="+">
                            </form>
                        </div>
                        <div id="wrapper-perguntas">
                            <?php 
                                $buscaPerguntas = new \Tabela\PerguntasFrequentes();
                                $listaPerguntas = $buscaPerguntas->buscar();

                                foreach( $listaPerguntas as $pergunta ) { 
                            ?>
                            <div class="pergunta" data-id="<?php echo $pergunta->id; ?>">
                                <form class="form-pergunta" method="post">
                                    <div class="box-inputs">
                                        <div class="box-label-input">
                                            <label class="titulo-input"><span class="label">Pergunta</span>
                                                <input type="text" class="input-pagina input" name="txtPergunta" value="<?php echo $pergunta->pergunta; ?> ">
                                            </label>
                                        </div>
                                        <div class="box-label-input">
                                            <label class="titulo-input"><span class="label">Resposta</span>
                                                <input type="text" class="input-pagina input" name="txtResposta" value="<?php echo $pergunta->resposta; ?> ">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="box-acoes">
                                        <span class="preset-botao botao-remover">Remover</span>
                                        <input class="preset-botao botao-submit" type="submit" value="Salvar"/>
                                    </div>
                                </form>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="box-botao">
                        <input type="submit" class="preset-input-submit" value="Salvar">
                    </div>
                </div>
            </div>
            <?php
                include("layout/footer.php");
            ?>
        </div>      
	</body>
</html>