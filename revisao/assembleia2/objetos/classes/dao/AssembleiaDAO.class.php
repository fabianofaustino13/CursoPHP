<?php

require_once __DIR__ . "/../modelo/Assembleia.class.php";

    class AssembleiaDAO {

        private function getConexao() {
            $servidor = "localhost";
            $usuario = "root";
            $senha = "";
            $db = "db_Assembleia";
            $conn = new PDO("mysql:host=$servidor; dbname=$db", $usuario, $senha);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        }

        public function findAll() {
            $sql = "SELECT * FROM TB_ASSEMBLEIAS";
            $statement = $this->getConexao()->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll();
            $assembleias = array();
            foreach ($result as $row) {
                $assembleia = new Assembleia();
                $assembleia->setId($row['PK_ASS']);
                $assembleia->setNome($row['ASS_NOME']);
                $assembleia->setData($row['ASS_DATA']);
                array_push($assembleias, $assembleia);
            }
            return $assembleias;
        }

        public function findById($id) {
            $sql = "SELECT * FROM TB_ASSEMBLEIAS WHERE PK_ASS = $id";
            $statement = $this->getConexao()->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll();
            $assembleia = new Assembleia();
            foreach ($result as $row) {
                $assembleia->setId($row['PK_ASS']);
                $assembleia->setNome($row['ASS_NOME']);
                $assembleia->setData($row['ASS_DATA']);
            }
            return $assembleia;
        }

        public function findByNome($nome) {
            $sql = "SELECT * FROM TB_ASSEMBLEIAS WHERE ASS_NOME = '$nome'";
            $statement = $this->getConexao()->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll();
            $assembleia = new Assembleia();
            foreach ($result as $row) {
                $assembleia->setId($row['PK_ASS']);
                $assembleia->setNome($row['ASS_NOME']);
                $assembleia->setData($row['ASS_DATA']);
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
            $sql = "INSERT INTO TB_ASSEMBLEIAS (ASS_NOME, ASS_DATA) VALUES ('{$assembleia->getNome()}', '{$assembleia->getData()}')";
            try {
                $this->getConexao()->exec($sql);
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }

        private function update(Assembleia $assembleia) {
            $sql = "UPDATE TB_ASSEMBLEIAS SET ASS_NOME ='{$assembleia->getNome()}', ASS_DATA = '{$assembleia->getData()}' WHERE PK_ASS='{$assembleia->getId()}'";
            try {
                $this->getConexao()->exec($sql);
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }

        public function remove($id) {
            $sql = "DELETE FROM TB_ASSEMBLEIAS WHERE PK_ASS=$id";
            try {
                $this->getConexao()->exec($sql);
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }


    }