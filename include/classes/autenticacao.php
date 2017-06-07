<?php
    class Autenticacao {
        public static function hash($senha) {
            $hash_format = "$2y$10$";
            $unique_random_string = md5( uniqid(mt_rand(), true) );
            $base64_string = base64_encode( $unique_random_string );
            $modified_base64_string = str_replace("+", ".", $base64_string);
            
            $salt = substr($modified_base64_string, 0, 70);
            
            $format_and_salt = $hash_format . $salt;            
            
            $hash = crypt($senha, $format_and_salt);
            
            return $hash;
        }
        
        public static function verificar($senha, $hash) {
            $hash2 = crypt($senha, $hash);
                               
            return ( $hash2 == $hash );
        }
    }

?>