<?php

require_once __DIR__ . "/../modelo/TipoAssembleia.class.php";

    class TipoAssembleiaDAO {

        public function findAll() {
            $sql = "SELECT * FROM TB_TIPOS_ASSEMBLEIAS";
            $statement = Conexao::get()->prepare($sql);
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
            $statement = Conexao::get()->prepare($sql);
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
            $statement = Conexao::get()->prepare($sql);
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
                Conexao::get()->exec($sql);
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }

        private function update(TipoAssembleia $tipoAssembleia) {
            $sql = "UPDATE TB_TIPOS_ASSEMBLEIAS SET TDA_NOME ='{$tipoAssembleia->getNome()}' WHERE PK_TDA='{$tipoAssembleia->getId()}'";
            try {
                Conexao::get()->exec($sql);
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }

        public function remove($id) {
            $sql = "DELETE FROM TB_TIPOS_ASSEMBLEIAS WHERE PK_TDA=$id";
            try {
                Conexao::get()->exec($sql);
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    }