<?php              
    require_once("../../include/initialize.php");
    require_once("../../include/classes/tbl_tipo_veiculo.php");
    
    $modo = ( isset($_POST["modo"]) )? $_POST["modo"] : null;

    $id = ( isset($_POST["idTipo"]) )? $_POST["idTipo"] : null;
    $nomeTipo = ( isset($_POST["txtTipoVeiculo"]) )? $_POST["txtTipoVeiculo"] : null;
    
    $objTipoVeiculo = new \Tabela\TipoVeiculo();
    $objTipoVeiculo->titulo = $nomeTipo;        

    if( $modo == "insert" ) {
        $objTipoVeiculo->inserir();
    } elseif( $modo == "update" ) {
        $objTipoVeiculo->id = (int) $id;
        $objTipoVeiculo->atualizar();
    } elseif( $modo == "delete" ) {
        $objTipoVeiculo->id = (int) $id;
        $objTipoVeiculo->deletar();
    }
?>
<?php
    $lista_tipo = $objTipoVeiculo->buscar();
    
    echo json_encode($lista_tipo);
?>