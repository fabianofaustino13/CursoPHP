<?php

require_once (__DIR__ . "/./Conexao.class.php");
require_once (__DIR__ . "/../modelo/Bloco.class.php");

    class BlocoDAO {

        public function findAll() {
            $sql = "SELECT * FROM TB_BLOCOS ORDER BY PK_BLO ASC";
            $statement = Conexao::get()->prepare($sql);
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
            $sql = "SELECT * FROM TB_BLOCOS WHERE PK_BLO = $id";
            $statement = Conexao::get()->prepare($sql);
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
            $sql = "SELECT * FROM TB_BLOCOS WHERE BLO_NOME = '$nome'";
            $statement = Conexao::get()->prepare($sql);
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
            $sql = "INSERT INTO TB_BLOCOS (BLO_NOME, BLO_APELIDO) VALUES ('{$bloco->getNome()}', '{$bloco->getApelido()}')";
            try {
                Conexao::get()->exec($sql);
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }

        private function update(Bloco $bloco) {
            $sql = "UPDATE TB_BLOCOS SET BLO_NOME ='{$bloco->getNome()}', BLO_APELIDO ='{$bloco->getApelido()}' WHERE PK_BLO ='{$bloco->getId()}'";
            try {
                Conexao::get()->exec($sql);
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }

        public function remove($id) {
            $sql = "DELETE FROM TB_BLOCOS WHERE PK_BLO=$id";
            try {
                Conexao::get()->exec($sql);
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    }