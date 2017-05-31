<?php
    class File {
        
        private static $extensoes_imagem = ["jpg", "png", "jpeg", "gif"];
        
        private static function verificar_extensao($nome_arquivo) {
            $extensao_imagem = pathinfo($nome_arquivo["name"])["extension"];
            $extensao_imagem = strtolower($extensao_imagem);
            
            return in_array( $extensao_imagem, File::$extensoes_imagem );
        }
        
        public static function upload($arquivo, $nome_arquivo, $pasta) {
            if( empty($arquivo["tmp_name"]) || empty($nome_arquivo) || !File::verificar_extensao($arquivo) ) return false;
            $nome_arquivo = basename($nome_arquivo);
            
            echo "UPLOAD: " . $arquivo["tmp_name"] . $pasta . "/" . $nome_arquivo;
            return move_uploaded_file($arquivo["tmp_name"], $pasta . "/" . $nome_arquivo);
        }
        
        private static function codificar_caminho($nome_arquivo, $pasta) {
            return $pasta . "/" . rawurlencode($nome_arquivo);
        }
        
        private static function is_arquivo_existente($nome_arquivo, $pasta) {                       
            if( file_exists($pasta . "/" . $nome_arquivo) && is_file($pasta . "/" . $nome_arquivo) ) return true;
            
            return false;
        }
        
        public static function read($nome_arquivo, $pasta, $nao_encontrado="no_image.jpg") {                                     
            if( !File::is_arquivo_existente($nome_arquivo, $pasta) ) return $pasta . "/" . $nao_encontrado;
            
            return File::codificar_caminho($nome_arquivo, $pasta);
        }
        
        public static function remove($nome_arquivo, $pasta) {            
            if( !File::is_arquivo_existente($nome_arquivo, $pasta) ) return false;
                            
            return unlink( $pasta . "/" . $nome_arquivo );
        }
        
        public static function replace($arquivo, $nome_arquivo, $nome_arquivo_antigo="", $pasta) {
            
            if( File::upload( $arquivo, $nome_arquivo, $pasta ) ) {                
                
                if( !empty($nome_arquivo_antigo) && $nome_arquivo != $nome_arquivo_antigo ) {                
                    File::remove($nome_arquivo_antigo, $pasta);
                }
                
                return true;
            }
            
            return false;
        }
    }
?>