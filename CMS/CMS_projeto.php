<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>
            CMS - Conteúdo | City Share
		</title>
        <link rel="stylesheet" type="text/css" href="CSS/Style.css">
	</head>
	<body>
        <div id="container">
            <?php
                include("layout/header.php");
            ?>
            <div class="CMS_main" id="pag-cityshare-projeto">
                <div class="box-menu-lateral">
                    <div class="menu-lateral">
                        <ul>
                            <li class="botao-menu-lateral">
                                <a href="#">Home</a>
                                <img src="Image/50x50.gif"/>
                            </li>
                            <li class="botao-menu-lateral">
                                <a href="#">Clientes</a>
                                <img src="Image/50x50.gif"/>
                            </li>
                            <li class="botao-menu-lateral">
                                <a href="#">City Share</a>
                                <img src="Image/50x50.gif"/>
                            </li>
                            <li class="botao-menu-lateral">
                                <a href="#">Desktop</a>
                                <img src="Image/50x50.gif"/>
                            </li>
                        </ul>
                    </div>
                </div>
                <div id="box-caminho">
                    <a href="CMS_home.php" class="link-caminho" >Home</a> ><a href="CMS_cityshare.php" class="link-caminho"> City Share</a> > <a href="CMS_cityshare_conteudo.php" class="link-caminho" >Conteúdo</a> > <a href="#" class="link-caminho">Sobre o Projeto</a>
                </div>
                <form action="#" method="post">
                    <div class="box-conteudo">
                        <p class="titulo-sessao">Prévia</p>
                        <div id="container-previa">
                            <div id="box-img-previa">
                                <img alt="123" title="123" src="Image/banner_test.jpg" class="img-beneficios">
                            </div>
                            <div id="box-texto-previa">
                                <textarea id="input-previa" placeholder="Texto previa"></textarea>
                            </div>
                        </div>
                        <p class="titulo-sessao">Página</p>
                        <div id="container-pagina">
                            <div class="box-input-pagina">
                                <label class="titulo-input">Título</label>
                                <input type="text" class="input-pagina">
                            </div>
                            <div class="box-conteudo-pagina">
                                <div class="conteudo-image">
                                    <img src="Image/banner_test.jpg"/>
                                </div>
                                <div class="conteudo-texto">
                                    <label class="titulo-input">Descrição</label>
                                    <textarea></textarea>
                                </div>
                            </div>
                            <div class="box-conteudo-pagina">
                                <div class="conteudo-image">
                                    <img src="Image/banner_test.jpg"/>
                                </div>
                                <div class="conteudo-texto">
                                    <label class="titulo-input">Descrição</label>
                                    <textarea></textarea>
                                </div>
                            </div>
                            <div class="box-conteudo-pagina">
                                <div class="conteudo-texto-2">
                                    <label class="titulo-input">Conteúdo</label>
                                    <textarea></textarea>
                                </div>
                            </div>
                            <div class="box-botao">
                                <input type="submit" class="preset-input-submit" value="Salvar">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <?php
                include("layout/footer.php");
            ?>
        </div>      
	</body>
</html>