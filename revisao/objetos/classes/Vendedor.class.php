<?php
    require_once 'classes/Pessoa.class.php';
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

        function setIdade($idade) {
            if (is_numeric($idade) && $idade >= 0 && $idade <= 150) {
                if ($idade < 1) {
                    $this->idade = $idade . ' meses';    
                } else if ($idade <= 18 ) {
                    $this->idade = $idade . ' menor aprendiz';
                } else {
                    $this->idade = $idade;
                }
            } else {
                $this->idade = 0;
            }
        }
        
        function getIdade() {
            return $this->idade;
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

        function __toString() {
            return "Nome: {$this->nome}, Sexo: {$this->sexo}, Idade: {$this->idade}, Matrícula: {$this->matricula}";
        }

    }

?>