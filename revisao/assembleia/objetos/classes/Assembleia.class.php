<?php
    
    require_once 'Morador.class.php';

    class Assembleia {

        private $participante;
        private $nomeAssembleia;
        private $descricaoAssembleia;
        private $dataAssembleia;
        private $pauta;
        
        public function setParticipante(Morador $participante) {
            $this->participante = $participante;
        }
        
        public function getParticipante() {
            return $this->participante;
        }

        public function setNomeAssembleia($nomeAssembleia) {
            //$this->nomeAssembleia = $nomeAssembleia;
            $qtd = strlen($nomeAssembleia);
            if ($qtd > 1) {
                $this->nomeAssembleia = strtoupper($nomeAssembleia);
            } else {
                $this->nomeAssembleia = 'Sem Nome';
            }
        }
        
        public function getNomeAssembleia() {
            return $this->nomeAssembleia;
        }

        public function setDescricaoAssembleia($descricaoAssembleia) {
            $this->descricaoAssembleia = $descricaoAssembleia;
        }
        
        public function getDescricaoAssembleia() {
            return $this->descricaoAssembleia;
        }

        public function setDataAssembleia($dataAssembleia) {
            $this->dataAssembleia = $dataAssembleia;
        }
        
        public function getDataAssembleia() {
            return $this->dataAssembleia;
        }

        public function setPauta(Pauta $pauta) {
            $this->pauta = $pauta;
        }
        
        public function getPauta() {
            return $this->pauta;
        }

        

        // public abstract function saca($valor);

        // public function deposita($valor) {
        //     if (is_numeric($valor) && $valor > 0) {
        //         $this->saldo += $valor;
        //         return true;
        //     }
        //     return false;
        // }

        // public function transfere($valor, Conta $conta) {
        //     if ($this->saca($valor)) {
        //         $conta->deposita($valor);
        //         return true;
        //     }
        //     return false;
        // }

        // function __toString() {
        //     return "Nome: {$this->nome}, Idade: {$this->idade}, Sexo: {$this->sexo}, CPF: {$this->cpf}, Agência: {$this->agencia}, Conta: {$this->conta}";
        // }
    }

?>