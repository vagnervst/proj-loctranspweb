<?php
    require_once("../include/initialize.php");
    $dadosHome = new \Tabela\Home();
    $buscaDados = $dadosHome->buscar("id = 1");

    if( !empty($buscaDados[0]) ) $dadosHome = $buscaDados[0];

    $formSubmit = ( isset($_POST['formSubmit']) )? $_POST["formSubmit"] : null;

    $upload_dir = "../img/uploads/conteudo/home";
    if( !empty($formSubmit) ) {        
        $titulo = ( isset($_POST["txtTitulo"]) )? $_POST["txtTitulo"] : null;
        $imagemA = ( isset($_FILES["imagemA"]) )? $_FILES["imagemA"] : null;
        
        $listaRequiredInputs = [];
        $listaRequiredInputs[] = $titulo;
        
        $listInput = [];
        $listaInput[] = $imagemA;
        
        if( !FormValidator::has_empty_input( $listaRequiredInputs ) && !FormValidator::has_repeated_files( $listaInput ) ) {
            $objHome = new \Tabela\Home();
            
            $objHome->titulo = $titulo;
            
            if( File::replace( $imagemA["tmp_name"], $imagemA["name"], $dadosHome->imagemA, $upload_dir ) ) {
                $objHome->imagemA = $imagemA["name"];
            }
            
            if( empty($buscaDados[0]) ) {
                $objHome->inserir();
            }
            else
            {
                $objHome->id = 1;
                $objHome->atualizar();
            }
        }
        
        redirecionar_para("CMS_adm_home.php");
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
            <div class="CMS_main" id="pag-cityshare-home">
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
                    <a href="CMS_home.php" class="link-caminho" >Home</a> ><a href="CMS_cityshare.php" class="link-caminho"> City Share</a> > <a href="CMS_cityshare_conteudo.php" class="link-caminho" >Conteúdo</a> > <a href="#" class="link-caminho">Home</a>
                </div>
                <form action="CMS_adm_home.php" method="post" name="formConteudo" enctype="multipart/form-data">
                    <div class="box-conteudo">                        
                        <p class="titulo-sessao">Página</p>
                        <div id="container-pagina">
                            <div class="box-input-pagina">
                                <label class="titulo-input">Título</label>
                                <input type="text" class="input-pagina" name="txtTitulo" value="<?php echo $dadosHome->titulo; ?>" required/>
                            </div>
                            <div class="box-conteudo-pagina">
                                <div class="box-input-imagem">                                    
                                    <span class="botao-imagem conteudo-image" id="box-img-previa" style="background-image: url(<?php echo File::read($dadosHome->imagemA, $upload_dir); ?>)"></span>
                                    <input class="input" type="file" name="imagemA" />
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