<?php
    require_once("../include/initialize.php");
    require_once("../include/classes/file.php");
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
                    <a href="home.php" class="link-caminho" >Home</a> &gt;
                    <a href="clientes.php" class="link-caminho">Clientes</a> &gt;
                    <a href="publicacoes.php" class="link-caminho">Publicações</a>
                </div>
                <div id="container-publicacoes">
                    <?php 
                        $lista_publicacoes = new \Tabela\Publicacao();
                        $lista_publicacoes = $lista_publicacoes->getPublicacaoPaginacao(null, null, "p.idStatusPublicacao = 3");
                        
                        for( $i = 0; $i < count( $lista_publicacoes ); ++$i ) {
                            $publicacao = $lista_publicacoes[$i];                            
                            
                            $dataAtual = time();
                            $dataPublicacao = strtotime( $publicacao->dataPublicacao );
                            $diasAnalise = (int) $publicacao->diasAnalisePublicacao;                                                        
                            
                            $diff = $dataAtual - $dataPublicacao;                            
                            $diasDiferenca = $diff / (60*60*24);
                            
                            $diasRestantes = round($diasAnalise - $diasDiferenca);
                    ?>                
                    <a href="publicacao_detalhe.php?id=<?php echo $publicacao->id; ?>">
                        <div class="box-publicacao-preview">
                            <div class="box-publicacao-imagem">
                                <?php
                                    $pasta = "../img/uploads/publicacoes";
                                ?>
                                <img src="<?php echo File::read($publicacao->imagemPrincipal, $pasta, "no_image.png"); ?>" class="publicacao-imagem">
                            </div>
                            <div class="box-publicacao-dados">
                                <?php echo $publicacao->titulo ?><br>
                                <?php echo $publicacao->nomeLocador . " " . $publicacao->sobrenomeLocador ?>
                            </div>
                            <div class="box-publicacao-status">
                                <p>
                                <?php
                                    if( $publicacao->idStatusPublicacao == 2 ) {
                                        echo "Recusada";
                                    } elseif ( $publicacao->idStatusPublicacao == 1 ) {
                                        echo "Aprovada";
                                    } else {
                                        echo "Pendente";
                                    }
                                ?>
                                </p>
                                <p>Dias restantes: <?php echo $diasRestantes; ?></p>
                            </div>
                        </div>
                    </a>
                    <?php } ?>
                </div>
            </div>
            <?php
                include("layout/footer.php");
            ?>
        </div>      
	</body>
</html>