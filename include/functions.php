<?php
    function redirecionar_para($url) {
        header("Location: " . $url);
        exit;
    }
?>