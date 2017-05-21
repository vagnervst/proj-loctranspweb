<?php
    require_once("../../include/initialize.php");
    require_once("../../include/classes/sessao.php");
    
    $sessao = new Sessao();
    $idUsuario = ( $sessao->get("idUsuario") != null )? (int) $sessao->get("idUsuario") : null;
        
    if( !empty($idUsuario) ) {

        $databaseUtils = new \DB\DatabaseUtils();
            
        $rangeTempo = strtotime( date("Y-m-d") . " -1 year" );        
        $rangeTempo = get_data_mysql( $rangeTempo );                
        
        $sql = "SELECT SUM(valorDiaria) AS lucroMensal, MONTH(dataRetirada) AS mes ";
        $sql .= "FROM tbl_pedido  ";
        $sql .= "WHERE idStatusPedido = 9 ";
        $sql .= "AND dataRetirada > '{$rangeTempo}' ";
        $sql .= "AND idUsuarioLocador = {$idUsuario} ";
        $sql .= "GROUP BY MONTH(dataRetirada)";                                
        
        $resultado = $databaseUtils->executarQuery( $sql );
        
        $resultado = $databaseUtils->get_array_from_resultado($resultado);
        
        $valoresMensais = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        
        foreach( $resultado as $infoMensal ) {            
            $valoresMensais[$infoMensal->mes-1] = $infoMensal->lucroMensal;    
        }
        
        echo json_encode($valoresMensais);
    }
?>