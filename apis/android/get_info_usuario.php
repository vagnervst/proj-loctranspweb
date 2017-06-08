<?php
    require_once("../../include/initialize.php");
    require_once("../../include/classes/tbl_usuario.php");
    require_once("../../include/classes/tbl_cnh.php");
    require_once("../../include/classes/tbl_cidade.php");
    require_once("../../include/classes/tbl_cartao_credito.php");
    require_once("../../include/classes/tbl_conta_bancaria.php");
    require_once("../../include/classes/tbl_avaliacao.php");
    require_once("../../include/classes/tbl_pedido.php");

    $idUsuario = ( isset($_POST["idUsuario"]) )? (int) $_POST["idUsuario"] : null;

    if( !empty($idUsuario) ) {
        $buscaUsuario = new \Tabela\Usuario();
        $usuario = $buscaUsuario->buscar("id = {$idUsuario}")[0];                
        
        $usuario->id = (int) $usuario->id;              
        $usuario->autenticacaoDupla = (int) $usuario->autenticacaoDupla;        
        $usuario->idCidade = (int) $usuario->idCidade;
        $usuario->idTipoConta = (int) $usuario->idTipoConta;
        $usuario->idPlanoConta = (int) $usuario->idPlanoConta;
        $usuario->idLicencaDesktop = (int) $usuario->idLicencaDesktop;
        $usuario->saldo = (double) $usuario->saldo;        
        
        $pedido = new \Tabela\Pedido();
        $listaPedidosUsuario = $pedido->buscar("idUsuarioLocatario = {$idUsuario}");
        
        $usuario->qtdLocacoes = count($listaPedidosUsuario);
        
        $avaliacao = new \Tabela\Avaliacao();
        $avaliacoesUsuario = $avaliacao->buscar("idUsuarioAvaliado = {$idUsuario}");
        
        $usuario->mediaNotas = $usuario->getDetalhesUsuario("u.id = {$idUsuario}")[0]->mediaNotas;
        
        $buscaCidade = new \Tabela\Cidade();
        $buscaCidade = $buscaCidade->buscar("id = {$usuario->idCidade}")[0];
        
        $usuario->idEstado = $buscaCidade->idEstado;
        $listaCnhs = new \Tabela\Cnh();
        $listaCnhs = $listaCnhs->buscar("idUsuario = {$idUsuario} AND visivel = 1");
        
        $usuario->listaCnh = $listaCnhs;
        
        $cartaoCredito = new \Tabela\CartaoCredito();
        $cartaoCredito = $cartaoCredito->buscar("idUsuario = {$idUsuario}");
        
        if( !empty($cartaoCredito[0]) ) {
            $usuario->cartaoCredito = $cartaoCredito[0];
        }
        
        $contaBancaria = new \Tabela\ContaBancaria();
        $contaBancaria = $contaBancaria->buscar("idUsuario = {$idUsuario}");
        
        if( !empty($contaBancaria[0]) ) {
            $usuario->contaBancaria = $contaBancaria[0];
        }
        
        echo json_encode($usuario);
    }
?>