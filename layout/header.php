<header>
    <div id="box-cabecalho">
        <div id="mobile-botao-menu"></div>
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
                $contaAtiva = false;
            ?>
            <?php if( !$contaAtiva ) { ?>
            <div id="box-login-cadastro">
                <a class="botao-conta" href="login.php">Entrar</a>
                <a class="botao-conta" id="botao-cadastro" href="cadastro.php">Cadastre-se</a>
            </div>
            <?php } else { ?>
            <div id="box-info-conta">
                <span id="icone-notificacao"></span>
                <div id="imagem-perfil">                            
                    <img src="img/link_face.jpg" />
                </div>
                <div id="box-info-usuario">
                    <p id="nome-usuario">Nome do Usuario</p>
                    <a id="botao-logout" href="#">Sair</a>
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