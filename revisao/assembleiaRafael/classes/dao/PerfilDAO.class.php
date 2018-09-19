<?php

require_once (__DIR__ . "/./Conexao.class.php");
require_once (__DIR__ . "/../modelo/Perfil.class.php");

    class PerfilDAO {

        private $conexao;

        function __construct() {
            $this->conexao = Conexao::get();
        }

        public function findAll() {
            $sql = "SELECT * FROM TB_PERFIS ORDER BY PK_PER DESC";
            $statement = $this->conexao->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll();
            $perfis = array();
            foreach ($result as $row) {
                $perfil = new Perfil();
                $perfil->setId($row['PK_PER']);
                $perfil->setNome($row['PER_NOME']);
              
                array_push($perfis, $perfil);
            }
            return $perfis;
        }
    
        public function findById($id) {
            $sql = "SELECT * FROM TB_PERFIS WHERE PK_PER = :ID";
            $statement = $this->conexao->prepare($sql);
            $statement->bindParam(':ID', $id);
            $statement->execute();
            $result = $statement->fetchAll();
            $perfil = new Perfil();        
            foreach ($result as $row) {   
                $perfil->setId($row['PK_PER']);
                $perfil->setNome($row['PER_NOME']);
            }
            return $perfil;
        }
      
        public function save(Perfil $perfil) {
            if ($sindico->getId() == null) {
                $this->insert($perfil);
            } else {
                $this->update($perfil);
            }
        }

        private function insert(Perfil $perfil) {
            $sql = "INSERT INTO TB_PERFIS (PER_NOME) VALUES (:NOME)";
            try {
                $statement = $this->conexao->prepare($sql);
                $nome = $perfil->getNome();
                $id = $perfil->getId();
                $statement->bindParam(':NOME', $nome);
                $statement->bindParam(':ID', $id);
                $statement->execute();
                return $this->findById($this->conexao->lastInsertId());

            } catch(PDOException $e) {
                echo $e->getMessage();
                return null;
            }
        }

        private function update(Perfil $perfil) {
            $sql = "UPDATE TB_PERFIS SET PER_NOME=:NOME WHERE PK_PER=:ID";
            try {
                $statement = $this->conexao->prepare($sql);
                $nome = $perfil->getNome();
                $id = $perfil->getId();
                $statement->bindParam(':NOME', $nome);
                $statement->bindParam(':ID', $id);
                $statement->execute();
                return $this->findById($sindico->getId());
            } catch(PDOException $e) {
                echo $e->getMessage();
                return null;
            }
        }

        public function remove($id) {
            $sql = "DELETE FROM TB_PERFIS WHERE PK_PER = :ID";
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