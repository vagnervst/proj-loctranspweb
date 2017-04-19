<?php
    require_once("../../include/initialize.php");
    require_once("../../include/classes/tbl_publicacao.php");
    
    $id = ( isset($_POST["idUsuario"]) )? $_POST["idUsuario"] : null;
    
    $dadosPublicacao = new \Tabela\Publicacao();
    $dadosPublicacao = $dadosPublicacao->getPublicacao("u.id = {$id}");
    
    if( empty( $dadosPublicacao ) ) {
        echo "<h3>Não há publicações registradas neste usuário</h3>";
        exit;
    }    

    foreach( $dadosPublicacao as $publicacao ) {
?>
<div class="box-publicacao">
    <div class="image-publicacao">
        <img src="<?php echo File::read($publicacao->imagemPrincipal, "../img/uploads/publicacoes/"); ?>"/>
    </div>
    <p class="titulo-publicacao"><?php echo $publicacao->titulo; ?></p>
    <div class="status-detalhes">
        <p class="status-publicacao">Status: <?php echo $publicacao->tituloStatus; ?></p>
        <a class="preset-botao" href="detalhes_publicacao.php?idUsuario=<?php echo $id ?>&idPublicacao=<?php echo $publicacao->idPublicacao; ?>">i</a>
    </div>    
</div>
<?php } ?>