<?php

abstract class Pessoa {

    protected $nome;
    protected $idade;
    protected $sexo;
    protected $cpf;

    function __construct($nome = '', $idade, $sexo = 'M',  $cpf) {
        $this->setNome($nome);
        $this->setIdade($idade);
        $this->setSexo($sexo);
        $this->setCpf($cpf);
    }

    function setNome($nome) {
        $qtd = strlen($nome);
        if ($qtd > 1) {
            $this->nome = strtoupper($nome);
        } else {
            $this->nome = 'Sem Nome';
        }
    }

    function getNome() {
        return $this->nome;
    }


    function setIdade($idade) {
        $this->idade = $idade;
    }

    function getIdade() {
        return $this->idade;
    }

    function setSexo($sexo) {
        $sex = strtoupper($sexo);
        if ($sex != 'F') {
            $this->sexo = 'M';
        } else {
            $this->sexo = 'F';
        }
    }

    function getSexo() {
        return $this->sexo;
    }
    
    function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    function getCpf() {
        return $this->cpf;
    }
}

?>