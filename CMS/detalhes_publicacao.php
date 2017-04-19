<?php
    require_once("../include/initialize.php");
    require_once("../include/classes/tbl_publicacao.php");
    require_once("../include/classes/tbl_acessorio_veiculo.php");
    
    $idUsuario = ( isset($_GET["idUsuario"]) )? $_GET["idUsuario"] : null;
    $idPublicacao = ( isset($_GET["idPublicacao"]) )? $_GET["idPublicacao"] : null;
    
    $dadosPublicacao = new \Tabela\Publicacao();
    $dadosUsuario = new \Tabela\Usuario();
    $dadosPublicacao = $dadosPublicacao->getPublicacao("u.id = {$idUsuario} AND p.id = {$idPublicacao}")[0];
    $dadosUsuario  = $dadosUsuario->getDetalhesUsuario("u.id = {$idUsuario}")[0];
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
                    <a href="CMS_home.php" class="link-caminho" >Home</a> ><a href="clientes.php" class="link-caminho"> Clientes</a> > <a href="usuario.php" class="link-caminho" >Usuarios</a> > <a href="info_usuario.php?id=<?php echo $idUsuario ?>" class="link-caminho" >Informações do usuário</a> > <a href="#" class="link-caminho" >Detalhes Publicação</a>
                </div>
                <div class="box-conteudo">
                    <a class="preset-botao" id="botao-voltar" href="info_usuario.php?id=<?php echo $idUsuario ?>">←</a>
                    <div class="info-usuario">
                        <span class="dados-usuario">Nome: <?php echo $dadosPublicacao->nomeLocador; ?></span>
                        <span class="dados-usuario">Localidade: <?php echo $dadosUsuario->estado . ", " . $dadosUsuario->cidade; ?></span>
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
                                    <p>Acessorio A</p>
                                    <p>Acessorio B</p>
                                    <p>Acessorio C</p>
                                </div>
                            </div>
                        </section>
                        <div class="separacao"></div>
                        <section class="conteudo-publicacao">
                            <p class="subtitulo">Detalhes Específicos do Veículo</p>
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