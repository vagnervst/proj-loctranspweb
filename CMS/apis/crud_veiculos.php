<?php
    $modo = ( isset($_POST["modo"]) )? $_POST["modo"] : null;
          
    require_once("../../include/initialize.php");
    require_once("../../include/classes/tbl_veiculo.php");
    require_once("../../include/classes/tbl_tipo_veiculo.php");	    
    
    $idVeiculo = ( isset($_POST["idVeiculo"]) )? $_POST["idVeiculo"] : null;
    $nome = ( isset($_POST["txtNome"]) )? $_POST["txtNome"] : null;
    $precoMedio = ( isset($_POST["txtPrecoMedio"]) )? $_POST["txtPrecoMedio"] : null;
    $ano = ( isset($_POST["txtAno"]) )? $_POST["txtAno"] : null;
    $motor = ( isset($_POST["txtMotor"]) )? $_POST["txtMotor"] : null;
    $portas = ( isset($_POST["txtPortas"]) )? $_POST["txtPortas"] : null;		
    $idCategoria = ( isset($_POST["slCategoria"]) )? $_POST["slCategoria"] : null;
    $idTipo = ( isset($_POST["slTipo"]) )? $_POST["slTipo"] : null;
    $idCombustivel = ( isset($_POST["slCombustivel"]) )? $_POST["slCombustivel"] : null;
    $idFabricante = ( isset($_POST["slFabricante"]) )? $_POST["slFabricante"] : null;
    $idTransmissao = ( isset($_POST["slTransmissao"]) )? $_POST["slTransmissao"] : null;

    $objVeiculo = new \Tabela\Veiculo();

    $objVeiculo->nome = $nome;
    $objVeiculo->precoMedio = $precoMedio;
    $objVeiculo->ano = $ano;
    $objVeiculo->tipoMotor = $motor;
    $objVeiculo->qtdPortas = (int) $portas;
    $objVeiculo->idCategoriaVeiculo = (int) $idCategoria;
    $objVeiculo->idTipoVeiculo = (int) $idTipo;
    $objVeiculo->idTipoCombustivel = (int) $idCombustivel;
    $objVeiculo->idFabricante = (int) $idFabricante;
    $objVeiculo->idTransmissao = (int) $idTransmissao;

    if( $modo == "insert" ) {
        //$objVeiculo->inserir();
    } elseif( $modo == "update" ) {
        $objVeiculo->id = (int) $idVeiculo;
        $objVeiculo->atualizar();
    } elseif( $modo == "delete" ) {
        $objVeiculo->id = (int) $idVeiculo;
        $objVeiculo->deletar();
    }
?>
<?php if( 1 == 2 ) { ?>
<table class="tabela-veiculos">
    <tr id="colunas-label">
        <td class="coluna-nome">Nome</td>
        <td>Tipo</td>
        <td>Categoria</td>
        <td>Fabricante</td>                                    
        <td>Ano</td>
        <td>Preço</td>
        <td>Operações</td>
    </tr>
    <?php
        $filtragemNome = ( isset( $_POST["txtBusca"] ) )? $_POST["txtBusca"] : null;
        $filtragemCod = ( isset( $_POST["txtCod"] ) )? $_POST["txtCod"] : null;
        $filtragemPrecoMinimo = ( isset( $_POST["txtPrecoMinimo"] ) )? $_POST["txtPrecoMinimo"] : null;
        $filtragemTipo = ( isset( $_POST["slTipo"] ) )? $_POST["slTipo"] : null;
        $filtragemFabricante = ( isset( $_POST["slFabricante"] ) )? $_POST["slFabricante"] : null;        
        $filtragemCategoria = ( isset( $_POST["slCategoria"] ) )? $_POST["slCategoria"] : null;
        $filtragemCombustivel = ( isset( $_POST["slCombustivel"] ) )? $_POST["slCombustivel"] : null;
        
        $idTipo = new \Tabela\TipoVeiculo();
        $idTipo = $idTipo->buscar("WHERE nome = '$filtragemTipo'");
        
        if( $modo == "filtragem" ) {
            $listaVeiculos = $objVeiculo->buscar("nome LIKE '{$busca}'");
        } else {
            $listaVeiculos = $objVeiculo->getVeiculos(15, 1);
        }
    
        foreach( $listaVeiculos as $veiculo ) {
    ?>
    <tr class="registro-veiculo" data-info='{ "cod" : "<?php echo $veiculo->id; ?>"}'>
        <td class="coluna-nome"><?php echo $veiculo->nome; ?></td>
        <td><?php echo $veiculo->tipo; ?></td>
        <td><?php echo $veiculo->categoria; ?></td>
        <td><?php echo $veiculo->fabricante; ?></td>
        <td><?php echo $veiculo->ano; ?></td>
        <td><?php echo $veiculo->precoMedio; ?></td>
        <td><span class="preset-botao botao-editar">Editar</span></td>
    </tr>
    <?php } ?>
</table>
<div id="box-paginas">
    <a href="#">Anterior</a>
    <p id="info-pagina">1 - 5</p>
    <a href="#">Próxima</a>
</div>
<?php } ?>

<?php
    $filtragemNome = ( isset( $_POST["txtBusca"] ) )? $_POST["txtBusca"] : null;
    $filtragemCod = ( isset( $_POST["txtCod"] ) )? $_POST["txtCod"] : null;
    $filtragemPrecoMinimo = ( isset( $_POST["txtPrecoMinimo"] ) )? $_POST["txtPrecoMinimo"] : null;
    $filtragemTipo = ( isset( $_POST["slTipo"] ) )? $_POST["slTipo"] : null;
    $filtragemFabricante = ( isset( $_POST["slFabricante"] ) )? $_POST["slFabricante"] : null;        
    $filtragemCategoria = ( isset( $_POST["slCategoria"] ) )? $_POST["slCategoria"] : null;
    $filtragemCombustivel = ( isset( $_POST["slCombustivel"] ) )? $_POST["slCombustivel"] : null;

    $idTipo = new \Tabela\TipoVeiculo();
    $idTipo = $idTipo->buscar("WHERE nome = '$filtragemTipo'");

    if( $modo == "filtragem" ) {
        $listaVeiculos = $objVeiculo->buscar("nome LIKE '{$busca}'");
    } else {
        $listaVeiculos = $objVeiculo->getVeiculos(15, 1);
    }

    echo json_encode($listaVeiculos);
?>
