<?php
    class Sessao {
        
        function __construct() {
            session_start();
        }
        
        public function put($chave, $valor) {
            $_SESSION[$chave] = $valor;
        }
        
        public function get($chave) {
            return $_SESSION[$chave];
        }
        
        public function remove($chave) {
            $_SESSION[$chave] = null;
            setcookie( $_COOKIE[session_name()], null, (time() -3600) );
            
            session_destroy();                        
        }
        
    }
?>