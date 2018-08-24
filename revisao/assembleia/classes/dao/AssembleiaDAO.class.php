<?php

require_once (__DIR__ . "/./Conexao.class.php");
require_once (__DIR__ . "/../modelo/Assembleia.class.php");
require_once (__DIR__ . "/../modelo/TipoAssembleia.class.php");

    class AssembleiaDAO {
        
        public function findAll() {
            $sql = "SELECT * FROM TB_ASSEMBLEIAS ORDER BY ASS_DATA DESC";
            $statement = Conexao::get()->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll();
            $assembleias = array();
            foreach ($result as $row) {
                $assembleia = new Assembleia();
                $assembleia->setId($row['PK_ASS']);
                $assembleia->setNome($row['ASS_NOME']);
                $assembleia->setData($row['ASS_DATA']);
                $assembleia->setFkTda($row['FK_ASS_TDA']);
                array_push($assembleias, $assembleia);
            }
            return $assembleias;
        }

        public function findById($id) {
            $sql = "SELECT * FROM TB_ASSEMBLEIAS WHERE PK_ASS = $id";
            $statement = Conexao::get()->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll();
            $assembleia = new Assembleia();
            foreach ($result as $row) {
                $assembleia->setId($row['PK_ASS']);
                $assembleia->setNome($row['ASS_NOME']);
                $assembleia->setData($row['ASS_DATA']);
                $assembleia->setFkTda($row['FK_ASS_TDA']);
            }
            return $assembleia;
        }

        public function findByNome($nome) {
            $sql = "SELECT * FROM TB_ASSEMBLEIAS WHERE ASS_NOME = '$nome'";
            $statement = Conexao::get()->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll();
            $assembleia = new Assembleia();
            foreach ($result as $row) {
                $assembleia->setId($row['PK_ASS']);
                $assembleia->setNome($row['ASS_NOME']);
                $assembleia->setData($row['ASS_DATA']);
                $assembleia->setFkTda($row['FK_ASS_TDA']);
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
            $sql = "INSERT INTO TB_ASSEMBLEIAS (ASS_NOME, ASS_DATA, FK_ASS_TDA) VALUES ('{$assembleia->getNome()}', '{$assembleia->getData()}', {$assembleia->getFkTda()})";
            try {
                Conexao::get()->exec($sql);
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }

        private function update(Assembleia $assembleia) {
            $sql = "UPDATE TB_ASSEMBLEIAS SET ASS_NOME ='{$assembleia->getNome()}', ASS_DATA = '{$assembleia->getData()}', FK_ASS_TDA = {$assembleia->getFkTda()}  WHERE PK_ASS='{$assembleia->getId()}'";
            try {
                Conexao::get()->exec($sql);
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }

        public function remove($id) {
            $sql = "DELETE FROM TB_ASSEMBLEIAS WHERE PK_ASS=$id";
            try {
                Conexao::get()->exec($sql);
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }


    }