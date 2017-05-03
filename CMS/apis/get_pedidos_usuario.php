<?php
    require_once("../../include/initialize.php");
    require_once("../../include/classes/tbl_pedido.php");
    
    $id = ( isset($_POST["idUsuario"]) )? $_POST["idUsuario"] : null;
    
    $dadosPedido = new \Tabela\Pedido();
    $dadosPedido = $dadosPedido->getPedido("u.id = {$id}");
    
    if( empty( $dadosPedido ) ) {
        echo "<h3>Não há pedidos registrados neste usuário</h3>";
        exit;
    }
?>
<p class="titulo-pedidos">Pedidos Realizados:</p>
<?php foreach( $dadosPedido as $pedido ) { ?>
<div class="box-pedido">
    <p class="locador-pedido"><?php echo $pedido->nomeLocador; ?></p>
    <p class="data-pedido"><?php echo $pedido->dataRetirada; ?></p>
    <p class="status-pedido"><?php echo $pedido->statusPedido; ?></p>
    <a class="preset-botao" href="detalhes_pedido.php?idUsuario=<?php echo $id ?>&idPedido=<?php echo $pedido->idPedido; ?>">i</a>
</div>
<?php } ?>