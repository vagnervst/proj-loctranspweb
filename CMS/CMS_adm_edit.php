<?php
    require_once("../include/initialize.php");

    $id = ( isset($_GET["id"]) )? $_GET["id"] : null;
    
    $textoBotao = "";
    $dadosUsuario = new \Tabela\UsuarioCS();

    $erros = [];
    if( empty($id) ) {
        $textoBotao = "Adicionar";
    } elseif( !empty($id) ) {
        $textoBotao = "Salvar";
        $dadosUsuario = $dadosUsuario->buscar("id = {$id}")[0];
    }
    
    if( isset($_POST["formSubmit"]) ) {
        $nome = ( isset($_POST["txtNome"]) )? $_POST["txtNome"] : null;
        $sobrenome = ( isset($_POST["txtSobrenome"]) )? $_POST["txtSobrenome"] : null;
        $usuario = ( isset($_POST["txtUsuario"]) )? $_POST["txtUsuario"] : null;
        $senha = ( isset($_POST["txtSenha"]) )? $_POST["txtSenha"] : null;
        $novaSenha = ( isset($_POST["txtNovaSenha"]) )? $_POST["txtNovaSenha"] : null;
        $nivelAcesso = ( isset($_POST["slNivelAcesso"]) )? $_POST["slNivelAcesso"] : null;
        
        $listaRequiredInputs = [];
        $listaRequiredInputs[] = $nome;
        $listaRequiredInputs[] = $sobrenome;
        $listaRequiredInputs[] = $usuario;
        
        if( empty( $id ) ) {
            $listaRequiredInputs[] = $senha;
        }
        
        if( !FormValidator::has_empty_input( $listaRequiredInputs ) ) {
        
            $objUsuario = new \Tabela\UsuarioCS();
            $objUsuario->id = $id;
            $objUsuario->nome = $nome;
            $objUsuario->sobrenome = $sobrenome;
            $objUsuario->usuario = $usuario;
            
            if( empty( $id ) ) $objUsuario->senha = Autenticacao::hash( $senha );
            
            $objUsuario->idNivelAcesso = $nivelAcesso;            

            if( empty($id) ) {                
                $objUsuario->inserir();
                redirecionar_para("CMS_cityshare_adm.php");
            } else {
                
                if( !empty($senha) && !empty($novaSenha) ) {
                    
                    if( \Tabela\UsuarioCS::login( $usuario, $senha ) ) {
                        $objUsuario->senha = Autenticacao::hash( $novaSenha );
                        $objUsuario->atualizar();
                        redirecionar_para("CMS_adm_edit.php?id={$id}");
                    } else {
                        $erros[] = "Senha incorreta.";
                    }
                } else {
                    $objUsuario->atualizar();
                    redirecionar_para("CMS_adm_edit.php?id={$id}");
                }                                   
            }            
        }
        
    } elseif( isset($_GET["remover"] ) ) {
        $objUsuario = new \Tabela\UsuarioCS();
        $objUsuario->id = $id;
        
        $objUsuario->deletar();  
        
        redirecionar_para("CMS_cityshare_adm.php");
    }
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
            <div class="CMS_main" id="pag-cityshare-adm-edit">
                <?php include("layout/menu.php") ?>
                <div id="box-caminho">
                    <a href="CMS_home.php" class="link-caminho" >Home</a> ><a href="cityshare.php" class="link-caminho"> City Share</a> > <a href="CMS_cityshare_adm.php" class="link-caminho" >Administradores</a> > <a href="#" class="link-caminho"
                     >Editar/Novo</a>
                </div>
                <div class="box-conteudo">
                    <div class="container-campos">
                        <?php 
                            if( !empty($erros) ) { 
                        ?>
                            <div id="box-erros">
                                <ul id="erros">
                                    <?php foreach($erros as $itemErro) {?>
                                    <li><?php echo $itemErro; ?></li>
                                    <?php } ?>
                                </ul>
                            </div>
                        <?php } ?>
                       <form method="post" action="CMS_adm_edit.php<?php echo ( !empty($id) )? "?id=" . $id : ""; ?>">
                            <div class="box-input-pagina">
                                <label class="titulo-input">Nome</label>
                                <input type="text" class="input-pagina" value="<?php echo $dadosUsuario->nome; ?>" name="txtNome">
                            </div>
                            <div class="box-input-pagina">
                                <label class="titulo-input">Sobrenome</label>
                                <input type="text" class="input-pagina" value="<?php echo $dadosUsuario->sobrenome; ?>" name="txtSobrenome">
                            </div>
                            <div class="box-input-pagina">
                                <label class="titulo-input">Usuário</label>
                                <input type="text" class="input-pagina" value="<?php echo $dadosUsuario->usuario; ?>" name="txtUsuario">
                            </div>
                            <div class="box-input-pagina">
                                <label class="titulo-input">Senha</label>
                                <input type="password" class="input-pagina" name="txtSenha">
                            </div>
                            <?php
                                if( !empty($id) ) {
                            ?>
                            <div class="box-input-pagina">
                                <label class="titulo-input">Nova Senha</label>
                                <input type="password" class="input-pagina" name="txtNovaSenha">
                            </div>
                            <?php
                                }
                            ?>
                            <div class="box-input-pagina">
                                <label class="titulo-input">Nível de Autentificação</label>
                                <select name="slNivelAcesso">
                                    <option <?php echo ( empty($id) )? "selected" : ""; ?> disabled>Selecione o nível de acesso</option>
                                    <?php
                                        $niveisAcesso = new \Tabela\NivelAcessoCS();
                                        $niveisAcesso = $niveisAcesso->buscar();
                                    
                                        foreach( $niveisAcesso as $nivelAcesso ) {
                                    ?>
                                    <option value="<?php echo $nivelAcesso->id; ?>" <?php echo ( $nivelAcesso->id == $dadosUsuario->idNivelAcesso )? "selected" : ""; ?> ><?php echo $nivelAcesso->nome; ?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="box-botao">
                                <input type="submit" class="preset-input-submit" name="formSubmit" value="<?php echo $textoBotao; ?>">
                                <?php if( !empty($id) ) { ?>
                                <a class="preset-botao" href="CMS_adm_edit.php?remover=true&id=<?php echo $id; ?>">Remover</a>
                                <?php } ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php
                include("layout/footer.php");
            ?>
        </div>      
	</body>
</html>