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
            <div class="CMS_main" id="pag-cityshare-adm-edit">
                <div class="box-menu-lateral">
                     <div class="menu-lateral">
                        <ul>
                            <li class="botao-menu-lateral">
                                <a href="CMS_home.php">Home</a>
                                <img src="Image/50x50.gif"/>
                            </li>
                            <li class="botao-menu-lateral">
                                <a href="#">Clientes</a>
                                <img src="Image/50x50.gif"/>
                            </li>
                            <li class="botao-menu-lateral">
                                <a href="CMS_cityshare.php">City Share</a>
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
                    <a href="CMS_home.php" class="link-caminho" >Home</a> ><a href="CMS_cityshare.php" class="link-caminho"> City Share</a> > <a href="CMS_cityshare_nivelAcesso.php" class="link-caminho" >Níveis de Acesso</a> > <a href="#" class="link-caminho" >Editar/Novo</a>
                </div>
                <div class="box-conteudo">
                    <div class="container-campos">
                        <div class="box-input-pagina">
                            <label class="titulo-input">Nome</label>
                            <input type="text" class="input-pagina">
                        </div>
                        <div class="box-input-pagina">
                            <label class="titulo-input">Usuário</label>
                            <input type="text" class="input-pagina">
                        </div>
                        <div class="box-input-pagina">
                            <label class="titulo-input">Senha</label>
                            <input type="text" class="input-pagina">
                        </div>
                        <div class="box-input-pagina">
                            <label class="titulo-input">Nível de Autentificação</label>
                            <select>
                                <option>Adm</option>
                            </select>
                        </div>
                        <div class="box-botao">
                            <input type="submit" class="preset-input-submit" value="Salvar">
                            <input type="submit" class="preset-input-submit" value="Remover">
                        </div>
                    </div>
                </div>
            </div>
            <?php
                include("layout/footer.php");
            ?>
        </div>      
	</body>
</html>