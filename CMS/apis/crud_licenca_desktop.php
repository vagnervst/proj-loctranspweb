<?php
    require_once("../../include/initialize.php");
    require_once("../../include/classes/tbl_licenca_desktop.php");
    
    $modo = ( isset($_POST["id"]) )? $_POST["id"] : null;

    $id = ( isset($_POST["id"]) )? $_POST["id"] : null;
    $nomeLicenca = ( isset($_POST["txtNomeLicenca"]) )? $_POST["txtNomeLicenca"] : null;
    $conexoesSimultaneas = ( isset($_POST["txtConexoesLicenca"]) )? $_POST["txtConexoesLicenca"] : null;
    $preco = ( isset($_POST["txtPrecoLicenca"]) )? $_POST["txtPrecoLicenca"] : null;
    $duracaoMeses = ( isset($_POST["txtDuracaoLicenca"]) )? $_POST["txtDuracaoLicenca"] : null;

    $objLicencaDesktop = new \Tabela\LicencaDesktop();
    $objLicencaDesktop->nome = $nomeLicenca;
    $objLicencaDesktop->conexoesSimultaneas = $conexoesSimultaneas;
    $objLicencaDesktop->preco = $preco;
    $objLicencaDesktop->duracaoMeses = $duracaoMeses;

    if( $modo == "insert" ) {
        $objLicencaDesktop->inserir();
    } elseif( $modo == "update" ) {
        $objLicencaDesktop->id = (int) $id;
        $objLicencaDesktop->atualizar();
    } elseif( $modo == "delete" ) {
        $objLicencaDesktop->id = (int) $id;
        $objLicencaDesktop->deletar();
    }

    $pagina = ( isset($_POST["numeroPagina"]) )? $_POST["numeroPagina"] : 1;
    $itens_por_pagina = 15;

    $lista_licenca = $objLicencaDesktop->getTipos($itens_por_pagina, $pagina);

    echo json_encode($lista_licenca);
?>