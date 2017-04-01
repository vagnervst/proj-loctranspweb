<?php
    require_once("../include/initialize.php");
    $dadosSobreProjeto = new \Tabela\SobreProjeto();
    $buscaDados = $dadosSobreProjeto->buscar("id = 1");
    
    if( !empty($buscaDados[0]) ) $dadosSobreProjeto = $buscaDados[0];

    $form = ( isset($_POST['formSubmit']) )? $_POST["formSubmit"] : null;

    $upload_dir = "../img/uploads/conteudo/sobre_projeto";
    if( !empty($form)){
        $previaDescricao = ( isset($_POST["txtPreviaDescricao"]))? $_POST["txtPreviaDescricao"] : null;
        $imagemPrevia = ( isset($_FILES["imagemPrevia"]) )? $_FILES["imagemPrevia"] : null;
        $titulo = ( isset($_POST["txtTitulo"]) )? $_POST["txtTitulo"] : null;
        $imagemA = ( isset($_FILES["imagemA"]) )? $_FILES["imagemA"] : null;
        $descricaoImagemA = ( isset($_POST["txtDescricaoImagemA"]) )? $_POST["txtDescricaoImagemA"] : null;
        $imagemB = ( isset($_FILES["imagemB"]) )? $_FILES["imagemB"] : null;
        $descricaoImagemB = ( isset($_POST["txtDescricaoImagemB"]) )? $_POST["txtDescricaoImagemB"] : null;
        $conteudo = ( isset($_POST["txtConteudo"]) )? $_POST["txtConteudo"] : null;
        
        $listaRequiredInputs = [];        
        $listaRequiredInputs[] = $titulo;
        $listaRequiredInputs[] = $conteudo;
        $listaRequiredInputs[] = $descricaoImagemA;
        $listaRequiredInputs[] = $descricaoImagemB;        
        $listaRequiredInputs[] = $previaDescricao;
                        
        $listaInput = [];
        $listaInput[] = $imagemA;
        $listaInput[] = $imagemB;
        $listaInput[] = $imagemPrevia;                
        
        if( !FormValidator::has_empty_input( $listaRequiredInputs ) && !FormValidator::has_repeated_files($listaInput) ){
            $objSobreProjeto = new \Tabela\SobreProjeto();                        
            
            $objSobreProjeto->titulo = $titulo;
            $objSobreProjeto->conteudo = $conteudo;
            $objSobreProjeto->previaTexto = $previaDescricao;
            $objSobreProjeto->descricaoA = $descricaoImagemA;
            $objSobreProjeto->descricaoB = $descricaoImagemB;
            $objSobreProjeto->conteudo = $conteudo;
            
            if( File::replace( $imagemA["tmp_name"], $imagemA["name"], $dadosSobreProjeto->imagemA, $upload_dir ) ){
                $objSobreProjeto->imagemA = $imagemA["name"];
            }
            
            if( File::replace( $imagemB["tmp_name"], $imagemB["name"], $dadosSobreProjeto->imagemB, $upload_dir ) ){
                $objSobreProjeto->imagemB = $imagemB["name"];
            }
            
            if( File::replace( $imagemPrevia["tmp_name"], $imagemPrevia["name"], $dadosSobreProjeto->previaImagem, $upload_dir ) ){
                $objSobreProjeto->previaImagem = $imagemPrevia["name"];
            }                                    
            
            if( empty($buscaDados[0]) ) {
                echo "INSERT";
                $objSobreProjeto->inserir();
            }
            else
            {
                echo "UPDATE";
                $objSobreProjeto->id = 1;
                $objSobreProjeto->atualizar();
            }
            
            redirecionar_para("CMS_projeto.php");
        }
        redirecionar_para("CMS_projeto.php");
        
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
        <link rel="icon" href="../img/icones/logoCityShareIcon.png">
	</head>
	<body>
        <div id="container">
            <?php
                include("layout/header.php");
            ?>
            <div class="CMS_main" id="pag-cityshare-projeto">
                <div class="box-menu-lateral">
                    <div class="menu-lateral">
                        <ul>
                            <li class="botao-menu-lateral">
                                <a href="#">Home</a>
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
                    <a href="CMS_home.php" class="link-caminho" >Home</a> ><a href="CMS_cityshare.php" class="link-caminho"> City Share</a> > <a href="CMS_cityshare_conteudo.php" class="link-caminho" >Conteúdo</a> > <a href="#" class="link-caminho">Sobre o Projeto</a>
                </div>
                <form action="CMS_projeto.php" method="post" name="formConteudo" enctype="multipart/form-data">
                    <div class="box-conteudo">
                        <p class="titulo-sessao">Prévia</p>
                        <div id="container-previa">
                            <div class="box-input-imagem">
                                <span class="botao-imagem conteudo-image" id="box-img-previa" style="background-image: url(<?php echo File::read($dadosSobreProjeto->previaImagem, $upload_dir); ?>)"></span>
                                <input class="input" type="file" name="imagemPrevia" />
                            </div>
                            <div id="box-texto-previa">
                                <textarea id="input-previa" placeholder="Texto previa" name="txtPreviaDescricao" required><?php echo $dadosSobreProjeto->previaTexto; ?></textarea>
                            </div>
                        </div>
                        <p class="titulo-sessao">Página</p>
                        <div id="container-pagina">
                            <div class="box-input-pagina">
                                <label class="titulo-input">Título</label>
                                <input type="text" class="input-pagina" name="txtTitulo" required value="<?php echo $dadosSobreProjeto->titulo; ?>"/>
                            </div>
                            <div class="box-conteudo-pagina">
                                <div class="box-input-imagem">
                                    <span class="botao-imagem conteudo-image" id="box-img-previa" style="background-image: url(<?php echo File::read($dadosSobreProjeto->imagemA, $upload_dir); ?>)"></span>
                                    <input class="input" type="file" name="imagemA" />
                                </div>
                                <div class="conteudo-texto">
                                    <label class="titulo-input">Descrição</label>
                                    <textarea name="txtDescricaoImagemA" required><?php echo $dadosSobreProjeto->descricaoA; ?></textarea>
                                </div>
                            </div>
                            <div class="box-conteudo-pagina">
                                <div class="box-input-imagem">
                                    <span class="botao-imagem conteudo-image" id="box-img-previa" style="background-image: url(<?php echo File::read($dadosSobreProjeto->imagemB, $upload_dir); ?>)"></span>
                                    <input class="input" type="file" name="imagemB" />
                                </div>
                                <div class="conteudo-texto">
                                    <label class="titulo-input">Descrição</label>
                                    <textarea name="txtDescricaoImagemB" required><?php echo $dadosSobreProjeto->descricaoB; ?></textarea>
                                </div>
                            </div>
                            <div class="box-conteudo-pagina">
                                <div class="conteudo-texto-2">
                                    <label class="titulo-input">Conteúdo</label>
                                    <textarea name="txtConteudo" required><?php echo $dadosSobreProjeto->conteudo; ?></textarea>
                                </div>
                            </div>
                            <div class="box-botao">
                                <input type="submit" class="preset-input-submit" name="formSubmit" value="Salvar">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <?php
                include("layout/footer.php");
            ?>
        </div>      
	</body>
</html>