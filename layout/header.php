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
                if( $sessao->get("idUsuario") == null ) { 
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
                <div id="box-notificacoes">
                    <span id="icone-notificacao"></span>
                    <span id="contagem-notificacoes"><p id="label">1</p></span>
                </div>
                <div id="imagem-perfil">
                    <?php 
                          $caminhoFoto = "img/uploads/usuarios/";
                    ?>
                    <img src="<?php echo File::read($usuario->fotoPerfil, $caminhoFoto)?>" />
                </div>
                <div id="box-info-usuario">
                    <p id="nome-usuario"><?php echo $usuario->nome . " " . substr($usuario->sobrenome, 0, 1); ?></p>                    
                </div>
                <div class="js-popup-painel" id="box-menu-usuario">
                    <ul id="menu-usuario">
                        <li><a href="perfil.php?id=<?php echo $idUsuario; ?>">Perfil</a></li>
                        <li><a href="solicitacoes.php?user=<?php echo $idUsuario; ?>">Pedidos</a></li>
                        <li><a href="publicar.php?user=<?php echo $idUsuario; ?>">Anuncie</a></li>
                        <li><a href="planos_conta.php">Planos de Conta</a></li>
                        <li><a href="configuracoes.php">Configurações</a></li>
                        <li><a href="logout_action.php">Sair</a></li>
                    </ul>
                </div>
                <!-- MENU DE USUÁRIO -->
                <section class="js-popup-painel" id="box-menu-notificacoes">        
                    <h1 id="titulo-box-notificacoes">Notificações</h1>
                    <div id="container-notificacoes"></div>
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