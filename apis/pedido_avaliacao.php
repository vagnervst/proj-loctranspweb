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

    if( $notaAvaliacao != null && $idPedido != null ) {
        
        $infoPedido = new \Tabela\Pedido();
        $infoPedido = $infoPedido->buscar("id = {$idPedido}")[0];                
        
        $sessao = new Sessao();
        $idUsuario = (int) $sessao->get("idUsuario");
        
        echo json_encode($infoPedido);
        
        echo "idUsuario: " . $idUsuario;
        
        $alvoAvaliacao = null;
        if( $idUsuario == $infoPedido->idUsuarioLocador ) {
            $alvoAvaliacao = $LOCATARIO;
        } elseif( $idUsuario == $infoPedido->idUsuarioLocatario ) {
            $alvoAvaliacao = $LOCADOR;
        }
        
        echo "nota: " . $notaAvaliacao . " idPedido: " . $idPedido . " alvoAvaliacao: " . $alvoAvaliacao . " mensagem: " . $mensagem . "<br/>";
        
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
            
            echo "avaliado: " . $usuarioAlvoAvaliacao . " avaliador: " . $usuarioAvaliador;
            
            if( $usuarioAlvoAvaliacao != null && $usuarioAvaliador != null ) {
                $avaliacao = new \Tabela\Avaliacao();
                $avaliacao->nota = $notaAvaliacao;                              
                $avaliacao->mensagem = $mensagem;
                $avaliacao->data = get_data_atual_mysql();
                $avaliacao->idUsuarioAvaliado = $usuarioAlvoAvaliacao;
                $avaliacao->idUsuarioAvaliador = $usuarioAvaliador;
                
                echo json_encode( $avaliacao );
                
                $avaliacao->inserir();
                $infoPedido->atualizar();
            }
        }
    }
?>