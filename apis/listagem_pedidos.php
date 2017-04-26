<?php
    require_once("../include/initialize.php");
    require_once("../include/classes/tbl_pedido.php");
    sleep(1);

    $idUsuario = ( isset($_POST["idUsuario"]) )? (int) $_POST["idUsuario"] : null;
    $paginaAtual = ( isset($_POST["paginaAtual"]) )? (int) $_POST["paginaAtual"] : 1;
    $registrosPorPagina = 10;

    $buscaPedido = new \Tabela\Pedido();
    $listaPedidos = $buscaPedido->listarPedidos($registrosPorPagina, $paginaAtual, "p.idStatusPedido = 1 AND locatario.id = {$idUsuario}");

    for( $i = 0; $i < count($listaPedidos); ++$i ) {        
?>
<div class="box-pedido">
    <div class="wrapper-box-info">
        <div class="box-foto-info">
            <div class="box-foto">
                <a href="#"><img class="foto-pedido" src="" /></a>
            </div>
            <div class="box-info">
                <p class="valor-diaria">Total: R$<?php echo str_replace(".", ",", $listaPedidos[$i]->valorDiaria); ?></p>
                <p class="modelo-veiculo"><?php echo $listaPedidos[$i]->veiculo; ?></p>
                <div class="box-icone-data">
                    <span class="icone retirada"></span>
                    <p class="data"><?php echo $listaPedidos[$i]->dataRetirada; ?></p>
                </div>
                <div class="box-icone-data">
                    <span class="icone entrega"></span>
                    <p class="data"><?php echo $listaPedidos[$i]->dataEntrega; ?></p>
                </div>
            </div>
        </div>
        <div class="box-info-locador">
            <div class="info-locador">
                <p class="status"><?php echo $listaPedidos[$i]->statusPedido; ?></p>
                <p class="nome-locador">
                <?php echo $listaPedidos[$i]->nomeLocador . " " . $listaPedidos[$i]->sobrenomeLocador[0]; ?>
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