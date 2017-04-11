<?php
    require_once("../include/initialize.php");
    require_once("../include/classes/tbl_tipo_veiculo.php");
    require_once("../include/classes/tbl_acessorio_veiculo.php");

    $id_tipo_veiculo = ( isset($_POST["idTipoVeiculo"]) )? $_POST["idTipoVeiculo"] : null;

    if( !empty( $id_tipo_veiculo ) ) {
        $lista_acessorios = new \Tabela\TipoVeiculo();
        $lista_acessorios->id = $id_tipo_veiculo;
        $lista_acessorios = $lista_acessorios->getAcessoriosRelacionados();
        
        if( count($lista_acessorios) === 0 ) {
            $box_acessorio = '<div class="label-checkbox">';                       
            $box_acessorio .= '<span class="label">Não há acessórios disponíveis</span>';            
            $box_acessorio .= '</div>';
            
            echo $box_acessorio;
        } else {
        
            foreach( $lista_acessorios as $acessorio ) {
                $box_acessorio = '<div class="label-checkbox">';
                $box_acessorio .= '<label>';
                $box_acessorio .= '<input type="checkbox" name="chkAcessorio[]" value="' . $acessorio->id . '"/>';
                $box_acessorio .= '<span class="label">' . $acessorio->nome . '</span>';
                $box_acessorio .= '</label>';
                $box_acessorio .= '</div>';

                echo $box_acessorio;
            } 
        }
    }
?>