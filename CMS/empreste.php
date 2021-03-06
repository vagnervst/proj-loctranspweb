<?php
    require_once("../include/initialize.php");
    require_once("../include/classes/tbl_empreste.php");

    $dadosEmpreste = new \Tabela\Empreste();
    $buscaDados = $dadosEmpreste->buscar("id = 1");
    
    if( !empty($buscaDados[0]) ) $dadosEmpreste = $buscaDados[0];    

    $formSubmit = ( isset($_POST["formSubmit"]) )? $_POST["formSubmit"] : null;
    
    $upload_dir = "../img/uploads/conteudo/empreste";
    if( !empty($formSubmit) ) {        
        $titulo = ( isset($_POST["txtTitulo"]) )? $_POST["txtTitulo"] : null;
        $descricao = ( isset($_POST["txtDescricao"]) )? $_POST["txtDescricao"] : null;
        $tituloA = ( isset($_POST["txtTituloA"]) )? $_POST["txtTituloA"] : null;
        $imagemA = ( isset($_FILES["imagemA"]) )? $_FILES["imagemA"] : null;
        
        $listaRequiredInputs = [];
        $listaRequiredInputs[] = $titulo;
        $listaRequiredInputs[] = $descricao;
        $listaRequiredInputs[] = $tituloA;                
        
        if( !FormValidator::has_empty_input( $listaRequiredInputs ) ) {
            $objEmpreste = new \Tabela\Empreste();            
            
            $objEmpreste->titulo = $titulo;
            $objEmpreste->descricao = $descricao;
            $objEmpreste->tituloA = $tituloA;
                                                   
            if( File::replace( $imagemA["tmp_name"], $imagemA["name"], $dadosEmpreste->imagemA, $upload_dir ) ) {
                $objEmpreste->imagemA = $imagemA["name"];
            }
            
            if( empty($buscaDados[0]) )                 
            {                
                echo "INSERT";
                $objEmpreste->inserir();
            } 
            else 
            {
                echo "UPDATE";
                $objEmpreste->id = 1;
                $objEmpreste->atualizar();
            }            
        }
        
        redirecionar_para("empreste.php");
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
            <div class="CMS_main" id="pag-cityshare-empreste">
                <?php include("layout/menu.php") ?>
                <div id="box-caminho">
                    <a href="home.php" class="link-caminho" >Home</a> &gt;
                    <a href="cityshare.php" class="link-caminho"> City Share</a> &gt;
                    <a href="cityshare_conteudo.php" class="link-caminho" >Conteúdo</a> &gt;
                    <a href="#" class="link-caminho">Empreste</a>
                </div>
                <form action="empreste.php" method="post" enctype="multipart/form-data">
                    <div class="box-conteudo">                        
                        <p class="titulo-sessao">Página</p>
                        <div id="container-pagina">
                            <p class="titulo-conteudo">Título do Conteúdo</p>
                            <div class="box-input-pagina">
                                <label class="titulo-input">Título</label>
                                <input class="input-pagina" type="text" name="txtTitulo" value="<?php echo $dadosEmpreste->titulo; ?>">
                            </div>
                            <div class="box-conteudo-pagina">
                                <div class="conteudo-texto">
                                    <label class="titulo-input">Descrição</label>
                                    <textarea name="txtDescricao"><?php echo $dadosEmpreste->descricao; ?></textarea>
                                </div>
                            </div>
                            <p class="titulo-conteudo">Instruções de Empréstimo</p>
                            <div class="box-conteudo-pagina">
                                <div class="conteudo-texto-2">
                                    <div class="box-input-pagina">
                                        <label class="titulo-input">Título</label>
                                        <input class="input-pagina" type="text" name="txtTituloA" value="<?php echo $dadosEmpreste->tituloA; ?>">
                                    </div>
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