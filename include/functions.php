<?php
    function redirecionar_para($url) {
        header("Location: " . $url);
        exit;
    }

    function get_data_atual() {
        date_default_timezone_set('America/Sao_Paulo');
        return date("Y/m/d H:i:s");
    }
?>