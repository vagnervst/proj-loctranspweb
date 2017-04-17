<?php
    require_once("../../include/initialize.php");
    require_once("../../include/classes/tbl_publicacao.php");
    $id = 2;
    $dadosPublicacao = new \Tabela\Publicacao();
    $dadosPublicacao = $dadosPublicacao->getPublicacao("u.id = {$id}")[0];
    sleep(3);
?>
<div class="box-publicacao">
    <div class="image-publicacao">
        <img src="<?php echo $dadosPublicacao->imagemPrincipal; ?>"/>
    </div>
    <p class="titulo-publicacao"><?php echo $dadosPublicacao->titulo; ?></p>
    <p class="status-publicacao">blabla</p>
</div>