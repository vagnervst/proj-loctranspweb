<?php
    class File {
        
        public static function upload($nome_temporario, $nome_arquivo, $pasta) {            
            if( empty($nome_temporario) || empty($nome_arquivo) ) return false;            
            $nome_arquivo = basename($nome_arquivo);
            
            return move_uploaded_file($nome_temporario, $pasta . "/" . $nome_arquivo);
        }
        
        private static function codificar_caminho($nome_arquivo, $pasta) {
            return $pasta . "/" . rawurlencode($nome_arquivo);
        }
        
        private static function is_arquivo_existente($nome_arquivo, $pasta) {                        
            if( file_exists($pasta . "/" . $nome_arquivo) ) return true;
            
            return false;
        }
        
        public static function read($nome_arquivo, $pasta) {
            if( !File::is_arquivo_existente($nome_arquivo, $pasta) ) return $pasta . "no_image.jpg";
            
            return File::codificar_caminho($nome_arquivo, $pasta);
        }
        
        public static function remove($nome_arquivo, $pasta) {
            if( !File::is_arquivo_existente($nome_arquivo, $pasta) ) return false;

            return unlink( $pasta . "/" . $nome_arquivo );
        }
        
        public static function replace($nome_temporario, $nome_arquivo, $nome_arquivo_antigo="", $pasta) {                                                                        
            if( File::upload( $nome_temporario, $nome_arquivo, $pasta ) ) {
                
                if( !empty($nome_arquivo_antigo) && $nome_arquivo != $nome_arquivo_antigo ) {                
                    File::remove($nome_arquivo_antigo, $pasta);
                }
                
                return true;
            }
            
            return false;
        }
    }
?>