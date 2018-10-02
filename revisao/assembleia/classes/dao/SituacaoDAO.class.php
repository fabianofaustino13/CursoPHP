<?php

require_once (__DIR__ . "/./Conexao.class.php");
require_once (__DIR__ . "/../modelo/Situacao.class.php");

    class SituacaoDAO {

        private $conexao;

        function __construct() {
            $this->conexao = Conexao::get();
        }

        public function findAll() {
            $sql = "SELECT * FROM TB_SITUACAO ORDER BY PK_SIT DESC";
            $statement = $this->conexao->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll();
            $situacoes = array();
            foreach ($result as $row) {
                $situacao = new Situacao();
                $situacao->setId($row['PK_SIT']);
                $situacao->setNome($row['SIT_NOME']);
              
                array_push($situacoes, $situacao);
            }
            return $situacoes;
        }
    
        public function findById($id) {
            $sql = "SELECT * FROM TB_SITUACAO WHERE PK_SIT = :ID";
            $statement = $this->conexao->prepare($sql);
            $statement->bindParam(':ID', $id);
            $statement->execute();
            $result = $statement->fetchAll();
            $situacao = new Situacao();
            foreach ($result as $row) {   
                $situacao->setId($row['PK_SIT']);
                $situacao->setNome($row['SIT_NOME']);
            }
            return $situacao;
        }
      
        public function save(Situacao $situacao) {
            if (is_null($situacao->getId())) {
                return $this->insert($situacao);
            } else {
                return $this->update($situacao);
            }  
        }

        private function insert(Situacao $situacao) {
            $sql = "INSERT INTO TB_SITUACAO (SIT_NOME) VALUES (:NOME)";
            try {
                $statement = $this->conexao->prepare($sql);
                $nome = $situacao->getNome();
                $id = $situacao->getId();
                $statement->bindParam(':NOME', $nome);
                $statement->bindParam(':ID', $id);
                $statement->execute();
                return $this->findById($this->conexao->lastInsertId());

            } catch(PDOException $e) {
                echo $e->getMessage();
                return null;
            }
        }

        private function update(Situacao $situacao) {
            $sql = "UPDATE TB_SITUACAO SET SIT_NOME=:NOME WHERE PK_SIT=:ID";
            try {
                $statement = $this->conexao->prepare($sql);
                $nome = $situacao->getNome();
                $id = $situacao->getId();
                $statement->bindParam(':NOME', $nome);
                $statement->bindParam(':ID', $id);
                $statement->execute();
                return $this->findById($situacao->getId());
            } catch(PDOException $e) {
                echo $e->getMessage();
                return null;
            }
        }

        public function remove($id) {
            $sql = "DELETE FROM TB_SITUACAO WHERE PK_SIT = :ID";
            try {
                $statement = $this->conexao->prepare($sql);
                $statement->bindParam(':ID', $id);
                $statement->execute();
            } catch(PDOException $e) {
                echo $e->getMessage();
                return null;
            }
        }
    }