<?php

    require_once 'Conta.class.php';
    require_once 'Cliente.class.php';
    require_once 'Corrente.class.php';

    class BancoDB {
        
        private const BANCO_DADOS = 'banco.txt';
        private const ESCRITA_APENAS = 'a';
        private const LEITURA_APENAS = 'r';
        
        //modelo do arquivo (<agencia|numero|saldo|nome|cpf>\n)
        public function salva(Conta $conta) {
            $db = fopen(self::BANCO_DADOS, self::ESCRITA_APENAS);
            fwrite($db, $conta);
            fclose($db);
        }

        public function listaTodas() {
            $db = fopen(self::BANCO_DADOS, self::LEITURA_APENAS);
            $str = fread($db, filesize(self::BANCO_DADOS));
            $contas = explode("->", $str);
            $lista = array();
            for ($i = 1; $i < count($contas); $i++) {
                $c = explode("|", $contas[$i]);

                $conta = new Corrente();
                $conta->setAgencia($c[0]);
                $conta->setNumero($c[1]);
                $conta->setSaldo($c[2]);

                $cliente = new Cliente();
                $cliente->setNome($c[3]);
                $cliente->setCpf($c[4]);

                $conta->setCliente($cliente);

                array_push($lista, $conta);
            }
            fclose($db);
            return $lista;
        }

        public function obterContaCliente($numero) {
            $contas = $this->listaTodas();
            foreach ($contas as $conta) {
                if ($conta->getNumero() == $numero) {
                    return $conta;
                }
            }
            return null;
        }

        public function obterNomeCliente($nome) {
            $contas = $this->listaTodas();
            foreach ($contas as $conta) {
                if ($conta->getCliente()->getNome() == $nome) {
                    return $conta;
                }
            }
            return null;
        }
        
    }


?>