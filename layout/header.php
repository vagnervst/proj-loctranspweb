<?php 
    require_once("include/initialize.php");
    require_once("include/classes/sessao.php");
    require_once("include/classes/tbl_usuario.php");

    if( !isset($contexto) ) $contexto = ""; 
?>
<header>
    <div id="box-cabecalho">
        <div id="mobile-botao-menu"></div>
        <div id="logo-cityshare"></div>
        <?php if( !empty($contexto) && $contexto == "alugue" ) { ?>        
        <div id="desktop-botao-filtragem"></div>
        <!-- BOTAO FILTRAGEM DE VEÍCULOS DESKTOP -->
        <?php } ?>
        <div id="menu-navegacao">
            <ul>
                <li class="botao-menu"><a href="index.php">Home</a></li>
                <li class="botao-menu"><a href="alugue.php">Alugue</a></li>
                <li class="botao-menu"><a href="empreste.php">Empreste</a></li>
                <li class="botao-menu"><a href="contato.php">Contato</a></li>
            </ul>
        </div>
        <div id="box-conta">            
            <?php 
                $sessao = new Sessao();                
                if( empty($sessao->get("idUsuario")) ) { 
            ?>
            <div id="box-login-cadastro">
                <a class="botao-conta" id="botao-login" href="login.php">Entrar</a>
                <a class="botao-conta" id="botao-cadastro" href="cadastro.php">Cadastre-se</a>
            </div>
            <?php } else { ?>
            <?php
                $idUsuario = $sessao->get("idUsuario");
                
                $usuario = new \Tabela\Usuario();
                $usuario = $usuario->buscar("id = {$idUsuario}")[0];
                
                if( empty( $usuario ) ) redirecionar_para("logout_action.php");
            ?>
            <div id="box-info-conta">
                <span id="icone-notificacao"></span>
                <div id="imagem-perfil">
                    <?php 
                          $caminhoFoto = "img/uploads/usuarios/usr_" . $usuario->id;                           
                    ?>
                    <img src="<?php echo File::read($usuario->fotoPerfil, $caminhoFoto)?>" />
                </div>
                <div id="box-info-usuario">
                    <p id="nome-usuario"><?php echo $usuario->nome . " " . substr($usuario->sobrenome, 0, 1); ?></p>
                    <a id="botao-logout" href="logout_action.php">Sair</a>
                </div>
                <div class="js-popup-painel" id="box-menu-usuario">
                    <ul id="menu-usuario">
                        <li><a href="#">Perfil</a></li>
                        <li><a href="#">Configurações</a></li>
                        <li><a href="#">Sair</a></li>
                    </ul>
                </div>
                <!-- MENU DE USUÁRIO -->
                <section class="js-popup-painel" id="box-menu-notificacoes">        
                    <h1 id="titulo-box-notificacoes">Notificações</h1>
                    <div id="container-notificacoes">
                        <?php for($i = 0; $i < 10; ++$i) { ?>
                        <section class="box-notificacao">
                            <a href="#">
                                <img class="icone-notificacao" />
                                <div class="info-notificacao">
                                    <h1 class="titulo-notificacao">Titulo</h1>
                                    <p class="conteudo-notificacao">                                    
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur congue ante at magna pellentesque fringilla. Nam placerat dictum turpis ac pellentesque. Aenean et ligula a nibh tristique ultricies et eu sem. Ut turpis mi, tincidunt id gravida sed, porttitor eu erat. Cras eleifend maximus egestas. Maecenas eget ultrices nibh. Aliquam vitae semper arcu. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. In vel facilisis nulla. Fusce a sem mi. Ut eget tincidunt dolor, eu dictum risus. Nullam volutpat suscipit auctor. Vestibulum vel sem elit. Donec et purus egestas, egestas augue in, molestie dui. Vivamus ut varius felis.
                                    </p>
                                </div>
                            </a>
                        </section>
                        <?php } ?>
                    </div>
                </section>
                <!-- MENU DE NOTIFICACOES --> 
            </div>
            <?php } ?>
        </div>        
        <?php if( !empty($contexto) && $contexto == "alugue" ) { ?>
        <div id="mobile-botao-filtragem-ativo"></div>        
        <!-- BOTAO FILTRAGEM DE VEÍCULOS MOBILE -->
        <?php } else { ?>
        <div id="box-botao-filtragem"></div>
        <?php } ?>
    </div>
</header>            
<!-- CABEÇALHO -->
<div class="js-popup-painel painel-mobile" id="box-mobile-menu">
    <ul id="mobile-menu">
        <li><a class="preset-botao" href="index.php">HOME</a></li>
        <li><a class="preset-botao" href="alugue.php">ALUGUE</a></li>
        <li><a class="preset-botao" href="empreste.php">EMPRESTE</a></li>
        <li><a class="preset-botao" href="contato.php">CONTATO</a></li>
    </ul>
</div>
<!-- MENU DE PAGINAS - MOBILE -->
<?php if( $contexto != "login" ) { ?>
<div id="box-login-fullscreen">
   <div id="box-login">
        <div id="box-form-login">
            <form method="post" action="login_action.php">
                <div class="box-label-input">
                    <label><span class="label">Email</span>
                        <input class="preset-input-text input" type="text" name="txtEmail" placeholder="Digite seu email">
                    </label>
                </div>
                <div class="box-label-input">
                    <label><span class="label">Senha</span>
                        <input class="preset-input-text input" type="password" name="txtSenha" placeholder="Digite sua senha">
                    </label>
                </div>
                <input class="preset-input-submit submit" type="submit" name="submitLogin" value="Entrar" />
            </form>
        </div>
        <span id="botao-fechar-login"></span>
    </div>                
    <div class="slidedown-effect js-slidedown1"></div>
</div>
<!-- LOGIN FULLSCREEN -->
<?php } ?>