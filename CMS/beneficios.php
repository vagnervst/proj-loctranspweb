<?php
    require_once("../include/initialize.php");
    require_once("../include/classes/tbl_beneficios_projeto.php");
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
        
        if( !FormValidator::has_empty_input( $listaRequiredInputs ) ) {            
            $objBeneficiosProjeto = new \Tabela\BeneficiosProjeto();
                        
            $objBeneficiosProjeto->titulo = $titulo; 
            $objBeneficiosProjeto->introducao = $introducao;
            $objBeneficiosProjeto->descricaoA = $descricaoA;
            $objBeneficiosProjeto->descricaoB = $descricaoB;
            $objBeneficiosProjeto->descricaoC = $descricaoC;
            $objBeneficiosProjeto->previaTexto = $previaTexto;
            
            echo "1";
            if( !empty($imagemA["name"]) && File::replace( $imagemA, "beneficio_imagem_A." . pathinfo($imagemA["name"])["extension"], $dadosBeneficiosProjeto->imagemA, $upload_dir ) ) {
                $objBeneficiosProjeto->imagemA = "beneficio_imagem_A." . pathinfo($imagemA["name"])["extension"];
            }
            echo "2";
            if( !empty($imagemB["name"]) && File::replace( $imagemB, "beneficio_imagem_B." . pathinfo($imagemB["name"])["extension"], $dadosBeneficiosProjeto->imagemB, $upload_dir ) ) {
                $objBeneficiosProjeto->imagemB = "beneficio_imagem_B." . pathinfo($imagemB["name"])["extension"];
            }
            echo "3";
            if( !empty($imagemC["name"]) && File::replace( $imagemC, "beneficio_imagem_C." . pathinfo($imagemC["name"])["extension"], $dadosBeneficiosProjeto->imagemC, $upload_dir ) ) {
                $objBeneficiosProjeto->imagemC = "beneficio_imagem_C." . pathinfo($imagemC["name"])["extension"];
            }
            echo "4";
            if( !empty($previaImagem["name"]) && File::replace( $previaImagem, "beneficio_imagem_previa." . pathinfo($previaImagem["name"])["extension"], $dadosBeneficiosProjeto->previaImagem, $upload_dir ) ) {
                $objBeneficiosProjeto->previaImagem = "beneficio_imagem_previa." . pathinfo($previaImagem["name"])["extension"];
            }
            echo "5";
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
        
        redirecionar_para("beneficios.php");
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
                <?php include("layout/menu.php") ?>
                <div id="box-caminho">
                    <a href="home.php" class="link-caminho">Home</a> &gt; 
                    <a href="cityshare.php" class="link-caminho">City Share</a> &gt; 
                    <a href="cityshare_conteudo.php" class="link-caminho">Conteúdo</a> &gt; 
                    <a href="#" class="link-caminho">Benefícios do Projeto</a>
                </div>
                <form action="beneficios.php" method="post" enctype="multipart/form-data">
                    <div class="box-conteudo">
                        <p class="titulo-sessao">Prévia</p>
                        <div id="container-previa">
                            <div class="box-input-imagem">
                                <span class="botao-imagem conteudo-image" id="box-img-previa" style="background-image: url(<?php echo File::read($dadosBeneficiosProjeto->previaImagem, $upload_dir); ?>)"></span>
                                <input class="input" type="file" name="previaImagem" accept="image/jpg, image/jpeg, image/png, image/gif" />
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
                                        <input class="input" type="file" name="imagemA" accept="image/jpg, image/jpeg, image/png, image/gif" />
                                    </div>
                                    <div class="conteudo-texto">
                                        <textarea name="txtDescricaoA"><?php echo $dadosBeneficiosProjeto->descricaoA; ?></textarea>
                                    </div>
                                </div>
                                <div class="box-conteudo-pagina">
                                    <div class="box-input-imagem">
                                        <span class="botao-imagem conteudo-image" id="box-img-previa" style="background-image: url(<?php echo File::read($dadosBeneficiosProjeto->imagemB, $upload_dir); ?>)"></span>
                                        <input class="input" type="file" name="imagemB" accept="image/jpg, image/jpeg, image/png, image/gif" />
                                    </div>
                                    <div class="conteudo-texto">
                                        <textarea name="txtDescricaoB"><?php echo $dadosBeneficiosProjeto->descricaoB; ?></textarea>
                                    </div>
                                </div>
                                <div class="box-conteudo-pagina">
                                    <div class="box-input-imagem">
                                        <span class="botao-imagem conteudo-image" id="box-img-previa" style="background-image: url(<?php echo File::read($dadosBeneficiosProjeto->imagemC, $upload_dir); ?>)"></span>
                                        <input class="input" type="file" name="imagemC" accept="image/jpg, image/jpeg, image/png, image/gif" />
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