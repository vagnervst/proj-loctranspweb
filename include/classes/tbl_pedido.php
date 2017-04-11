<?php
    namespace Tabela {
        
        class Pedido extends \DB\DatabaseUtils {
            public static $nome_tabela = "tbl_pedido";
            public static $primary_key = "id";

            public $id;
            public $dataRetirada;
            public $dataEntrega;
            public $idPublicacao;
            public $idUsuarioLocador;
            public $idUsuarioLocatario;
            public $idStatusPedido;
            public $idTipoPedido;
            public $idFormaPagamento;
            public $idFuncionario;
            public $idCnh;
            public $idVeiculo;
        }

    }
?>