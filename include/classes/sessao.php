<?php
    class Sessao {
        
        function __construct() {
            if( session_id() == "" ) {
                session_start();
            }	    
        }
        
        public function put($chave, $valor) {
            $_SESSION[$chave] = $valor;
        }
        
        public function get($chave) {
            return isset( $_SESSION[$chave] )? $_SESSION[$chave] : null;
        }
        
        public function remove($chave) {
            $_SESSION[$chave] = null;
            setcookie( $_COOKIE[session_name()], null, (time() -3600) );
            
            session_destroy();                        
        }
        
    }
?>