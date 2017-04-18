<?php              
    require_once("../../include/initialize.php");
    require_once("../../include/classes/tbl_banco.php");
    
    $modo = ( isset($_POST["modo"]) )? $_POST["modo"] : null;

    $id = ( isset($_POST["id"]) )? $_POST["id"] : null;        
    $tituloBanco = ( isset( $_POST["txt_titulo"] ) )? $_POST["txt_titulo"] : null;     
    $codigoBanco = ( isset( $_POST["txt_codigo"] ) )? $_POST["txt_codigo"] : null;     
    $qtdDigitos = ( isset( $_POST["txt_qtd_digitos"] ) )? $_POST["txt_qtd_digitos"] : null;     
    
    $objBanco = new \Tabela\Banco();
    $objBanco->nome = $tituloBanco;
    $objBanco->codigo = $codigoBanco;
    $objBanco->qtdDigitosVerificadores = $qtdDigitos;
    
    if( $modo == "insert" ) {
        $idBanco = $objBanco->inserir();
        
        $objBanco->id = $idBanco;
        
    } elseif( $modo == "update" ) {
        $objBanco->id = (int) $id;
        $objBanco->atualizar();
        
    } elseif( $modo == "delete" ) {
        $objBanco->id = (int) $id;
        $objBanco->deletarReferencias($id) ;
        $objBanco->deletar();
    }

    $pagina = ( isset($_POST["numeroPagina"]) )? $_POST["numeroPagina"] : 1;
    $itens_por_pagina = 15;
    
    $listaBancos = $objBanco->getBanco($itens_por_pagina, $pagina);    

    echo json_encode($listaBancos);
?>