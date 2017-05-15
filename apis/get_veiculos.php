<?php
    require_once("../include/initialize.php");
    require_once("../include/classes/tbl_veiculo.php");
    
    $id_tipo = ( isset($_POST["idTipo"]) )? $_POST["idTipo"] : null;
    $id_fabricante = ( isset( $_POST["idFabricante"] ) )? $_POST["idFabricante"] : null;
    $id_combustivel = ( isset($_POST["idCombustivel"]) )? $_POST["idCombustivel"] : null;
    $id_transmissao = ( isset($_POST["idTransmissao"]) )? $_POST["idTransmissao"] : null;
    $qtd_portas = ( isset($_POST["qtdPortas"]) )? $_POST["qtdPortas"] : null;                    

    $lista_parametros_pesquisa = [];        
    
    if( !empty($id_tipo) ) $lista_parametros_pesquisa[] = "v.idTipoVeiculo = {$id_tipo}";
    if( !empty($id_fabricante) ) $lista_parametros_pesquisa[] = "v.idFabricante = {$id_fabricante}";
    if( !empty($id_combustivel) ) $lista_parametros_pesquisa[] = "v.idTipoCombustivel = {$id_combustivel}";
    if( !empty($id_transmissao) ) $lista_parametros_pesquisa[] = "v.idTransmissao = {$id_transmissao}";
    if( !empty($qtd_portas) ) $lista_parametros_pesquisa[] = "v.qtdPortas = {$qtd_portas}";
    
    $pesquisa = implode(" AND ", $lista_parametros_pesquisa);            

    $lista_veiculos = new \Tabela\Veiculo();
    $lista_veiculos = $lista_veiculos->getVeiculos(null, null, "idFabricante = {$id_fabricante}", "codigo");

    echo '<option selected disabled>Selecione um modelo</option>';
    foreach($lista_veiculos as $veiculo) {
        echo '<option value="' . $veiculo->id . '">' . $veiculo->nome . '</option>';
    }
?>