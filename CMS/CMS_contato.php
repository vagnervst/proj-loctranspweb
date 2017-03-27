<?php require_once("../include/initialize.php"); ?>
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
                    <a href="CMS_home.php" class="link-caminho" >Home</a> ><a href="CMS_cityshare.php" class="link-caminho"> City Share</a> > <a href="CMS_cityshare_conteudo.php" class="link-caminho" >Conteúdo</a>
                </div>
                <div class="box-conteudo">
                    <div class="titulo-sesssao">
                        Fale conosco
                    </div>
                    <div id="container-fale-conosco">
                        <div class="box-input-pagina">
                            <label class="titulo-input">Título</label>
                            <input type="text" class="input-pagina" name="txtTitulo" value="" required/>
                        </div>
                        <div class="box-input-pagina">
                            <label class="titulo-input">Descrição</label>
                            <input type="text" class="input-pagina" name="txtTitulo" value="" required/>
                        </div>
                        <div class="item-fale-conosco">
                            <div class="titulo-input">
                                Email
                            </div>
                            <input type="text" class="input-pagina">
                        </div>
                        <div class="item-fale-conosco">
                            <div class="titulo-input">
                                Telefone
                            </div>
                            <input type="text" class="input-pagina">
                        </div>
                        <div class="item-fale-conosco">
                            <div class="titulo-input">
                                Atendimento
                            </div>
                            <input type="text" class="input-pagina">
                        </div>
                        <div class="item-fale-conosco">
                            <div class="titulo-input">
                                Pagina
                            </div>
                            <input type="text" class="input-pagina">
                        </div>
                    </div>
                    <div class="titulo-sesssao">
                        Perguntas frequentes
                    </div>
                    <div id="container-perguntas">
                        <div class="box-input-pagina">
                            <label class="titulo-input">Título</label>
                            <input type="text" class="input-pagina" name="txtTitulo" value="" required/>
                        </div>
                        <div class="pergunta-combotao">
                            <form method="post" action="#" id="form-add-pergunta">
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
                                <form class="form-pergunta" method="post" action="#">
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
                                        <a class="preset-botao botao-remover" href="#">Remover</a>
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