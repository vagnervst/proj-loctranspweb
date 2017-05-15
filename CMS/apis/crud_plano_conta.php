<?php              
    require_once("../../include/initialize.php");
    require_once("../../include/classes/tbl_plano_conta.php");

    $modo = ( isset($_POST["modo"]) )? $_POST["modo"] : null;

    $id = ( isset($_POST['id']))? $_POST["id" ] : null ;
    $nome = ( isset($_POST['txtNomePlano']))? $_POST["txtNomePlano"] : null;
    $preco = ( isset($_POST['txtPreco']))? (double) $_POST["txtPreco"] : null;
    $duracaoMeses = ( isset($_POST['txtDuracaoMeses'] ) )? (int) $_POST["txtDuracaoMeses"] : null;
    $limitePublicacao = ( isset ( $_POST['txtLimitePublicacoes']))? (int) $_POST["txtLimitePublicacoes"] : null;    
    $diasAnalisePublicacao = ( isset($_POST['txtDiasAnalise'] ) )? (int) $_POST["txtDiasAnalise"] : null;
    $descPlano = ( isset($_POST['txtDescricaoPlano']) )? $_POST["txtDescricaoPlano"] : null;

    $objPlanoConta = new \Tabela\PlanoConta();
    $objPlanoConta->nome = $nome;
    $objPlanoConta->preco = $preco;
    $objPlanoConta->duracaoMeses = $duracaoMeses;
    $objPlanoConta->limitePublicacao = $limitePublicacao;
    $objPlanoConta->descPlano = $descPlano;
    $objPlanoConta->diasAnalisePublicacao = $diasAnalisePublicacao;

    if( $modo == "insert" ) {
        $objPlanoConta->visivel = true;
        $objPlanoConta->inserir();
    } elseif( $modo == "update" ) {
        $objPlanoConta->id = (int) $id;
        $objPlanoConta->atualizar();
    } elseif( $modo == "delete" ) {
        $objPlanoConta->id = (int) $id;
        $objPlanoConta->visivel = false;
        $objPlanoConta->atualizar();
    }

    $pagina = ( isset($_POST["numeroPagina"]) )? $_POST["numeroPagina"] : 1;
    $itens_por_pagina = 15;
    
    $lista_plano_conta = $objPlanoConta->getPlanos($itens_por_pagina, $pagina, "visivel = 1");

    echo json_encode($lista_plano_conta);
?>