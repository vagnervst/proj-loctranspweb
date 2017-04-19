<?php
    require_once("../include/initialize.php");    
    require_once("../include/classes/tbl_contato.php");
    require_once("../include/classes/tbl_assunto.php");
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
            <div class="CMS_main" id="pag-fale-conosco">
                <?php include("layout/menu.php") ?>
                <div id="box-caminho">
                    <a href="CMS_home.php" class="link-caminho" >Home</a> ><a href="clientes.php" class="link-caminho"> Desktop</a>
                </div>
                <div class="box-conteudo">
                    <div class="titulo-sessao"><p>Contatos Feitos</p></div>
                    <div id="filtrar-por">
                        <label>Filtrar por :</label> 
                        
                        <select>
                            <?php
                                $listaAssuntos = new \Tabela\Assunto();
                                $listaAssuntos = $listaAssuntos->buscar();

                                    foreach( $listaAssuntos as $assunto ) {
                                ?>
                                <option value="<?php echo $assunto->id;?>"><?php echo utf8_decode($assunto->titulo);?></option>
                                <?php } ?>
                        </select>
                    </div>
                    <div id="listagem-contatos-feitos">
                        <?php
                            $listaContatos = new \Tabela\Contato();
                            $listaContatos = $listaContatos->getInfoContato("respondido = 0");

                                foreach( $listaContatos as $contato ) {
                            ?>
                            
                        <a href="resposta_contato.php?id=<?php echo $contato->id ?>" >
                            <div class="item-contato">
                                <div class="nome-contato">
                                    Nome :<?php echo $contato->nome;?>
                                </div>
                                <div class="assunto-contato">
                                    Assunto :<?php 
                                    
                                        echo utf8_decode($contato->assunto);
                                        
                                    ?>
                                </div>
                            </div>
                        </a>
                        <?php } ?>
                    </div>
                   123
                </div>
            </div>
            <?php
                include("layout/footer.php");
            ?>
        </div>      
	</body>
</html>