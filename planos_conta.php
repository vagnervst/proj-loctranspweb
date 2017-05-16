<?php
    require_once("include/initialize.php");
    require_once("include/classes/sessao.php");
    require_once("include/classes/tbl_usuario.php");
    require_once("include/classes/tbl_plano_conta.php");
    require_once("include/classes/tbl_licenca_desktop.php");
    
    $sessao = new Sessao();
    $idUsuario = $sessao->get("idUsuario");

    if( empty($idUsuario) ) {
        redirecionar_para("logout_action.php");
    } else {
    
        $dadosUsuario = new \Tabela\Usuario();
        $dadosUsuario = $dadosUsuario->getDetalhesUsuario("u.id = {$idUsuario}")[0];
    }

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Contato | City Share</title>
        <meta name="viewport" content="width=device-width"/>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="css/style.css">
        <link rel="icon" href="img/icones/logoCityShareIcon.png">
    </head>
    <body>
        <div id="container">
            <?php require_once("layout/header.php"); ?>
            <div class="main" id="pag-planos-conta">
                <div class="box-conteudo">
                    <p class="titulo">Planos de Conta</p>
                    <p class="subtitulo">Planos Web</p>
                    <div class="container-planos">
                        <div class="box-overflow">
                        <?php   
                            $dadosPlanoConta = new \Tabela\PlanoConta();
                            $listaPlanoConta = $dadosPlanoConta->getPlanos(null, null, " visivel = 1 ");
                            $idPlano = ( isset($_GET["idPlano"]) )? (int) $_GET["idPlano"] : null;
                                
                            if( empty($idPlano) ) {
                                foreach( $listaPlanoConta as $plano ) {
                        ?>
                            <div class="box-plano">
                                <div class="titulo"><?php echo $plano->nome; ?></div>
                                <div class="info-plano">
                                    <p class="txt-info">Limite de publicações: <?php echo $plano->limitePublicacao; ?></p>
                                    <p class="txt-info">Duração do Plano: <?php echo $plano->duracaoMeses; ?> meses</p>
                                    <p class="txt-info"><?php echo $plano->descPlano; ?></p>
                                    <p class="txt-info">Preço: R$<?php echo $plano->preco; ?></p>
                                </div>
                                <div class="box-botao">
                                    <a href="planos_conta.php?idPlano=<?php echo $plano->id; ?>" class="preset-botao">Assinar</a>
                                </div>
                            </div>
                        <?php }
                            }  
                                    
                            ?>
                            <div class="box-plano">
                                <form>
                                    <div class="titulo"></div>
                                </form>
                            </div>
                            
                        </div>
                    </div>
                    <?php if( $dadosUsuario->tipoConta == "Juridico" ) {  ?>
                    <p class="subtitulo">Planos Desktop</p>
                    <div class="container-planos">
                        <div class="box-overflow">
                        <?php
                            $dadosLicencaDesktop = new \Tabela\LicencaDesktop();
                            $listaLicencaDesktop = $dadosLicencaDesktop->getLicencas();
    
                            foreach( $listaLicencaDesktop as $licenca ) { 
                        ?>
                            <div class="box-plano">
                                <div class="titulo"><?php echo $licenca->nome; ?></div>
                                <div class="info-plano">
                                    <p class="txt-info">Conexões Simultâneas<?php echo $licenca->conexoesSimultaneas; ?></p>
                                    <p class="txt-info">Duração da Licença: <?php echo $licenca->duracaoMeses; ?></p>
                                    <p class="txt-info">Preço: <?php echo $licenca->preco; ?></p>
                                </div>
                                <div class="box-botao">
                                    <a href="planos_conta.php?idLicenca=<?php echo $licenca->id; ?>" class="preset-botao">Assinar</a>
                                </div>
                            </div>
                        <?php } ?>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>            
        </div>
        <?php require_once("layout/footer.php"); ?>
        <script src="js/libs/jquery-3.1.1.min.js"></script>
        <script src="js/script.js"></script>
    </body>
</html>