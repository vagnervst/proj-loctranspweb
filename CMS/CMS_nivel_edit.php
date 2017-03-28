<?php
    require_once("../include/initialize.php");
    $dadosNivelAcessoCS = new \Tabela\NivelAcessoCS();
    $id = (isset($_GET["idNivelAcesso"]))? $_GET["idNivelAcesso"] : null;
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
            
            if( empty($buscaDados[0]) ) {                
                $idNovoNivel = $objNivelAcessoCS->inserir();                                
                
                if( count($permissoes) > 0 ) {
                    foreach( $permissoes as $item ) {                    
                        $objNivelAcessoCS->inserirRelacionamento($idNovoNivel, $item);
                    }
                }
                
            } else {
                $objNivelAcessoCS->atualizar();
                
                if( count($permissoes) > 0 ) {
                    foreach( $permissoes as $item ) {
                        $objNivelAcesso->deletarRelacionamento($id);
                    }
                    foreach($permissoes as $item ) {
                        $objNivelAcessoCS->inserirRelacionamento($id, $item);
                    }
                }
            }
        }
        
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
                                <a href="CMS_clientes.php">Clientes</a>
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
                <form action="CMS_nivel_edit.php" method="post" enctype="multipart/form-data">
                    <div class="box-conteudo">
                        <div class="container-campos">
                            <div class="box-input-pagina">
                                <label class="titulo-input">Titulo
                                    <input type="text" class="input-pagina" name="txtTitulo">
                                </label>
                            </div>
                            <?php
                                $buscaPermissoes = new \Tabela\PermissaoCS();
                                $listaPermissoes = $buscaPermissoes->buscar();
                            
                                foreach( $listaPermissoes as $permissao ) {
                            ?>
                            <div class="box-input-checkbox">
                                <box class="box-checkbox">                                    
                                    <input type="checkbox" class="input-checkbox" value="<?php echo $permissao->id; ?>" name="checkbox_list[]"/>
                                    <label class="label-checkbox"><?php echo $permissao->titulo; ?></label>
                                </box>
                            </div>
                            <?php } ?>
                            <div class="box-botao">
                                <input type="submit" class="preset-input-submit" name="formSubmit" value="Salvar">
                                <a class="preset-botao" href="#">Remover</a>
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