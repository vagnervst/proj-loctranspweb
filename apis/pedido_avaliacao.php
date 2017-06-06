<?php
    require_once("../include/initialize.php");
    require_once("../include/functions.php");
    require_once("../include/classes/sessao.php");
    require_once("../include/classes/tbl_avaliacao.php");
    require_once("../include/classes/tbl_pedido.php");

    $notaAvaliacao = ( isset($_POST["notaAvaliacao"]) )? (int) $_POST["notaAvaliacao"] : null;
    $idPedido = ( isset($_POST["idPedido"]) )? (int) $_POST["idPedido"] : null;    
    $mensagem = ( isset($_POST["mensagemAvaliacao"]) )? $_POST["mensagemAvaliacao"] : null;        

    $LOCADOR = 1;
    $LOCATARIO = 2;                
    
    $resultado = false;
    if( $notaAvaliacao != null && $idPedido != null ) {
        
        $infoPedido = new \Tabela\Pedido();
        $infoPedido = $infoPedido->buscar("id = {$idPedido}")[0];                
        $infoPedido->id = $idPedido;
        
        $sessao = new Sessao();
        $idUsuario = -1;
        if( $sessao->get("idUsuario") != null ) {
            $idUsuario = (int) $sessao->get("idUsuario");
        } else {
            $idUsuario = ( isset($_POST["idUsuario"]) )? (int) $_POST["idUsuario"] : -1;
        }                             
        
        $alvoAvaliacao = null;
        if( $idUsuario == $infoPedido->idUsuarioLocador ) {
            $alvoAvaliacao = $LOCATARIO;
        } elseif( $idUsuario == $infoPedido->idUsuarioLocatario ) {
            $alvoAvaliacao = $LOCADOR;
        }                
                
        if( $idPedido != null ) {
            
            $usuarioAlvoAvaliacao = null;
            $usuarioAvaliador = null;
            if( $alvoAvaliacao == $LOCADOR ) {
                $usuarioAlvoAvaliacao = (int) $infoPedido->idUsuarioLocador;
                $usuarioAvaliador = (int) $infoPedido->idUsuarioLocatario;
                $infoPedido->locadorAvaliado = 1;                
            } elseif( $alvoAvaliacao == $LOCATARIO ) {
                $usuarioAlvoAvaliacao = (int) $infoPedido->idUsuarioLocatario;
                $usuarioAvaliador = (int) $infoPedido->idUsuarioLocador;
                $infoPedido->locatarioAvaliado = 1;
            }
            
            if( $usuarioAlvoAvaliacao != null && $usuarioAvaliador != null ) {
                $avaliacao = new \Tabela\Avaliacao();
                $avaliacao->nota = $notaAvaliacao;                              
                $avaliacao->mensagem = $mensagem;
                $avaliacao->data = get_data_atual_mysql();
                $avaliacao->idUsuarioAvaliado = $usuarioAlvoAvaliacao;
                $avaliacao->idUsuarioAvaliador = $usuarioAvaliador;                                
                
                $resultado = $avaliacao->inserir();
                if( $resultado != 0 && $resultado != false ) {
                    $resultado = true;                    
                }
                
                $infoPedido->atualizar();
            }
        }
    }

    echo json_encode($resultado);
?>