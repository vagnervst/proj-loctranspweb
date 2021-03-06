<?php
    require_once("../include/initialize.php");
    require_once("../include/classes/tbl_sobre_empresa.php");
    $dadosSobreEmpresa = new \Tabela\SobreEmpresa();
    $buscaDados = $dadosSobreEmpresa->buscar("id = 1");
    
    if( !empty($buscaDados[0]) ) $dadosSobreEmpresa = $buscaDados[0]; 

    $form = ( isset($_POST["formSubmit"]) )? $_POST["formSubmit"] : null;
    
    $upload_dir = "../img/uploads/conteudo/sobre_empresa";
    if( !empty( $form ) ) {        
        $previaDescricao = ( isset($_POST["txtPreviaDescricao"]) )? $_POST["txtPreviaDescricao"] : null;
        $titulo = ( isset($_POST["txtTitulo"]) )? $_POST["txtTitulo"] : null;
        $introducao = ( isset($_POST["txtIntroducao"]) )? $_POST["txtIntroducao"] : null;
        $imagemA = ( isset($_FILES["imagemA"]) )? $_FILES["imagemA"] : null;
        $tituloImagemA = ( isset($_POST["txtTituloImagemA"]) )? $_POST["txtTituloImagemA"] : null;
        $descricaoImagemA = ( isset($_POST["txtDescricaoImagemA"]) )? $_POST["txtDescricaoImagemA"] : null;
        $imagemB = ( isset($_FILES["imagemB"]) )? $_FILES["imagemB"] : null;
        $tituloImagemB = ( isset($_POST["txtTituloImagemB"]) )? $_POST["txtTituloImagemB"] : null;
        $descricaoImagemB = ( isset($_POST["txtDescricaoImagemB"]) )? $_POST["txtDescricaoImagemB"] : null;
        
        $listaRequiredInputs = [];
        $listaRequiredInputs[] = $previaDescricao;
        $listaRequiredInputs[] = $titulo;
        $listaRequiredInputs[] = $introducao;
        $listaRequiredInputs[] = $tituloImagemA;
        $listaRequiredInputs[] = $descricaoImagemA;
        $listaRequiredInputs[] = $tituloImagemB;
        $listaRequiredInputs[] = $descricaoImagemB;
        
        $listaInput = [];
        $listaInput[] = $imagemA;
        $listaInput[] = $imagemB;
                
        if( !FormValidator::has_empty_input( $listaRequiredInputs ) ) {            
            $objSobreEmpresa = new \Tabela\SobreEmpresa();
                        
            $objSobreEmpresa->titulo = $titulo; 
            $objSobreEmpresa->introducao = $introducao;
            $objSobreEmpresa->tituloA = $tituloImagemA;
            $objSobreEmpresa->descricaoA = $descricaoImagemA;            
            $objSobreEmpresa->tituloB = $tituloImagemB;
            $objSobreEmpresa->descricaoB = $descricaoImagemB;            
            $objSobreEmpresa->previaTexto = $previaDescricao;
                        
            if( !empty($imagemA["name"]) && File::replace( $imagemA, "sobre_empresa_img_A." . pathinfo($imagemA["name"])["extension"], $dadosSobreEmpresa->imagemA, $upload_dir ) ) {
                $objSobreEmpresa->imagemA = "sobre_empresa_img_A." . pathinfo($imagemA["name"])["extension"];
            }
            
            if( !empty($imagemB["name"]) && File::replace( $imagemB, "sobre_empresa_img_B." . pathinfo($imagemB["name"])["extension"], $dadosSobreEmpresa->imagemB, $upload_dir ) ) {
                $objSobreEmpresa->imagemB = "sobre_empresa_img_B." . pathinfo($imagemB["name"])["extension"];
            }
                        
            if( empty($buscaDados[0]) ) 
            {                                
                $objSobreEmpresa->inserir();
            }
            else 
            {                
                $objSobreEmpresa->id = 1;
                $objSobreEmpresa->atualizar();
            }
        }
        
        redirecionar_para("empresa.php");
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
            <div class="CMS_main" id="pag-cityshare-empresa">
                <?php include("layout/menu.php") ?>
                <div id="box-caminho">
                    <a href="home.php" class="link-caminho">Home</a> &gt;
                    <a href="cityshare.php" class="link-caminho">City Share</a> &gt;
                    <a href="cityshare_conteudo.php" class="link-caminho">Conteúdo</a> &gt;
                    <a href="#" class="link-caminho">Sobre a Empresa</a>
                </div>
                <form action="empresa.php" method="post" name="formConteudo" enctype="multipart/form-data">
                    <div class="box-conteudo">
                        <p class="titulo-sessao">Prévia</p>
                        <div id="container-previa">                            
                            <div id="box-texto-previa">
                                <textarea id="input-previa" name="txtPreviaDescricao" placeholder="Texto previa" required><?php echo $dadosSobreEmpresa->previaTexto; ?></textarea>
                            </div>
                        </div>
                        <p class="titulo-sessao">Página</p>
                        <div id="container-pagina">
                            <div class="box-input-pagina">
                                <label class="titulo-input">Título</label>
                                <input type="text" class="input-pagina" name="txtTitulo" value="<?php echo $dadosSobreEmpresa->titulo; ?>" required/>
                            </div>
                            <div class="box-input-pagina">
                                <label class="titulo-input">Introdução</label>
                                <input type="text" class="input-pagina" name="txtIntroducao" value="<?php echo $dadosSobreEmpresa->introducao; ?>" required/>
                            </div>
                            <div class="box-conteudo-pagina">                                
                                <div class="box-input-imagem">
                                    <span class="botao-imagem conteudo-image" id="box-img-previa" style="background-image: url(<?php echo File::read($dadosSobreEmpresa->imagemA, $upload_dir); ?>)"></span>                                    
                                    <input class="input" type="file" name="imagemA" accept=".jpg, .jpeg, .png, .gif" />                                    
                                </div>
                                <div class="conteudo-titulo">
                                    <label class="titulo-input">Título</label>
                                    <input type="text" class="input-pagina" name="txtTituloImagemA" value="<?php echo $dadosSobreEmpresa->tituloA; ?>" required/>
                                </div>
                                <div class="conteudo-texto">
                                    <label class="titulo-input">Descrição</label>
                                    <textarea name="txtDescricaoImagemA" required><?php echo $dadosSobreEmpresa->descricaoA; ?></textarea>
                                </div>
                            </div>
                            <div class="box-conteudo-pagina">
                                <div class="box-input-imagem">
                                    <span class="botao-imagem conteudo-image" id="box-img-previa" style="background-image: url(<?php echo File::read($dadosSobreEmpresa->imagemB, $upload_dir); ?>)"></span>
                                    <input class="input" type="file" name="imagemB" accept="image/jpg, image/jpeg, image/png, image/gif" />
                                </div>
                                <div class="conteudo-titulo">
                                    <label class="titulo-input">Título</label>
                                    <input type="text" class="input-pagina" name="txtTituloImagemB" value="<?php echo $dadosSobreEmpresa->tituloB; ?>" required/>
                                </div>
                                <div class="conteudo-texto">
                                    <label class="titulo-input">Descrição</label>
                                    <textarea name="txtDescricaoImagemB" required><?php echo $dadosSobreEmpresa->descricaoB; ?></textarea>
                                </div>
                            </div>
                            <div class="box-botao">
                                <input class="preset-input-submit" type="submit" name="formSubmit" value="Salvar">
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