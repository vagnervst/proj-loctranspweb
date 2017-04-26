function JSMask() {
    /*
        D = digito
        C = letra

        ---Formato das Mascaras---
        DD#.DD
        CC#/CC    
    */
    
    this.indicador_caractere_formatacao = '#';
    this.DIGITO = 'D';
    this.LETRA = 'C';
    this.digits = [ '0', '1', '2', '3', '4', '5', '6', '7', '8', '9' ];
    this.chars = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'];        
    
    this.is_digit = function( char ) {
        
        for( var i = 0; i < this.digits.length; ++i ) {            
            if( this.digits[i] == char ) return true;
        }
        
        return false;
    };
    
    this.is_char = function( char ) {
        char = char.toLowerCase();
        
        for( var i = 0; i < this.chars.length; ++i ) {            
            if( this.chars[i] == char ) return true;
        }
        
        return false;        
    }
    
    this.preparar_mascara_entrada = function( mascara ) {
        mascara = this.preparar_mascara_formatacao(mascara);
        
        for( var i = 0; i < mascara.length; ++i ) {
            if( mascara[i].indexOf( this.indicador_caractere_formatacao ) !== -1 ) {
                mascara.splice(i, 1);
            }
        }
        
        return mascara;
    }
    
    this.preparar_mascara_formatacao = function( mascara ) {
        mascara = mascara.split('');
        
        for( var i = 0; i < mascara.length; ++i ) {
            
            if( mascara[i] === this.indicador_caractere_formatacao ) {
                mascara[i] = mascara[i] + mascara[i+1];
                mascara.splice( i+1, 1 );
            }            
        }
        
        return mascara;
    }
    
    this.unformat_entrada = function( entrada, mascara_formatacao ) {
        entrada = entrada.split('');                
        
        for( var i = 0; i < mascara_formatacao.length; ++i ) {            
            
            if( mascara_formatacao[i].indexOf( this.indicador_caractere_formatacao ) !== -1 ) {                
                var caractere_fixo = mascara_formatacao[i][1];
                
                if( entrada[i] === caractere_fixo ) {
                    entrada.splice(i, 1);
                }
            }            
        }
        
        return entrada;
    }
    
    this.capturar_indice_caractere_pressionado = function( entrada ) {
        return ( entrada.length > 0 )? entrada.length-1 : entrada.length;
    }
    
    this.verificar_compatibilidade_entrada = function( caractere_pressionado, mascara_entrada, indice ) {
        var tipo_caractere_esperado = mascara_entrada[indice];
        
        if( tipo_caractere_esperado === this.DIGITO && this.is_digit( caractere_pressionado ) ) {
            return true;
        } else if( tipo_caractere_esperado === this.LETRA && this.is_char( caractere_pressionado ) ) {
            return true;
        }
        
        return false;
    }
    
    this.formatar_entrada = function( entrada, mascara_formatacao ) {        
        var entrada_formatada = entrada.split('');
        
        for( var i = 0; i < entrada_formatada.length; ++i ) {
            
            if( mascara_formatacao[i+1] !== undefined && mascara_formatacao[i+1].indexOf( this.indicador_caractere_formatacao ) !== -1 ) {
                var caractere_a_inserir = mascara_formatacao[i+1][1];
                
                if( entrada_formatada[i+1] !== caractere_a_inserir ) {
                    entrada_formatada.splice( i+1, 0, caractere_a_inserir );
                }
            }
        }
        
        entrada_formatada = entrada_formatada.join('');
        
        entrada_formatada = entrada_formatada.replace(',', '');
        return entrada_formatada;
    }
    
    this.processar_entrada = function( entrada, caractere_pressionado, mascara ) {                
        mascara_entrada = this.preparar_mascara_entrada( mascara );
        var indice_a_inserir = this.capturar_indice_caractere_pressionado( this.unformat_entrada(entrada, this.preparar_mascara_formatacao(mascara)) );
        
        if( indice_a_inserir >= mascara_entrada.length-1 ) return false;
        
        return this.verificar_compatibilidade_entrada( caractere_pressionado, mascara_entrada, indice_a_inserir );
    }
    
    this.mask_initializer = function( entrada, mascara ) {
        
        var self = this;
        $( entrada ).keydown(function(e) {                        
            var valor_entrada = entrada.value;                                    
            var caractere_pressionado = e.key;
            
            if( caractere_pressionado === "Backspace" || caractere_pressionado === "Tab" ) return true;
            
            var resultado = self.processar_entrada( valor_entrada, caractere_pressionado, mascara );
            
            return resultado;
        });
        
        $( entrada ).keyup(function(e) {
            var caractere_pressionado = e.key;
                        
            if( caractere_pressionado === "Backspace" || caractere_pressionado === "Tab" ) return true;
            
            entrada.value = self.formatar_entrada( entrada.value, self.preparar_mascara_formatacao( mascara ) );            
        });
    }
    
    this.aplicar_mascara = function() {
        var entradas_mascara = $(".js-mask");
        
        for( var i = 0; i < entradas_mascara.length; ++i ) {            
            var entrada = entradas_mascara[i];
            var mascara = $(entrada).attr( "data-mask" );
            
            this.mask_initializer( entrada, mascara );
        }
    };   
}

$(document).ready(function() {    
    var jsMask = new JSMask();
    jsMask.aplicar_mascara();
    
});