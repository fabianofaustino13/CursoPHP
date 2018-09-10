<?php

    require_once(__DIR__ . "/./Sexo.class.php");

    class Cliente {

        private $id;
        private $nome;
        private $cpf;
        private $sexo;

        public function getId() {
            return $this->id;
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function getNome() {
            return $this->nome;
        }

        public function setNome($nome) {
            $this->nome = strtoupper($nome);
        }

        public function getCpf() {
            return $this->cpf;
        }

        public function setCpf($cpf) {
            $this->cpf = $cpf;
        }

        public function getSexo() {
            return $this->sexo;
        }

        public function setSexo(Sexo $sexo) {
            $this->sexo = $sexo;
        }
    }