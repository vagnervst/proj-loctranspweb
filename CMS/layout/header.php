<?php 
    require_once("../include/initialize.php");
    require_once("../include/classes/sessao.php");
    require_once("../include/classes/tbl_usuario_cs.php");

    $sessao = new Sessao();
    
    $id_usuario = $sessao->get("id_usuario");
    if( empty($id_usuario) ) redirecionar_para("index.php");

    $dados_usuario = new \Tabela\UsuarioCS();    

    $dados_usuario = mysqli_fetch_assoc($dados_usuario->getUsuarios("u.id = {$id_usuario}"));    
?>
<header>
    <div id="box-cabecalho">
        <div id="box-image-logo"></div>
        <div id="box-conta">            
            <div id="box-info-usuario">
                <p id="nome-usuario"><?php echo $dados_usuario["nome"] . " " . substr($dados_usuario["sobrenome"], 0, 1) ?></p>
                <p id="nivel-usuario"><?php echo $dados_usuario["nivelAcesso"]; ?></p>
                <div id="box-logout">
                    <a class="preset-botao" id="botao-logout" href="logoff.php">Sair</a>
                </div>
            </div>                        
        </div>
    </div>
</header>