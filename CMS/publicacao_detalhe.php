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
                    <a href="home.php" class="link-caminho" >Home</a> ><a href="clientes.php" class="link-caminho"> Clientes</a> ><a href="publicacoes.php" class="link-caminho"> Publicações</a> ><a href="publicacao_detalhe.php" class="link-caminho"> Detalhes da Publicação</a>
                </div>
                <div class="box-publicacao">
                    <div id="nome-publicacao" class="boxes-publicacao">
                        <?php echo $dadosPublicacao->titulo; ?>
                    </div>
                    <div id="imagens-publicacao">
                        <img src="<?php File::read($dadosPublicacao->imagemPrincipal, "../../img/uploads/publicacoes/");?>"/>
                        <img src="<?php File::read($dadosPublicacao->imagemA, "../../img/uploads/publicacoes/");?>"/>
                        <img src="<?php File::read($dadosPublicacao->imagemB, "../../img/uploads/publicacoes/");?>"/>
                        <img src="<?php File::read($dadosPublicacao->imagemC, "../../img/uploads/publicacoes/");?>"/>
                        <img src="<?php File::read($dadosPublicacao->imagemD, "../../img/uploads/publicacoes/");?>"/>
                    </div>
                    <div id="modelo-publicacao" class="boxes-publicacao">
                        Modelo: <?php echo $dadosPublicacao->modeloVeiculo; ?>
                    </div>
                    <div id="proprietario-publicacao" class="boxes-publicacao">
                        Proprietário: <?php echo $dadosPublicacao->nomeLocador; ?>
                    </div>
                    <div id="reputacao-publicacao" class="boxes-publicacao">
                        <div class="box-avaliacoes">
                            <p class="avaliacoes-locador">Avaliações: <?php echo $usuario->qtdAvaliacoes; ?></p>
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

                                    for( $i = 0; $i < $usuario->mediaNotas; ++$i ) {
                                        $lista_estrelas[$i] = "icone-avaliacao";                           
                                    }                                                                            

                                    foreach( $lista_estrelas as $classe_estrela ) {
                                        echo "<div class=\"" . $classe_estrela . "\"></div>";
                                    }                                                                        
                                ?>
                            </div>
                        </div>
                    </div>
                    <div id="data-publicacao" class="boxes-publicacao">
                        Data da Publicação: <?php echo $dadosPublicacao->dataPublicacao; ?>
                    </div>
                    <div id="diaria-publicacao" class="boxes-publicacao">
                        Diária: R$<?php echo $dadosPublicacao->valorDiaria; ?>
                    </div>
                    <div id="combustivel-publicacao" class="boxes-publicacao">
                        Tipo de Combustível: <?php echo $dadosPublicacao->combustivel; ?>
                    </div>
                    <div id="distancia-publicacao" class="boxes-publicacao">
                        Kms Rodados: <?php echo $dadosPublicacao->quilometragemAtual; ?>
                    </div>
                    <div id="botoes-publicacao">
                        <span class="preset-botao js-btn-aprovar">aprovar</span><span class="preset-botao js-btn-recusar">recusar</span>
                    </div>
                </div>
            </div>
            <?php
                include("layout/footer.php");
            ?>
        </div>      
	</body>
</html>