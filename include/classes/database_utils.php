<?php
    namespace DB {
        
        class DatabaseUtils {
            
            public function get_propriedades() {
                $propriedades = get_object_vars($this);                
                
                return array_keys($propriedades);
            }

            public function get_valores() {
                $propriedades = get_object_vars($this);

                return array_values($propriedades);
            }                

            public function get_propriedades_valores() {
                $valores = get_object_vars($this);
                
                for( $i = 0; $i < count($valores); ++$i ) {
                    if( isset($valores[$i]) && $valores[$i] == null ) {
                        unset($valores[$i]);
                    }
                }
                
                return $valores;
            }

            public function get_update_valores() {
                $propriedades = $this->get_propriedades();
                $valores = $this->get_valores();                        

                $statement = [];
                for($i = 0; $i < count($propriedades); ++$i) {                    
                    if( $propriedades[$i] != $this::$primary_key && property_exists( get_class($this), $propriedades[$i] ) && ( isset($valores[$i]) ) ) {
                        $statement[] = $propriedades[$i] . " = " . $this->preparar_valor($valores[$i]);                                                
                    }
                }
                
                return implode($statement, ", ");
            }

            public function get_propriedades_preparadas($incluirPrimaryKey=true) {
                $propriedades = $this->get_propriedades();                
                
                $statement = [];
                for($i = 0; $i < count($propriedades); ++$i) {
                    if( ( empty($this->get_valores()[$i]) && $this->get_valores()[$i] != "0" ) || !$incluirPrimaryKey && $propriedades[$i] == $this::$primary_key ) continue;

                    $statement[] = $propriedades[$i];                    
                }

                return implode($statement, ", ");
            }

            public function get_valores_preparados($incluirPrimaryKey=true) {
                $propriedades = $this->get_propriedades_preparadas();                
                $propriedades = explode(", ", $propriedades);
                                 
                $statement = "";
                for( $i = 0; $i < count($propriedades); ++$i ) {
                    $statement .= $this->preparar_valor( $this->$propriedades[$i] );
                    
                    if( $i < count($propriedades)-1 ) $statement .= ", ";
                }                                                                    
                
                /*$i = 0;
                foreach( $valores as $key => $value ) {                    
                    ++$i;
                    if( empty($value) || !$incluirPrimaryKey && $key == $this::$primary_key ) continue;                    
                    
                    $statement .= $this->preparar_valor($value);
                    if( $i < count($valores) ) $statement .= ", ";                
                }*/

                return $statement;
            }                        
            
            private function cast_valor($valor) {
                if( gettype($valor) == "double" || gettype($valor) == "string" ) {
                    $valor = "'" . $valor . "'";
                }
                
                return $valor;
            }
            
            public function get_valor_escapado($valor) {
                $db = new Database();
                
                $tipoValor = gettype($valor);
                
                $valor_escapado = mysqli_real_escape_string($db->conexao, $valor);
                $valor_escapado = addcslashes($valor_escapado, "%_");                                
                
                switch($tipoValor) {
                    case "integer":
                        $valor_escapado = (int) $valor_escapado;
                        break;
                }
                
                return $valor_escapado;
            }
            
            private function preparar_valor($valor) {
                $valor = $this->get_valor_escapado( $valor );                
                $valor = $this->cast_valor($valor);
                
                return $valor;
            }
            
            function preparar_valor_exibicao($valor) {                                                
                //$valor = htmlentities($valor);                
                $valor = str_replace("\\", "", $valor);                                                                                             
                
                if( is_numeric($valor) ) {
                    $valor = (float) $valor;
                }
                
                return $valor;
            }
            
            private function get_valor_primary_key() {
                $nomePrimaryKey = $this::$primary_key;
                return $this->preparar_valor($this->get_propriedades_valores()[$nomePrimaryKey]);
            }                        
            
            function get_object_from_assoc_result($resultado) {
                $nomeClasse = get_class($this);
                $objeto = new $nomeClasse;

                $keys = array_keys($resultado);
                for($i = 0; $i < count($keys); ++$i) {
                    if( isset( $resultado[$keys[$i]] ) ) {
                        $objeto->$keys[$i] = $this->preparar_valor_exibicao($resultado[$keys[$i]]);
                    }
                }

                return $objeto;
            }

            public function get_array_from_resultado($resultado_sql) {
                $listaObjetos = [];
                
                if( $resultado_sql ) {
                    while($item = mysqli_fetch_assoc($resultado_sql)) {
                        $objeto = $this->get_object_from_assoc_result($item);

                        $listaObjetos[] = $objeto;
                    }
                }
                return $listaObjetos;
            }

            public function executarQuery($sql) {
                $db = new Database();                                
                $resultado = $db->query($sql);
                                
                if( mysqli_insert_id($db->conexao) != 0 ) return mysqli_insert_id($db->conexao);
                
                return $resultado;
            }                

            public function buscar($where = "") {                
                $sql = "SELECT * FROM " . $this::$nome_tabela;

                if( !empty($where) ) {
                    $sql .= " WHERE " . $where;
                }                                                                
                
                $resultado = $this->executarQuery($sql);                                
                
                return $this->get_array_from_resultado($resultado);            
            }                

            public function atualizar() {
                $sql = "UPDATE " . $this::$nome_tabela . " ";
                $sql .= "SET " . $this->get_update_valores($this) . " ";                        
                $sql .= "WHERE " . $this::$primary_key . " = " . $this->get_valor_primary_key();                                
                return $this->executarQuery($sql);
            }

            public function deletar() {
                $sql = "DELETE FROM " . $this::$nome_tabela . " ";
                $sql .= "WHERE " . $this::$primary_key . " = " . $this->get_valor_primary_key() . " ";
                $sql .= "LIMIT 1";                                                                
                
                return $this->executarQuery($sql);
            }

            public function inserir() {
                $sql = "INSERT INTO " . $this::$nome_tabela . "(" . $this->get_propriedades_preparadas(false) . ") ";
                $sql .= "VALUES(" . $this->get_valores_preparados(false) . ")";                                
                return $this->executarQuery($sql);
            }                        
        }
    }
?>