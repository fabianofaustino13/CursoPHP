<?php

    class Vendedor extends Pessoa {

        private $matricula;
        private $data_admissao;
        private $data_demissao;

        function __construct($nome, $sexo, $idade, $matricula, $data_admissao, $data_demissao) {
            parent::__construct($nome, $sexo, $idade);
            $this->setMatricula($matricula);
            $this->setDataAdmissao($data_admissao);
            $this->setDataDemissao($data_demissao);
        }

        function setMatricula($matricula) {
            $this->matricula = $matricula;
        }

        function getMatricula() {
            return $this->matricula;
        }

        function setDataAdmissao($data_admissao) {
            $this->data_admissao = $data_admissao;
        }

        function getDataAdmissao() {
            return $this->data_admissao;
        }
        
        function setDataDemissao($data_demissao) {
            if ($this->data_demissao != '') {
                $this->data_demissao = $data_demissao;
            } else {
                $this->data_demissao = 'Vendedor ativo';
            }
        }

        function getDataDemissao() {
           return $this->data_demissao;
        }

    }

?>