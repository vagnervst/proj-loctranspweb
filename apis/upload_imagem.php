<?php
    require_once("../include/classes/file.php");

    $imagem = ( isset($_FILES["imagem"]) )? $_FILES["imagem"] : null;
    $upload_dir = ( isset($_POST["dir"]) )? $_POST["dir"] : null;
    $nome_arquivo = ( isset($_POST["filename"]) )? $_POST["filename"] : null;
    $nome_arquivo_antigo = ( isset($_POST["oldfile"]) )? $_POST["oldfile"] : null;
    
    var_dump($imagem);
    var_dump($upload_dir);
    var_dump($nome_arquivo);
    var_dump($nome_arquivo_antigo);

    if( !empty($imagem) && !empty($upload_dir) ) {        
        if( !is_dir( $upload_dir ) ) return;
        
        if( !empty( $nome_arquivo_antigo ) ) {            
            File::replace( $imagem, $nome_arquivo, $nome_arquivo_antigo, $upload_dir );
        } else {            
            File::upload( $imagem, $nome_arquivo, $upload_dir );
        }
    }
?>