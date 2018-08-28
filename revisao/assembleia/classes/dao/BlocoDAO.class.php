<?php

require_once (__DIR__ . "/./Conexao.class.php");
require_once (__DIR__ . "/../modelo/Bloco.class.php");

    class BlocoDAO {

        private $conexao;

        function __construct() {
            $this->conexao = Conexao::get();
        }

        public function findAll() {
            $sql = "SELECT * FROM TB_BLOCOS ORDER BY PK_BLO ASC";
            $statement = $this->conexao->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll();
            $blocos = array();
            foreach ($result as $row) {
                $bloco = new Bloco();
                $bloco->setId($row['PK_BLO']);
                $bloco->setNome($row['BLO_NOME']);
                $bloco->setApelido($row['BLO_APELIDO']);
              
                array_push($blocos, $bloco);
            }
            return $blocos;
        }

        public function findById($id) {
            $sql = "SELECT * FROM TB_BLOCOS WHERE PK_BLO = :ID";
            $statement = $this->conexao->prepare($sql);
            $statement->bindParam(':ID', $id); //Proteção contra sql injetct
            $statement->execute();
            $result = $statement->fetchAll();
            $bloco = new Bloco();
            foreach ($result as $row) {
                $bloco->setId($row['PK_BLO']);
                $bloco->setNome($row['BLO_NOME']);
                $bloco->setApelido($row['BLO_APELIDO']);
            }
            return $bloco;
        }

        public function findByNome($nome) {
            $sql = "SELECT * FROM TB_BLOCOS WHERE BLO_NOME = :NOME";
            $statement = $this->conexao->prepare($sql);
            $statement->bindParam(':NOME', $nome); //Proteção contra sql injetct
            $statement->execute();
            $result = $statement->fetchAll();
            $bloco = new Bloco();
            foreach ($result as $row) {
                $bloco->setId($row['PK_BLO']);
                $bloco->setNome($row['BLO_NOME']);
                $bloco->setApelido($row['BLO_APELIDO']);
            }
            return $bloco;
        }

        public function save(Bloco $bloco) {
            if ($bloco->getId() == null) {
                $this->insert($bloco);
            } else {
                $this->update($bloco);
            }
        }

        private function insert(Bloco $bloco) {
            $sql = "INSERT INTO TB_BLOCOS (BLO_NOME, BLO_APELIDO) VALUES (:NOME, :APELIDO')";
            try {
                $statement = $this->conexao->prepare($sql);
                $nome = $bloco->getNome();
                $apelido = $bloco->getData();
                $statement->bindParam(':NOME', $nome);
                $statement->bindParam(':APELIDO', $apelido);
                $statement->execute();
                return $this->findById($this->conexao->lastInsertId());
            } catch(PDOException $e) {
                echo $e->getMessage();
                return null;
            }
        }

        private function update(Bloco $bloco) {
            $sql = "UPDATE TB_BLOCOS SET BLO_NOME = :NOME, BLO_APELIDO = :APELIDO WHERE PK_BLO = :ID";
            try {
                $statement = $this->conexao->prepare($sql);
                $nome = $bloco->getNome();
                $apelido = $bloco->getData();
                $id = $bloco->getId();
                $statement->bindParam(':NOME', $nome);
                $statement->bindParam(':APELIDO', $apelido);
                $statement->bindParam(':ID', $id);
                $statement->execute();
                return $this->findById($this->conexao->lastInsertId());
            } catch(PDOException $e) {
                echo $e->getMessage();
                return null;
            }
        }

        public function remove($id) {
            $sql = "DELETE FROM TB_BLOCOS WHERE PK_BLO = :ID";
            try {
                $statement = $this->conexao->prepare($sql);
                $id = $bloco->getId();
                $statement->bindParam(':ID', $id);
                $statement->execute();
            } catch(PDOException $e) {
                echo $e->getMessage();
                return null;
            }
        }
    }