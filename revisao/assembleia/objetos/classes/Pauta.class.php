<?php
    
    require_once 'Assembleia.class.php';
    require_once 'Morador.class.php';
    require_once 'OpcaoPauta.class.php';

    class Pauta {

        private $assembleia;
        private $nomePauta;
        private $descricao;
        private $opcao;
        
        public function setNomeAssembleia(Assembleia $assembleia) {
            $this->assembleia = $assembleia;
        }
        
        public function getNomeAssembleia() {
            return $this->assembleia;
        }

        public function setNomePauta($nomePauta) {
            $this->nomePauta = $nomePauta;
        }
        
        public function getNomePauta() {
            return $this->nomePauta;
        }

        public function setDescricaoPauta($descricao) {
            $this->descricao = $descricao;
        }
        
        public function getDescricaoPauta() {
            return $this->descricao;
        }

        public function setOpcaoPauta(OpcaoPauta $opcao) {
            $this->opcao = $opcao;
        }
        
        public function getOpcaoPauta() {
            return $this->opcao;
        }
    }

?>