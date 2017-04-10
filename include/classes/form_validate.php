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
                    if( !empty($input["name"]) && !empty($listaInput[$i]["name"]) && $input["name"] == $listaInput[$i]["name"] ) ++$repeticoes;
                }
                
                if( $repeticoes > 1 ) return true;
            }
            
            return false;
        }
        
        public static function prepare_time_input_for_mysql( $time_input ) {
            $time_input = str_replace("/", "-", $time_input);            
            $time_input = strftime( "%Y-%m-%d", strtotime( $time_input ));
            
            return $time_input;
        }
    }
?>