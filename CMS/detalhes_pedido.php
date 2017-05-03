<?php
    require_once("../include/initialize.php");
    require_once("../include/classes/tbl_publicacao.php");
    require_once("../include/classes/tbl_veiculo.php");
    require_once("../include/classes/tbl_acessorio_veiculo.php");
    
    $idUsuario = ( isset($_GET["idUsuario"]) )? $_GET["idUsuario"] : null;
    $idPublicacao = ( isset($_GET["idPublicacao"]) )? $_GET["idPublicacao"] : null;
    $idVeiculo = ( isset($_GET["idVeiculo"]) )? $_GET["idVeiculo"] : null;
    
    $dadosPublicacao = new \Tabela\Publicacao();
    $dadosAcessorio = new \Tabela\Veiculo();
    $dadosAcessorio = $dadosAcessorio->getAcessorios("v.id = {$idVeiculo}");
    $dadosPublicacao = $dadosPublicacao->getDetalhesPublicacao("u.id = {$idUsuario} AND p.id = {$idPublicacao} AND v.id = {$idVeiculo}")[0];
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
            <div class="CMS_main" id="pag-detalhes-publicacao">
                <?php include("layout/menu.php") ?>
                <div id="box-caminho">
                    <a href="home.php" class="link-caminho" >Home</a> ><a href="clientes.php" class="link-caminho"> Clientes</a> > <a href="usuario.php" class="link-caminho" >Usuarios</a> > <a href="info_usuario.php?id=<?php echo $idUsuario ?>" class="link-caminho" >Informações do usuário</a> > <a href="#" class="link-caminho" >Detalhes Publicação</a>
                </div>
                <div class="box-conteudo">
                    <a class="preset-botao" id="botao-voltar" href="info_usuario.php?id=<?php echo $idUsuario ?>">←</a>
                    <div class="info-usuario">
                        <span class="dados-usuario">Nome: <?php echo $dadosPublicacao->nomeLocador; ?></span>
                        <span class="dados-usuario">Localidade: <?php echo $dadosPublicacao->estado . ", " . $dadosPublicacao->cidade; ?></span>
                        <div class="container-icone-avaliacoes">
                            <p class="titulo">Avaliação:</p>
                            <div class="icone-avaliacao"></div>
                            <div class="icone-avaliacao"></div>
                            <div class="icone-avaliacao"></div>
                            <div class="icone-avaliacao"></div>
                            <div class="icone-avaliacao"></div>
                        </div>
                    </div>
                    <div class="box-publicacao">
                        <section class="conteudo-publicacao">
                            <p class="titulo-publicacao"><?php echo $dadosPublicacao->titulo; ?></p>
                            <p class="subtitulo"><?php echo $dadosPublicacao->modeloVeiculo; ?></p>
                            <div class="box-imagens-publicacao">
                                <img src="<?php echo File::read($dadosPublicacao->imagemPrincipal, "../img/uploads/publicacoes/"); ?>"/>
                                
                                <img src="<?php echo File::read($dadosPublicacao->imagemA, "../img/uploads/publicacoes/"); ?>"/>
                                
                                <img src="<?php echo File::read($dadosPublicacao->imagemB, "../img/uploads/publicacoes/"); ?>"/>
                                
                                <img src="<?php echo File::read($dadosPublicacao->imagemC, "../img/uploads/publicacoes/"); ?>"/>
                                
                                <img src="<?php echo File::read($dadosPublicacao->imagemD, "../img/uploads/publicacoes/"); ?>"/>
                            </div>
                            <div class="box-descricao">
                                <p class="subtitulo">Descrição</p>
                                <div class="descricao">
                                    <?php echo $dadosPublicacao->descricao; ?>
                                </div>
                            </div>
                            <div class="container-acessorios">
                                <p class="subtitulo">Acessórios</p>
                                <div class="box-acessorios">
                                    <?php foreach( $dadosAcessorio as $acessorio ) { ?>
                                    <p><?php echo $acessorio->nome; ?></p>
                                    <?php }?>
                                </div>
                            </div>
                        </section>
                        <div class="separacao"></div>
                        <section class="conteudo-publicacao">
                            <p class="subtitulo">Detalhes Específicos do Veículo</p>
                            <div class="info-publicacao">
                                <p class="info">Tipo de Combustível: <?php echo $dadosPublicacao->combustivel; ?></p>
                                <p class="info">Tipo de Transmissão: <?php echo $dadosPublicacao->transmissao; ?></p>
                                <p class="info">Fabricante: <?php echo $dadosPublicacao->fabricante; ?></p>
                                <p class="info">Quantidade de portas: <?php echo $dadosPublicacao->qtdPortas; ?></p>
                            </div>
                        </section>
                    </div>
                    <div class="lista-pedidos">
                        
                    </div>
                </div>
            </div>
            <?php
                include("layout/footer.php");
            ?>
        </div>      
	</body>
</html>