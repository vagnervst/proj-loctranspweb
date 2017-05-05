<?php
    require_once("../include/initialize.php");
    require_once("../include/classes/tbl_pedido.php");
    require_once("../include/classes/tbl_veiculo.php");
    require_once("../include/classes/tbl_acessorio_veiculo.php");
    
    $idUsuario = ( isset($_GET["idUsuario"]) )? $_GET["idUsuario"] : null;
    $idPedido = ( isset($_GET["idPedido"]) )? $_GET["idPedido"] : null;
    
    $dadosPedido = new \Tabela\Pedido();
    $dadosPedido = $dadosPedido->listarPedidos("p.idUsuarioLocador = {$idUsuario} AND p.id = {$idPedido}")[0];
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
            <div class="CMS_main" id="pag-detalhes-pedido">
                <?php include("layout/menu.php") ?>
                <div id="box-caminho">
                    <a href="home.php" class="link-caminho" >Home</a> ><a href="clientes.php" class="link-caminho"> Clientes</a> > <a href="usuario.php" class="link-caminho" >Usuarios</a> > <a href="info_usuario.php?id=<?php echo $idUsuario ?>" class="link-caminho" >Informações do usuário</a> > <a href="#" class="link-caminho" >Detalhes Pedido</a>
                </div>
                <div class="box-conteudo">
                    <a class="preset-botao" id="botao-voltar" href="info_usuario.php?id=<?php echo $idUsuario ?>">←</a>
                    <div class="box-info-pedido">
                        <p class="info-pedido">Locatário: <?php echo $dadosPedido->nomeLocatario . " " . $dadosPedido->sobrenomeLocatario; ?></p>
                        <p class="info-pedido">Locador: <?php echo $dadosPedido->nomeLocador . " " . $dadosPedido->sobrenomeLocador; ?></p>
                        <p class="info-pedido">Veiculo: <?php echo $dadosPedido->veiculo; ?></p>
                        <p class="info-pedido">Data de Retirada: <?php echo $dadosPedido->dataRetirada; ?></p>
                        <p class="info-pedido">Data de Entrega: <?php echo $dadosPedido->dataEntrega; ?></p>
                        <p class="info-pedido">Status do Pedido: <?php echo $dadosPedido->statusPedido; ?></p>
                        <p class="info-pedido">Valor da Diária: R$<?php echo $dadosPedido->valorDiaria; ?></p>
                        <p class="info-pedido">Diárias: <?php echo $dadosPedido->diarias; ?></p>
                        <p class="info-pedido">Valor Total: R$<?php echo $dadosPedido->valorTotal; ?></p>
                    </div>
                </div>
            </div>
            <?php
                include("layout/footer.php");
            ?>
        </div>      
	</body>
</html>