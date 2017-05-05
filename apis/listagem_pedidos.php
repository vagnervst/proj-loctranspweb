<?php
    require_once("../include/initialize.php");
    require_once("../include/classes/tbl_pedido.php");
    sleep(1);

    $idUsuario = ( isset($_POST["idUsuario"]) )? (int) $_POST["idUsuario"] : null;
    $paginaAtual = ( isset($_POST["paginaAtual"]) )? (int) $_POST["paginaAtual"] : 1;
    $registrosPorPagina = 10;

    $buscaPedido = new \Tabela\Pedido();
    $listaPedidos = $buscaPedido->listarPedidos($registrosPorPagina, $paginaAtual, "p.idStatusPedido != 10 AND locatario.id = {$idUsuario}");

    foreach( $listaPedidos as $pedido ) {        
?>
<div class="box-pedido">
    <div class="wrapper-box-info">
        <div class="box-foto-info">
            <div class="box-foto">
                <a href="pedido.php?id=<?php echo $pedido->id; ?>"><img class="foto-pedido" src="" /></a>
            </div>
            <div class="box-info">
                <p class="valor-diaria">Total: R$<?php echo str_replace(".", ",", $pedido->valorDiaria); ?></p>
                <p class="modelo-veiculo"><?php echo $pedido->veiculo; ?></p>
                <div class="box-icone-data">
                    <span class="icone retirada"></span>
                    <p class="data"><?php echo date( "d/M/Y - H:i", strtotime($pedido->dataRetirada) ); ?></p>
                </div>
                <div class="box-icone-data">
                    <span class="icone entrega"></span>
                    <p class="data"><?php echo date( "d/M/Y - H:i", strtotime($pedido->dataEntrega) ); ?></p>
                </div>
            </div>
        </div>
        <div class="box-info-locador">
            <div class="info-locador">
                <p class="status"><?php echo $pedido->statusPedido; ?></p>
                <p class="nome-locador">
                <?php echo $pedido->nomeLocador . " " . $pedido->sobrenomeLocador[0]; ?>
                </p>
                <div class="box-avaliacoes">
                    <div class="container-icone-avaliacoes">
                        <div class="icone-avaliacao"></div>
                        <div class="icone-avaliacao"></div>
                        <div class="icone-avaliacao"></div>
                        <div class="icone-avaliacao"></div>
                        <div class="icone-avaliacao"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>                                                        
</div>
<?php } ?>