<?php
    require_once("../../include/initialize.php");
    require_once("../../include/classes/tbl_publicacao.php");
    
    $id = ( isset($_POST["idAnuncio"]) )? (int) $_POST["idAnuncio"] : null;
    $titulo = ( isset($_POST["titulo"]) )? $_POST["titulo"] : null;
    $descricao = ( isset($_POST["descricao"]) )? $_POST["descricao"] : null;
    $valorDiaria = ( isset($_POST["valorDiaria"]) )? (double) $_POST["valorDiaria"] : null;
    $valorCombustivel = ( isset($_POST["valorCombustivel"]) )? (double) $_POST["valorCombustivel"] : null;
    $valorQuilometragem = ( isset($_POST["valorQuilometragem"]) )? (double) $_POST["valorQuilometragem"] : null;
    $valorVeiculo = ( isset($_POST["valorVeiculo"]) )? (double) $_POST["valorVeiculo"] : null;
    $quilometragemAtual = ( isset($_POST["quilometragemAtual"]) )? (int) $_POST["quilometragemAtual"] : null;
    $limiteQuilometragem = ( isset($_POST["limiteQuilometragem"]) )? (int) $_POST["limiteQuilometragem"] : null;    
    $imagemPrincipal = ( isset($_POST["imagemPrincipal"]) )? $_POST["imagemPrincipal"] : null;    
    $imagemA = ( isset($_POST["imagemA"]) )? $_POST["imagemA"] : null;
    $imagemB = ( isset($_POST["imagemB"]) )? $_POST["imagemB"] : null;
    $imagemC = ( isset($_POST["imagemC"]) )? $_POST["imagemC"] : null;
    $imagemD = ( isset($_POST["imagemD"]) )? $_POST["imagemD"] : null;    
    $idUsuario = ( isset($_POST["idUsuario"]) )? (int) $_POST["idUsuario"] : null;
    $idVeiculo = ( isset($_POST["idVeiculo"]) )? (int) $_POST["idVeiculo"] : null;
    $modo = ( isset($_POST["modo"]) )? $_POST["modo"] : null;
    $status_publicacao_pendente = 3;

    $publicacao = new \Tabela\Publicacao();
    $publicacao->titulo = $titulo;
    $publicacao->descricao = $descricao;
    $publicacao->valorDiaria = $valorDiaria;
    $publicacao->valorCombustivel = $valorCombustivel;
    $publicacao->valorQuilometragem = $valorQuilometragem;
    $publicacao->valorVeiculo = $valorVeiculo;
    $publicacao->quilometragemAtual = $quilometragemAtual;
    $publicacao->limiteQuilometragem = $limiteQuilometragem;
    $publicacao->idUsuario = $idUsuario;
    $publicacao->idVeiculo = $idVeiculo;
    $publicacao->idStatusPublicacao = $status_publicacao_pendente;
    $publicacao->dataPublicacao = get_data_atual_mysql();
    $publicacao->disponivelOnline = 1;        

    $resultado = false;
    if( $modo == "insert" ) {
        $idAnuncio = $publicacao->inserir();   
                        
        if( $idAnuncio > 0 ) {
            
            $pasta = "../../img/uploads/publicacoes";            
            $nome_arquivo_img_principal = "post_{$idAnuncio}_imagem_principal.jpeg";

            if( upload_base64_image( $imagemPrincipal, $nome_arquivo_img_principal, $pasta ) ) {
                $publicacao->imagemPrincipal = $nome_arquivo_img_principal;
            }
            
            $nome_arquivo_img_a = "post_{$idAnuncio}_imagem_a.jpeg";
            if( upload_base64_image( $imagemA, $nome_arquivo_img_a, $pasta ) ) {
                $publicacao->imagemA = $nome_arquivo_img_a;
            }
            
            $nome_arquivo_img_b = "post_{$idAnuncio}_imagem_b.jpeg";
            if( upload_base64_image( $imagemB, $nome_arquivo_img_b, $pasta ) ) {
                $publicacao->imagemB = $nome_arquivo_img_b;
            }
            
            $nome_arquivo_img_c = "post_{$idAnuncio}_imagem_c.jpeg";
            if( upload_base64_image( $imagemC, $nome_arquivo_img_c, $pasta ) ) {
                $publicacao->imagemC = $nome_arquivo_img_c;
            }
            
            $nome_arquivo_img_d = "post_{$idAnuncio}_imagem_d.jpeg";
            if( upload_base64_image( $imagemD, $nome_arquivo_img_d, $pasta ) ) {
                $publicacao->imagemD = $nome_arquivo_img_d;
            }
            
            $publicacao->id = (int) $idAnuncio;
            $publicacao->atualizar();
            $resultado = true;
        }
        
    } elseif( $modo == "update" ) {
        $publicacao->id = $id;
        $resultado = $publicacao->atualizar();
    } elseif( $modo == "delete" ) {
        
    }    

    echo json_encode($resultado);
?>