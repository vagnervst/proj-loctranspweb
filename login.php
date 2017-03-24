<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Home | City Share</title>
        <meta name="viewport" content="width=device-width" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="css/style.css">
        <link rel="icon" href="img/icones/logoCityShareIcon.png">
    </head>
    <body>
        <div id="container">
            <?php require_once("layout/header.php"); ?>
            <div class="main" id="pag-login">
                <div class="imagem-divisao-conteudo imagem-principal"></div>
                <div id="box-login">
                    <form method="post" action="#">
                        <div class="label-input">
                            <label><span class="label">Email</span>
                                <input class="preset-input-text input" type="text"/>
                            </label>
                        </div>
                        <div class="label-input">
                            <label><span class="label">Senha</span>
                                <input class="preset-input-text input" type="text"/>
                            </label>
                        </div>
                        <input class="preset-input-submit" id="botao-entrar" type="submit" value="Entrar"/>
                    </form>
                </div>
            </div>
            <!-- CONTEUDO PRINCIPAL -->
        </div>
        <?php require_once("layout/footer.php"); ?>
        <script src="js/libs/jquery-3.1.1.min.js"></script>
        <script src="js/script.js"></script>
    </body>
</html>