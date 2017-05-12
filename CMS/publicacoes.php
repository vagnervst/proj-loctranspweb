<?php
    require_once("../include/initialize.php");
    require_once("../include/classes/sessao.php");
    require_once("../include/classes/tbl_publicacao.php");

    $pagina_atual = ( isset($_GET["p"]) )? (int) $_GET["p"] : 1;    
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>
            CMS - Publicações | City Share
		</title>
        <link rel="stylesheet" type="text/css" href="CSS/Style.css">
        <link rel="icon" href="../img/icones/logoCityShareIcon.png">
	</head>
	<body>
        <div id="container">
           <?php
                include("layout/header.php");
            ?>
            <div class="CMS_main" id="pag-publicacao">
                <?php include("layout/menu.php") ?>
                <div id="box-caminho">
                    <a href="home.php" class="link-caminho" >Home</a> ><a href="clientes.php" class="link-caminho"> Clientes</a> ><a href="publicacoes.php" class="link-caminho"> Publicações</a>
                </div>
                <?php 
                    $lista_publicacoes = new \Tabela\Publicacao();
                    $lista_publicacoes = $lista_publicacoes->getPublicacaoPaginacao(10, 1, "p.idStatusPublicacao = 3");
                    
                    for( $i = 0; $i < count( $lista_publicacoes ); ++$i ) {
                        $publicacao = $lista_publicacoes[$i];
                        $dataAtual = time();
                        $diasRestantes = (($dataAtual - strtotime($publicacao->dataPublicacao))/(60*60*24));                                                
                ?>
                <a href="publicacao_detalhe.php?id=<?php echo $publicacao->id; ?>">
                    <div class="box-publicacao-preview">
                        <div class="box-publicacao-imagem">
                            <img src="Image/content_test.jpg" class="publicacao-imagem">
                        </div>
                        <div class="box-publicacao-dados">
                            <?php echo $publicacao->titulo ?><br>
                            <?php echo $publicacao->nomeLocador . " " . $publicacao->sobrenomeLocador[0] ?>
                        </div>
                        <div class="box-publicacao-status">
                            <?php
                                if( $publicacao->idStatusPublicacao == 2 ) {
                                    echo "Recusada";
                                } elseif ( $publicacao->idStatusPublicacao == 1 ) {
                                    echo "Aprovada";
                                } else {
                                    echo "Pendente";
                                }
                            ?><br>
                            <?php echo $diasRestantes; ?>
                        </div>
                    </div>
                </a>
                <?php } ?>
            </div>
            <?php
                include("layout/footer.php");
            ?>
        </div>      
	</body>
</html>