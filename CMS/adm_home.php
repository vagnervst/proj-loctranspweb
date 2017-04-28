<?php
    require_once("../include/initialize.php");
    require_once("../include/classes/tbl_home.php");
    $dadosHome = new \Tabela\Home();
    $buscaDados = $dadosHome->buscar("id = 1");

    if( !empty($buscaDados[0]) ) $dadosHome = $buscaDados[0];

    $formSubmit = ( isset($_POST['formSubmit']) )? $_POST["formSubmit"] : null;

    if( !empty($formSubmit) ) {        
        $titulo = ( isset($_POST["txtTitulo"]) )? $_POST["txtTitulo"] : null;
        
        $listaRequiredInputs = [];
        $listaRequiredInputs[] = $titulo;
        
        $listInput = [];
        $listaInput[] = $imagemA;
        
        if( !FormValidator::has_empty_input( $listaRequiredInputs ) ) {
            $objHome = new \Tabela\Home();
            
            $objHome->titulo = $titulo;            
            
            if( empty($buscaDados[0]) ) {
                $objHome->inserir();
            }
            else
            {
                $objHome->id = 1;
                $objHome->atualizar();
            }
        }
        
        redirecionar_para("adm_home.php");
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
            <div class="CMS_main" id="pag-cityshare-home">
                <?php include("layout/menu.php") ?>
                <div id="box-caminho">
                    <a href="home.php" class="link-caminho">Home</a> &gt;
                    <a href="cityshare.php" class="link-caminho">City Share</a> &gt;
                    <a href="cityshare_conteudo.php" class="link-caminho">Conteúdo</a> &gt;
                    <a href="#" class="link-caminho">Home</a>
                </div>
                <form action="adm_home.php" method="post" name="formConteudo" enctype="multipart/form-data">
                    <div class="box-conteudo">                        
                        <p class="titulo-sessao">Instruções de Locação</p>
                        <div id="container-pagina">
                            <div class="box-input-pagina">
                                <label class="titulo-input">Título</label>
                                <input type="text" class="input-pagina" name="txtTitulo" value="<?php echo $dadosHome->titulo; ?>" maxlength="70" required/>
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