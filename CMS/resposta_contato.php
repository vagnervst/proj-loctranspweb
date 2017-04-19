<?php
    require_once("../include/initialize.php");    
    require_once("../include/functions.php");    
    require_once("../include/classes/tbl_contato.php");
    require_once("../include/classes/tbl_assunto.php");
    
    $utils = new \DB\DatabaseUtils(); 
    $idContato = ( isset($_GET["id"]) )? $_GET["id"] : null;
    $infoContato = new \Tabela\Contato();

    if(isset($_POST['btn-resposta'])){
        $resposta=$_POST['txt_resposta'];
        $update = $infoContato-> updateContato( $resposta , $idContato );
        header("location:fale_conosco.php");
           
    }
    //if( empty($idContato) ) redirecionar_para("fale_conosco.php");
    
   
    $infoContato = $infoContato->getInfoContato( "c.id = {$idContato}" )[0]; 

    
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
            <div class="CMS_main" id="pag-resposta-contato">
                <?php include("layout/menu.php") ?>
                <div id="box-caminho">
                    <a href="CMS_home.php" class="link-caminho" >Home</a> ><a href="clientes.php" class="link-caminho"> Desktop</a>
                </div>
                <div class="box-conteudo">
                    <form method="post" action="resposta_contato.php?id=<?php echo $idContato ?>"> 
                        <div id="base-resposta">
                            <p>Nome : <?php echo $infoContato->nome; ?>  </p>
                            <p>Email : <?php echo $infoContato->email; ?></p>
                            <p>assunto:<?php echo $infoContato->assunto; ?></p>
                            <p>Mensagem : <?php echo $infoContato->nome; ?></p>
                            <p>Resposta : </p>
							<textarea name="txt_resposta" rows = "20" >
								
							</textarea>
							<input class ="preset-input-submit" name="btn-resposta" type="submit">
                            
                        </div>
                    </form>
                    
                </div>
            </div>
            <?php
                include("layout/footer.php");
            ?>
        </div>      
	</body>
</html>