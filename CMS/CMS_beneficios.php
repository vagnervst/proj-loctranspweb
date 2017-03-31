<?php
    require_once("../include/initialize.php");
    $dadosBeneficiosProjeto = new \Tabela\BeneficiosProjeto();
    $buscaDados = $dadosBeneficiosProjeto->buscar("id = 1");
    
    if( !empty($buscaDados[0]) ) $dadosBeneficiosProjeto = $buscaDados[0]; 

    $form = ( isset($_POST["formSubmit"]) )? $_POST["formSubmit"] : null;
    
    $upload_dir = "../img/uploads/conteudo/beneficios_projeto";
    if( !empty( $form ) ) {
        $titulo = ( isset($_POST["txtTitulo"]) )? $_POST["txtTitulo"] : null;
        $introducao = ( isset($_POST["txtIntroducao"]) )? $_POST["txtIntroducao"] : null;
        $imagemA = ( isset($_FILES["imagemA"]) )? $_FILES["imagemA"] : null;
        $descricaoA = ( isset($_POST["txtDescricaoA"]) )? $_POST["txtDescricaoA"] : null;
        $imagemB = ( isset($_FILES["imagemB"]) )? $_FILES["imagemB"] : null;
        $descricaoB = ( isset($_POST["txtDescricaoB"]) )? $_POST["txtDescricaoB"] : null;
        $imagemC = ( isset($_FILES["imagemC"]) )? $_FILES["imagemC"] : null;
        $descricaoC = ( isset($_POST["txtDescricaoC"]) )? $_POST["txtDescricaoC"] : null;
        $previaImagem = ( isset($_FILES["previaImagem"]) )? $_FILES["previaImagem"] : null;
        $previaTexto = ( isset($_POST["txtPreviaTexto"]) )? $_POST["txtPreviaTexto"] : null;    
    
        $listaRequiredInputs = [];
        $listaRequiredInputs[] = $titulo;
        $listaRequiredInputs[] = $introducao;        
        $listaRequiredInputs[] = $descricaoA;
        $listaRequiredInputs[] = $descricaoB;
        $listaRequiredInputs[] = $descricaoC;
        $listaRequiredInputs[] = $previaTexto;
        
        $listaInput = [];
        $listaInput[] = $imagemA;
        $listaInput[] = $imagemB;
        $listaInput[] = $imagemC;
        $listaInput[] = $previaImagem;
        
        if( !FormValidator::has_empty_input( $listaRequiredInputs ) && !FormValidator::has_repeated_files($listaInput) ) {            
            $objBeneficiosProjeto = new \Tabela\BeneficiosProjeto();
                        
            $objBeneficiosProjeto->titulo = $titulo; 
            $objBeneficiosProjeto->introducao = $introducao;
            $objBeneficiosProjeto->descricaoA = $descricaoA;
            $objBeneficiosProjeto->descricaoB = $descricaoB;
            $objBeneficiosProjeto->descricaoC = $descricaoC;
            $objBeneficiosProjeto->previaTexto = $previaTexto;
            
            if( File::replace( $imagemA["tmp_name"], $imagemA["name"], $dadosBeneficiosProjeto->imagemA, $upload_dir ) ) {
                $objBeneficiosProjeto->imagemA = $imagemA["name"];
            }

            if( File::replace( $imagemB["tmp_name"], $imagemB["name"], $dadosBeneficiosProjeto->imagemB, $upload_dir ) ) {
                $objBeneficiosProjeto->imagemB = $imagemB["name"];
            }
            
            if( File::replace( $imagemC["tmp_name"], $imagemC["name"], $dadosBeneficiosProjeto->imagemC, $upload_dir ) ) {
                $objBeneficiosProjeto->imagemC = $imagemC["name"];
            }
            
            if( File::replace( $previaImagem["tmp_name"], $previaImagem["name"], $dadosBeneficiosProjeto->previaImagem, $upload_dir ) ) {
                $objBeneficiosProjeto->previaImagem = $previaImagem["name"];
            }
            
            if( empty($buscaDados[0]) )
            {                                
                $objBeneficiosProjeto->inserir();
            } 
            else 
            {                
                $objBeneficiosProjeto->id = 1;
                $objBeneficiosProjeto->atualizar();
            }            
        }
        
        redirecionar_para("CMS_beneficios.php");
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
            <div class="CMS_main" id="pag-cityshare-beneficios">
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
                    <a href="CMS_home.php" class="link-caminho" >Home</a> ><a href="CMS_cityshare.php" class="link-caminho"> City Share</a> > <a href="CMS_cityshare_conteudo.php" class="link-caminho" >Conteúdo</a> > <a href="#" class="link-caminho">Benefícios do Projeto</a>
                </div>
                <form action="CMS_beneficios.php" method="post" enctype="multipart/form-data">
                    <div class="box-conteudo">
                        <p class="titulo-sessao">Prévia</p>
                        <div id="container-previa">
                            <div class="box-input-imagem">
                                <span class="botao-imagem conteudo-image" id="box-img-previa" style="background-image: url(<?php echo File::read($dadosBeneficiosProjeto->previaImagem, $upload_dir); ?>)"></span>
                                <input class="input" type="file" name="previaImagem" />
                            </div>
                            <div id="box-texto-previa">
                                <textarea id="input-previa" name="txtPreviaTexto" placeholder="Texto previa"><?php echo $dadosBeneficiosProjeto->previaTexto; ?></textarea>
                            </div>
                        </div>
                        <p class="titulo-sessao">Página</p>
                        <div id="container-pagina">
                            <div class="box-input-pagina">
                                <label class="titulo-input">Título</label>
                                <input type="text" name="txtTitulo" class="input-pagina" value="<?php echo $dadosBeneficiosProjeto->titulo; ?>">
                            </div>
                            <div class="box-input-pagina">
                                <label class="titulo-input">Introdução</label>
                                <input type="text" name="txtIntroducao" class="input-pagina" value="<?php echo $dadosBeneficiosProjeto->introducao; ?>">
                            </div>
                            <div id="box-publicacoes">
                                <div class="box-conteudo-pagina">
                                    <div class="box-input-imagem">
                                        <span class="botao-imagem conteudo-image" id="box-img-previa" style="background-image: url(<?php echo File::read($dadosBeneficiosProjeto->imagemA, $upload_dir); ?>)"></span>
                                        <input class="input" type="file" name="imagemA" value="<?php echo $dadosBeneficiosProjeto->imagemA; ?>" />
                                    </div>
                                    <div class="conteudo-texto">
                                        <textarea name="txtDescricaoA"><?php echo $dadosBeneficiosProjeto->descricaoA; ?></textarea>
                                    </div>
                                </div>
                                <div class="box-conteudo-pagina">
                                    <div class="box-input-imagem">
                                        <span class="botao-imagem conteudo-image" id="box-img-previa" style="background-image: url(<?php echo File::read($dadosBeneficiosProjeto->imagemB, $upload_dir); ?>)"></span>
                                        <input class="input" type="file" name="imagemB" value="<?php echo $dadosBeneficiosProjeto->imagemB; ?>" />
                                    </div>
                                    <div class="conteudo-texto">
                                        <textarea name="txtDescricaoB"><?php echo $dadosBeneficiosProjeto->descricaoB; ?></textarea>
                                    </div>
                                </div>
                                <div class="box-conteudo-pagina">
                                    <div class="box-input-imagem">
                                        <span class="botao-imagem conteudo-image" id="box-img-previa" style="background-image: url(<?php echo File::read($dadosBeneficiosProjeto->imagemC, $upload_dir); ?>)"></span>
                                        <input class="input" type="file" name="imagemC" value="<?php echo $dadosBeneficiosProjeto->imagemC; ?>" />
                                    </div>
                                    <div class="conteudo-texto">
                                        <textarea name="txtDescricaoC"><?php echo $dadosBeneficiosProjeto->descricaoC; ?></textarea>
                                    </div>
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