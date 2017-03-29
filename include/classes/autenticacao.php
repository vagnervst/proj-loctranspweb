<?php
    class Autenticacao {
        public static function hash($senha) {
            $hash = password_hash($senha, PASSWORD_BCRYPT);
            
            return $hash;
        }
        
        public static function verificar($senha, $hash) {
            return password_verify($senha, $hash);
        }
    }
?>