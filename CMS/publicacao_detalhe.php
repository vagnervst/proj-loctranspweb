<?php
    require_once("../include/initialize.php");
    require_once("../include/classes/sessao.php");
    require_once("../include/classes/tbl_publicacao.php");
    require_once("../include/classes/tbl_usuario.php");

    $idPublicacao = ( isset($_GET["id"]) )? $_GET["id"] : null;
    
    $limite = "";
    $dadosUsuarios = new \Tabela\Usuario();
    $dadosPublicacao = new \Tabela\Publicacao();
    $dadosPublicacao = $dadosPublicacao->getDetalhesPublicacao(null, null, " p.id = {$idPublicacao}")[0];
    $usuario = $dadosUsuarios ->getDetalhesUsuario(" u.nome = '{$dadosPublicacao->nomeLocador}'")[0];
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
            <div class="CMS_main" id="pag-publicacao-detalhes">
                <?php include("layout/menu.php") ?>
                <div id="box-caminho">
                    <a href="home.php" class="link-caminho">Home</a> &gt;
                    <a href="clientes.php" class="link-caminho">Clientes</a> &gt;
                    <a href="publicacoes.php" class="link-caminho">Publicações</a> &gt;
                    <a href="publicacao_detalhe.php" class="link-caminho">Detalhes da Publicação</a>
                </div>
                <div class="box-publicacao">
                    <div id="nome-publicacao" class="boxes-publicacao">
                        <?php echo $dadosPublicacao->titulo; ?>
                    </div>
                    <div id="imagens-publicacao">
                        <?php
                            $pasta = "../img/uploads/publicacoes";
                        ?>
                        <img src="<?php echo File::read($dadosPublicacao->imagemPrincipal, $pasta); ?>"/>
                        <img src="<?php echo File::read($dadosPublicacao->imagemA, $pasta); ?>"/>
                        <img src="<?php echo File::read($dadosPublicacao->imagemB, $pasta); ?>"/>
                        <img src="<?php echo File::read($dadosPublicacao->imagemC, $pasta); ?>"/>
                        <img src="<?php echo File::read($dadosPublicacao->imagemD, $pasta); ?>"/>
                    </div>
                    <div id="modelo-publicacao" class="box-label-info">
                        <p class="label">Modelo:</p>
                        <p class="info"><?php echo $dadosPublicacao->modeloVeiculo; ?></p>                        
                    </div>
                    <div id="modelo-publicacao" class="box-label-info">
                        <p class="label">Proprietário:</p>
                        <p class="info"><?php echo $dadosPublicacao->nomeLocador; ?></p>                        
                    </div>
                    <div id="reputacao-publicacao" class="box-label-info">
                        <p class="label">Média de Avaliações:</p>
                        <div class="box-avaliacoes">                            
                            <div class="container-icone-avaliacoes">
                                <?php 
                                    $usuario->qtdAvaliacoes; 


                                    $lista_estrelas = [
                                        "icone-avaliacao inativa",
                                        "icone-avaliacao inativa",
                                        "icone-avaliacao inativa",
                                        "icone-avaliacao inativa",
                                        "icone-avaliacao inativa"
                                    ];                                                                                
                                                                        
                                    for( $i = 0; $i < round($usuario->mediaNotas); ++$i ) {
                                        $lista_estrelas[$i] = "icone-avaliacao";                           
                                    }                                                                            

                                    foreach( $lista_estrelas as $classe_estrela ) {
                                        echo "<div class=\"" . $classe_estrela . "\"></div>";
                                    }                                                                        
                                ?>
                            </div>
                        </div>
                    </div>
                    <div id="data-publicacao" class="box-label-info">
                        <p class="label">Data da Publicação:</p>
                        <p class="info"><?php echo $dadosPublicacao->dataPublicacao; ?></p>
                    </div>
                    <div id="diaria-publicacao" class="box-label-info">
                        <p class="label">Diária:</p>
                        <p class="info">R$<?php echo $dadosPublicacao->valorDiaria; ?></p>                        
                    </div>
                    <?php if( isset( $dadosPublicacao->combustivel ) ) { ?>
                    <div id="combustivel-publicacao" class="box-label-infoo">
                        <p class="label">Tipo de Combustível:</p>
                        <p class="info"><?php echo $dadosPublicacao->combustivel; ?></p>                        
                    </div>
                    <?php } ?>
                    <div id="distancia-publicacao" class="box-label-info">
                        <p class="label">Kms Rodados:</p>
                        <p class="info"><?php echo $dadosPublicacao->quilometragemAtual; ?></p>
                    </div>
                    <div id="botoes-publicacao">
                        <a class="preset-botao js-btn-aprovar" href="apis/analise_publicacao.php?modo=aceitar&idPublicacao=<?php echo $idPublicacao; ?>">Aprovar</a>
                        <a class="preset-botao js-btn-recusar" href="apis/analise_publicacao.php?modo=recusar&idPublicacao=<?php echo $idPublicacao; ?>">Recusar</a>
                    </div>
                </div>
            </div>
            <?php
                include("layout/footer.php");
            ?>
        </div>      
	</body>
</html>