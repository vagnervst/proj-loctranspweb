<?php
    require_once("../include/initialize.php");
    require_once("../include/classes/tbl_nivel_acesso_cs.php");
    require_once("../include/classes/tbl_permissao_cs.php");

    $modo = ( isset($_GET["modo"]) )? : null;
    
    $dadosNivelAcessoCS = new \Tabela\NivelAcessoCS();
    $id = (isset($_GET["id"]))? (int) $_GET["id"] : null;
    $buscaDados = $dadosNivelAcessoCS->buscar("id = {$id}");

    if( !empty($buscaDados[0]) ) $dadosNivelAcessoCS = $buscaDados[0];

    $form = ( isset($_POST["formSubmit"]) )? $_POST["formSubmit"] : null;
    
    if( !empty( $form ) ) {        
        $titulo = ( isset( $_POST["txtTitulo"] ) )? $_POST["txtTitulo"] : null;
        $permissoes = ( isset( $_POST["checkbox_list"] ) )? $_POST["checkbox_list"] : [];
        
        $listaRequiredInputs = [];
        $listaRequiredInputs[] = $titulo;        
        
        if( !FormValidator::has_empty_input( $listaRequiredInputs ) ) {
            $objNivelAcessoCS = new \Tabela\NivelAcessoCS();
            
            $objNivelAcessoCS->nome = $titulo;
            $objNivelAcessoCS->visivel = 1;
            
            if( empty($buscaDados[0]) ) {                
                $idNovoNivel = $objNivelAcessoCS->inserir();                                
                
                if( count($permissoes) > 0 ) {
                    foreach( $permissoes as $item ) {                    
                        $objNivelAcessoCS->inserirRelacionamento($idNovoNivel, $item);
                    }
                }
                
                redirecionar_para("cityshare_nivelAcesso.php");
            } else {
                $objNivelAcessoCS->id = $id;
                $objNivelAcessoCS->atualizar();
                
                if( count($permissoes) > 0 ) {                                        
                    $objNivelAcessoCS->deletarRelacionamentos();
                                        
                    foreach($permissoes as $item ) {
                        $objNivelAcessoCS->inserirRelacionamento($id, $item);
                    }
                }
            }
            
            redirecionar_para("cityshare_nivelAcesso.php?id={$id}");
        }
        
    } elseif( !empty($modo) && $modo == "remover" ) {
        $objNivelAcessoCS = new \Tabela\NivelAcessoCS();
        $objNivelAcessoCS->id = $id;
        $objNivelAcessoCS->visivel = 0;
                
        $objNivelAcessoCS->atualizar();
        
        //redirecionar_para("cityshare_nivelAcesso.php?id={$id}");
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
                    <a href="home.php" class="link-caminho">Home</a> &gt; 
                    <a href="cityshare.php" class="link-caminho">City Share</a> &gt; 
                    <a href="cityshare_nivelAcesso.php" class="link-caminho">Níveis de Acesso</a> &gt; 
                    <a href="#" class="link-caminho">Editar/Novo</a>
                </div>
                <form action="nivel_acesso.php<?php echo (!empty($id))? "?id=" . $id : ""; ?>" method="post">
                    <div class="box-conteudo">
                        <div class="container-campos">
                            <div class="box-input-pagina">
                                <label class="titulo-input"><span class="label">Titulo:</span>
                                    <input type="text" class="input-pagina" value="<?php echo $dadosNivelAcessoCS->nome; ?>" name="txtTitulo">
                                </label>
                            </div>
                            <?php
                                $buscaPermissoes = new \Tabela\PermissaoCS();
                                $listaPermissoes = $buscaPermissoes->buscar();
                                
                                $permissoesNivel = new \Tabela\NivelAcessoCS();                                
                                $permissoesNivel = $permissoesNivel->getNivelAcesso_permissoes( $id );     
                                                                
                                foreach( $listaPermissoes as $permissao ) {
                            ?>
                            <div class="box-input-checkbox">
                                <box class="box-checkbox">
                                    <label class="label-checkbox">                                    
                                        <input type="checkbox" class="input-checkbox" value="<?php echo $permissao->id; ?>" name="checkbox_list[]" <?php echo ( in_array($permissao->id, $permissoesNivel) )? "checked" : ""; ?>/>
                                        <?php echo $permissao->titulo; ?>
                                    </label>
                                </box>
                            </div>
                            <?php } ?>
                            <div class="box-botao">
                                <input type="submit" class="preset-input-submit" name="formSubmit" value="Salvar">
                                <?php if( !empty($id) ) { ?>
                                <a class="preset-botao" href="nivel_acesso.php?modo=remover&id=<?php echo $id;?>">Remover</a>
                                <?php } ?>
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