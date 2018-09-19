<?php
    
    require_once 'Morador.class.php';

    class OpcaoPauta {

        private $opcao;

        public function setOpcao($opcao) {
            $this->opcao = $opcao;
        }
        
        public function getOpcao() {
            return $this->opcao;
        }
    }

?>