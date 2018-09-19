<?php
    
    require_once 'Assembleia.class.php';
    require_once 'Morador.class.php';
    require_once 'OpcaoPauta.class.php';

    class Pauta {

        private $id;
        private $nome;
        private $descricao;
        private $fkPauAss;
        
        public function setId($id) {
            $this->id = $id;
        }
        
        public function getId() {
            return $this->id;
        }

        public function setNome($nome) {
            $this->nome = $nome;
        }
        
        public function getNome() {
            return $this->nome;
        }

        public function setDescricao($descricao) {
            $this->descricao = $descricao;
        }
        
        public function getDescricao() {
            return $this->descricao;
        }

        public function setFkPauAss(OpcaoPauta $opcao) {
            $this->opcao = $opcao;
        }
        
        public function getOpcaoPauta() {
            return $this->opcao;
        }
    }

?>