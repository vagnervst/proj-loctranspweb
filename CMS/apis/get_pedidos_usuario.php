<?php
    require_once("../../include/initialize.php");
    require_once("../../include/classes/tbl_pedido.php");
    $id = 2;
    $dadosPedido = new \Tabela\Pedido();
    $dadosPedido = $dadosPedido->getPedido("u.id = {$id}")[0];
    sleep(3);
?>
<p class="titulo-pedidos">Pedidos Realizados:</p>
<div class="box-pedido">
    <p class="locador-pedido"><?php echo $dadosPedido->nomeLocador; ?></p>
    <p class="data-pedido"><?php echo $dadosPedido->dataRetirada; ?></p>
    <p class="status-pedido"><?php echo $dadosPedido->statusPedido; ?></p>
</div>