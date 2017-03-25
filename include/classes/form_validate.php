<?php
    class FormValidator {
        
        public static function has_empty_input( $listaInput ) {
            foreach( $listaInput as $input ) {
                if( empty($input) ) return true;
            }
            
            return false;
        }
        
        public static function has_repeated_files( $listaInput ) {
            foreach( $listaInput as $input ) {
                
                $repeticoes = 0;
                for($i = 0; $i < count($listaInput); ++$i) {
                    if( $input["name"] == $listaInput[$i]["name"] ) ++$repeticoes;
                }
                
                if( $repeticoes > 1 ) return true;
            }
            
            return false;
        }
    }
?>