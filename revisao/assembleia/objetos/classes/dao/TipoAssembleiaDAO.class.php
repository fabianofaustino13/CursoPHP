<?php

require_once __DIR__ . "/../modelo/TipoAssembleia.class.php";

    class TipoAssembleiaDAO {

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
            $sql = "SELECT * FROM TB_TIPOS_ASSEMBLEIAS";
            $statement = $this->getConexao()->prepare($sql);
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
            $sql = "SELECT * FROM TB_TIPOS_ASSEMBLEIAS WHERE PK_TDA = $id";
            $statement = $this->getConexao()->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll();
            $tipoAssembleia = new Assembleia();
            foreach ($result as $row) {
                $tipoAssembleia->setId($row['PK_TDA']);
                $tipoAssembleia->setNome($row['TDA_NOME']);
            }
            return $tipoAssembleia;
        }

        public function findByNome($nome) {
            $sql = "SELECT * FROM TB_TIPOS_ASSEMBLEIAS WHERE TDA_NOME = '$nome'";
            $statement = $this->getConexao()->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll();
            $tipoAssembleia = new Assembleia();
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
            $sql = "INSERT INTO TB_TIPOS_ASSEMBLEIAS (TDA_NOME) VALUES ('{$tipoAssembleia->getNome()}')";
            try {
                $this->getConexao()->exec($sql);
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
            //$statement = $this->getConexao()->prepare($sql);
            //$statement->execute();
        }

        private function update(TipoAssembleia $tipoAssembleia) {
            $sql = "UPDATE TB_TIPOS_ASSEMBLEIAS SET TDA_NOME ='{$tipoAssembleia->getNome()}' WHERE PK_TDA='{$tipoAssembleia->getId()}'";
            try {
                $this->getConexao()->exec($sql);
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }

        public function remove($id) {
            $sql = "DELETE FROM TB_TIPOS_ASSEMBLEIAS WHERE PK_TDA=$id";
            try {
                $this->getConexao()->exec($sql);
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    }