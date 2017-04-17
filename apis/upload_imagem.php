<?php
    require_once("../include/classes/file.php");

    $imagem = ( isset($_FILES["imagem"]) )? $_FILES["imagem"] : null;
    $upload_dir = ( isset($_POST["dir"]) )? $_POST["dir"] : null;
    $nome_arquivo = ( isset($_POST["filename"]) )? $_POST["filename"] : null;
    $nome_arquivo_antigo = ( isset($_POST["oldfile"]) )? $_POST["oldfile"] : null;

    if( !empty($imagem) && !empty($upload_dir) ) {
        if( !is_dir( $upload_dir ) ) return;    
        
        if( !empty( $nome_arquivo_antigo ) ) {
            File::replace( $imagem["tmp_name"], $nome_arquivo, $nome_arquivo_antigo, $upload_dir );
        } else {
            File::upload( $imagem["tmp_name"], $nome_arquivo, $upload_dir );
        }
    }
?>