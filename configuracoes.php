<?php 
    require_once("include/initialize.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Home | City Share</title>
        <meta name="viewport" content="width=device-width" />
        <meta charset="utf-8" />        
        <link rel="stylesheet" href="css/style.css">
        <link rel="icon" href="img/icones/logoCityShareIcon.png">        
    </head>
    <body>
        <div id="container">
            <?php require_once("layout/header.php"); ?>            
            <div class="main" id="pag-config-perfil">
                <div class="box-conteudo">
                    <div id="box-botoes">
                        <span id="botao-pessoais" class="botao">
                            <p class="label">Pessoais</p>
                            <div class="icone"></div>
                        </span>
                        <span id="botao-contato" class="botao">
                            <p class="label">Contato</p>
                            <div class="icone"></div>
                        </span>
                        <span id="botao-financeiro" class="botao">
                            <p class="label">Financeiro</p>
                            <div class="icone"></div>
                        </span>
                        <span id="botao-conducao" class="botao">
                            <p class="label">Condução</p>
                            <div class="icone"></div>
                        </span>
                        <span id="botao-autenticacao" class="botao">
                            <p class="label">Autenticação</p>
                            <div class="icone"></div>
                        </span>
                    </div>
                    <div id="box-form">
                        <div id="form-info-pessoais" class="form-conta"></div>
                        <div id="form-info-contato" class="form-conta"></div>
                        <div id="form-info-financeiro" class="form-conta"></div>
                        <div id="form-info-conducao" class="form-conta"></div>
                        <div id="form-info-autenticacao" class="form-conta"></div>
                    </div>
                </div>
            </div>
            <!-- CONTEUDO PRINCIPAL -->
        </div>
        <?php require_once("layout/footer.php"); ?>
        <script src="js/libs/jquery-3.1.1.min.js"></script>        
        <script src="js/script.js"></script>
    </body>
</html>