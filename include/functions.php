<?php
    function redirecionar_para($url) {
        header("Location: " . $url);
        exit;
    }

    function get_data_atual() {
        date_default_timezone_set('America/Sao_Paulo');        
        return date(DATE_RSS, time());
    }
    
    function get_data_atual_mysql() {
        return strftime( "%Y-%m-%d %H:%M:%S", strtotime(get_data_atual()));
    }
    
    function get_data_mysql( $time ) {
        return strftime( "%Y-%m-%d", $time);
    }

    function formatar_data($formato = null, $data) {
        setlocale(LC_TIME, 'ptb');
        
        $formato = ( empty($formato) )? "%d/%b/%Y %H:%M" : $formato;
        
        return strftime( $formato, strtotime($data));
    }

    function get_id_usuario() {                
        $sessao = new Sessao();
        $idUsuario = (int) $sessao->get("idUsuario");
    }

    function upload_base64_image($base64, $nome_arquivo, $pasta) {
        $resultado = false;
        
        if( $base64 != null ) {
            $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64));
            
            $resultado = file_put_contents($pasta . "/" . $nome_arquivo, $data);
        }
        
        return $resultado;
    }
?>