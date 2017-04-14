<?php
    require_once("../include/initialize.php");
    require_once("../include/classes/tbl_usuario.php");
	require_once("../include/classes/tbl_cnh.php");
    
    $id = ( isset($_GET["id"]) )? $_GET["id"] : null;
    
    $dadosUsuario = new \Tabela\Usuario();
    $dadosUsuario = $dadosUsuario->getDetalhesUsuario("u.id = {$id}")[0];
    $listaCnh = $dadosUsuario->getListaCnh();
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
            <div class="CMS_main" id="pag-info-usuarios">
                <?php include("layout/menu.php") ?>
                <div id="box-caminho">
                    <a href="CMS_home.php" class="link-caminho" >Home</a> ><a href="CMS_clientes.php" class="link-caminho"> Clientes</a> > <a href="usuario.php" class="link-caminho" >Usuarios</a> > <a href="#" class="link-caminho" >Informações do usuário</a>
                </div>
                <div class="box-conteudo">
                    <div class="container-botoes-usuario">
                        <span class="preset-botao" id="botao-informacoes">Informações</span>
                        <span class="preset-botao" id="botao-publicacoes">Publicações</span>
                        <span class="preset-botao" id="botao-pedidos">Pedidos</span>
                    </div>
                    <div class="box-info-pessoais">
                        <section>
                            <div class="box-dados">
                                <label>Nome:</label>
                                <?php echo $dadosUsuario->nome . " " . $dadosUsuario->sobrenome; ?>
                            </div>
                            <div class="box-dados">
                                <label>E-mail:</label>
                                <?php echo $dadosUsuario->email; ?>
                            </div>
                            <div class="box-dados">
                                <label>Sexo:</label>
                                <?php echo $dadosUsuario->sexo; ?>
                            </div>
                            <div class="box-dados">
                                <label>RG:</label>
                                <?php echo $dadosUsuario->rg; ?>
                            </div>
                            <div class="box-dados">
                                <label>CPF:</label>
                                <?php echo $dadosUsuario->cpf; ?>
                            </div>
                            <div class="box-dados">
                                <label>Celular:</label>
                                <?php echo $dadosUsuario->celular; ?>
                            </div>
                            <div class="box-dados">
                                <label>Telefone:</label>
                                <?php echo $dadosUsuario->telefone; ?>
                            </div>
                        </section>
                        <section>
                            <div class="box-dados">
                                <label>Tipo de Conta:</label>
                                <?php echo $dadosUsuario->tipoConta; ?>
                            </div>
                            <div class="box-dados">
                                <label>Plano de Conta:</label>
                                <?php echo $dadosUsuario->planoConta ?>
                            </div>
                            <div class="box-dados">
                                <label>Plano Desktop:</label>
                                <?php echo $dadosUsuario->licencaDesktop ?>
                            </div>
                            <div class="box-dados-cnh">
                                <label>CNH's Cadastrados:</label>
                                <?php 
                                    foreach( $listaCnh as $cnh ){
                                ?>
                                    <p><?php echo $cnh->numeroRegistro; ?></p>
                                <?php } ?>
                            </div>
                            <div class="box-dados">
                                <label>Estado:</label>
                                <?php echo $dadosUsuario->estado; ?>
                            </div>
                            <div class="box-dados">
                                <label>Cidade:</label>
                                <?php echo $dadosUsuario->cidade; ?>
                            </div>
                        </section>
                    </div>
					<div id="container-publicacoes-pedidos"></div>
                </div>
            </div>
            <?php
                include("layout/footer.php");
            ?>
        </div>      
	</body>
</html>