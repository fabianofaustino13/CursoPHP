<?php

require_once (__DIR__ . "/./Conexao.class.php");
require_once (__DIR__ . "/../modelo/Ocupacao.class.php");

    class OcupacaoDAO {

        private $conexao;

        function __construct() {
            $this->conexao = Conexao::get();
        }

        public function findAll() {
            $sql = "SELECT * FROM TB_OCUPACAO ORDER BY PK_OCU DESC";
            $statement = $this->conexao->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll();
            $ocupacoes = array();
            foreach ($result as $row) {
                $ocupacao = new Ocupacao();
                $ocupacao->setId($row['PK_OCU']);
                $ocupacao->setNome($row['OCU_NOME']);
              
                array_push($ocupacoes, $ocupacao);
            }
            return $ocupacoes;
        }
    
        public function findById($id) {
            $sql = "SELECT * FROM TB_OCUPACAO WHERE PK_OCU = :ID";
            $statement = $this->conexao->prepare($sql);
            $statement->bindParam(':ID', $id);
            $statement->execute();
            $result = $statement->fetchAll();
            $ocupacao = new Ocupacao();
            foreach ($result as $row) {   
                $ocupacao->setId($row['PK_OCU']);
                $ocupacao->setNome($row['OCU_NOME']);
            }
            return $ocupacao;
        }
      
        public function save(Situacao $ocupacao) {
            if (is_null($ocupacao->getId())) {
                return $this->insert($ocupacao);
            } else {
                return $this->update($ocupacao);
            }  
        }

        private function insert(Situacao $ocupacao) {
            $sql = "INSERT INTO TB_OCUPACAO (OCU_NOME) VALUES (:NOME)";
            try {
                $statement = $this->conexao->prepare($sql);
                $nome = $ocupacao->getNome();
                $id = $ocupacao->getId();
                $statement->bindParam(':NOME', $nome);
                $statement->bindParam(':ID', $id);
                $statement->execute();
                return $this->findById($this->conexao->lastInsertId());

            } catch(PDOException $e) {
                echo $e->getMessage();
                return null;
            }
        }

        private function update(Situacao $ocupacao) {
            $sql = "UPDATE TB_OCUPACAO SET OCU_NOME=:NOME WHERE PK_OCU=:ID";
            try {
                $statement = $this->conexao->prepare($sql);
                $nome = $ocupacao->getNome();
                $id = $ocupacao->getId();
                $statement->bindParam(':NOME', $nome);
                $statement->bindParam(':ID', $id);
                $statement->execute();
                return $this->findById($ocupacao->getId());
            } catch(PDOException $e) {
                echo $e->getMessage();
                return null;
            }
        }

        public function remove($id) {
            $sql = "DELETE FROM TB_OCUPACAO WHERE PK_OCU = :ID";
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