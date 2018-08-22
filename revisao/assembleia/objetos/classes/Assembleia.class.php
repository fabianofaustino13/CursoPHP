<?php
    
    class Assembleia {

        private $nomeAssembleia;
        private $dataAssembleia;
        
        public function setNome($nomeAssembleia) {
            $qtd = strlen($nomeAssembleia);
            if ($qtd > 1) {
                $this->nomeAssembleia = strtoupper($nomeAssembleia);
            } else {
                $this->nomeAssembleia = 'Sem Nome';
            }
        }
        
        public function getNome() {
            return $this->nomeAssembleia;
        }
        
        public function setData($dataAssembleia) {
            $this->dataAssembleia = $dataAssembleia;
        }
        
        public function getData() {
            return $this->dataAssembleia;
        }     
    }
?>