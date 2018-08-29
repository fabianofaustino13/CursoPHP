<?php

require_once (__DIR__ . "/./Conexao.class.php");
require_once (__DIR__ . "/../modelo/Assembleia.class.php");
require_once (__DIR__ . "/../modelo/TipoAssembleia.class.php");

    class AssembleiaDAO {
        
        private $conexao;

        function __construct() {
            $this->conexao = Conexao::get();
        }

        public function findAll() {
            $sql = "SELECT * FROM TB_ASSEMBLEIAS JOIN TB_TIPOS_ASSEMBLEIAS ON PK_TDA = FK_ASS_TDA ORDER BY ASS_DATA DESC";
            $statement = $this->conexao->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll();
            $assembleias = array();
            foreach ($result as $row) {
                $assembleia = new Assembleia();
                $assembleia->setId($row['PK_ASS']);
                $assembleia->setNome($row['ASS_NOME']);
                $assembleia->setData($row['ASS_DATA']);
                $assembleia->setTipoAssembleia($row['PK_TDA']);
                array_push($assembleias, $assembleia);
            }
            return $assembleias;
        }

        public function findById($id) {
            $sql = "SELECT * FROM TB_ASSEMBLEIAS WHERE PK_ASS = :ID";
            $statement = $this->conexao->prepare($sql);
            $statement->bindParam(':ID', $id); //Proteção contra sql injetct
            $statement->execute();
            $result = $statement->fetchAll();
            $assembleia = new Assembleia();
            foreach ($result as $row) {
                $assembleia->setId($row['PK_ASS']);
                $assembleia->setNome($row['ASS_NOME']);
                $assembleia->setData($row['ASS_DATA']);
                $assembleia->setTipoAssembleia($row['FK_ASS_TDA']);
            }
            return $assembleia;
        }

        public function findByNome($nome) {
            $sql = "SELECT * FROM TB_ASSEMBLEIAS WHERE ASS_NOME = NOME";
            $statement = $this->conexao->prepare($sql);
            $statement->bindParam(':NOME', $nome); //Proteção contra sql injetct
            $statement->execute();
            $result = $statement->fetchAll();
            $assembleia = new Assembleia();
            foreach ($result as $row) {
                $assembleia->setId($row['PK_ASS']);
                $assembleia->setNome($row['ASS_NOME']);
                $assembleia->setData($row['ASS_DATA']);
                $assembleia->setTipoAssembleia($row['FK_ASS_TDA']);
            }
            return $assembleia;
        }

        public function save(Assembleia $assembleia) {
            if ($assembleia->getId() == null) {
                $this->insert($assembleia);
            } else {
                $this->update($assembleia);
            }
        }

        private function insert(Assembleia $assembleia) {
            $sql = "INSERT INTO TB_ASSEMBLEIAS (ASS_NOME, ASS_DATA, FK_ASS_TDA) VALUES (:NOME, :DATAASSEMBLEIA, :TIPOASSEMBLEIA)";
            try {
                $statement = $this->conexao->prepare($sql);
                $nome = $assembleia->getNome();
                $data = $assembleia->getData();
                $tipo = $assembleia->getTipoAssembleia();
                $statement->bindParam(':NOME', $nome);
                $statement->bindParam(':DATAASSEMBLEIA', $data);
                $statement->bindParam(':TIPOASSEMBLEIA', $tipo);
                $statement->execute();
                return $this->findById($this->conexao->lastInsertId());
            } catch(PDOException $e) {
                echo $e->getMessage();
                return null;
            }
        }

        private function update(Assembleia $assembleia) {
            $sql = "UPDATE TB_ASSEMBLEIAS SET ASS_NOME = :NOME, ASS_DATA = :DATAASSEMBLEIA, FK_ASS_TDA = :TIPOASSEMBLEIA WHERE PK_ASS = :ID";
            try {
                $statement = $this->conexao->prepare($sql);
                $nome = $assembleia->getNome();
                $data = $assembleia->getData();
                $tipo = $assembleia->getTda();
                $id = $assembleia->getId();
                $statement->bindParam(':NOME', $nome);
                $statement->bindParam(':DATAASSEMBLEIA', $data);
                $statement->bindParam(':TIPOASSEMBLEIA', $tipo);
                $statement->bindParam(':ID', $id);
                $statement->execute();
                return $this->findById($this->conexao->lastInsertId());
            } catch(PDOException $e) {
                echo $e->getMessage();
                return null;
            }
        }

        public function remove($id) {
            $sql = "DELETE FROM TB_ASSEMBLEIAS WHERE PK_ASS = :ID";
            try {
                $statement = $this->conexao->prepare($sql);
                $id = $assembleia->getId();
                $statement->bindParam(':ID', $id);
                $statement->execute();
                return $this->findById($this->conexao->lastInsertId());
            } catch(PDOException $e) {
                echo $e->getMessage();
                return null;
            }
        }


    }