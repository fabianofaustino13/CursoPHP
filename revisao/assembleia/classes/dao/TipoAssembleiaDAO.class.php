<?php

require_once (__DIR__ . "/./Conexao.class.php");
require_once __DIR__ . "/../modelo/TipoAssembleia.class.php";

    class TipoAssembleiaDAO {

        private $conexao;

        function __construct() {
            $this->conexao = Conexao::get();
        }

        public function findAll() {
            $sql = "SELECT * FROM TB_TIPOS_ASSEMBLEIAS ORDER BY PK_TDA ASC";
            $statement = $this->conexao->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll();
            $tipoAssembleias = array();
            foreach ($result as $row) {
                $tipoAssembleia = new TipoAssembleia();
                $tipoAssembleia->setId($row['PK_TDA']);
                $tipoAssembleia->setNome($row['TDA_NOME']);
                array_push($tipoAssembleias, $tipoAssembleia);
            }
            return $tipoAssembleias;
        }

        public function findById($id) {
            $sql = "SELECT * FROM TB_TIPOS_ASSEMBLEIAS WHERE PK_TDA = :ID";
            $statement = $this->conexao->prepare($sql);
            $statement->bindParam(':ID', $id);
            $statement->execute();
            $result = $statement->fetchAll();
            $tipoAssembleia = new TipoAssembleia();
            foreach ($result as $row) {
                $tipoAssembleia->setId($row['PK_TDA']);
                $tipoAssembleia->setNome($row['TDA_NOME']);
            }
            return $tipoAssembleia;
        }

        public function findByNome($nome) {
            $sql = "SELECT * FROM TB_TIPOS_ASSEMBLEIAS WHERE TDA_NOME = :NOME";
            $statement = $this->conexao->prepare($sql);
            $statement->bindParam(':NOME', $nome);
            $statement->execute();
            $result = $statement->fetchAll();
            $tipoAssembleia = new TipoAssembleia();
            foreach ($result as $row) {
                $tipoAssembleia->setId($row['PK_TDA']);
                $tipoAssembleia->setNome($row['TDA_NOME']);
            }
            return $tipoAssembleia;
        }

        public function save(TipoAssembleia $tipoAssembleia) {
            if ($tipoAssembleia->getId() == null) {
                $this->insert($tipoAssembleia);
            } else {
                $this->update($tipoAssembleia);
            }
        }

        private function insert(TipoAssembleia $tipoAssembleia) {
            $sql = "INSERT INTO TB_TIPOS_ASSEMBLEIAS (TDA_NOME) VALUES (:NOME)";
            try {
                $statement = $this->conexao->prepare($sql);
                $nome = $tipoAssembleia->getNome();
                $statement->bindParam(':NOME', $nome);
                $statement->execute();
                return $this->findById($this->conexao->lastInsertId());
            } catch(PDOException $e) {
                echo $e->getMessage();
                return null;
            }
        }

        private function update(TipoAssembleia $tipoAssembleia) {
            $sql = "UPDATE TB_TIPOS_ASSEMBLEIAS SET TDA_NOME = :NOME WHERE PK_TDA= :ID";
            try {
                $statement = $this->conexao->prepare($sql);
                $nome = $tipoAssembleia->getNome();
                $id = $tipoAssembleia->getId();
                $statement->bindParam(':NOME', $nome);
                $statement->bindParam(':ID', $id);
                $statement->execute();
                return $this->findById($this->conexao->lastInsertId());
            } catch(PDOException $e) {
                echo $e->getMessage();
                return null;
            }
        }

        public function remove($id) {
            $sql = "DELETE FROM TB_TIPOS_ASSEMBLEIAS WHERE PK_TDA = :ID";
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