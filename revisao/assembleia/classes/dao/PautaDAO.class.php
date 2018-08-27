<?php

require_once (__DIR__ . "/./Conexao.class.php");
require_once __DIR__ . "/../modelo/Pauta.class.php";
require_once (__DIR__ . "/../modelo/Assembleia.class.php");
require_once (__DIR__ . "/../modelo/TipoAssembleia.class.php");

    class PautaDAO {

        public function findAll() {
            $sql = "SELECT * FROM TB_PAUTAS ORDER BY PK_PAU DESC";
            $statement = Conexao::get()->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll();
            $pautas = array();
            foreach ($result as $row) {
                $pauta = new Pauta();
                $pauta->setId($row['PK_PAU']);
                $pauta->setNome($row['PAU_NOME']);
                $pauta->setDescricao($row['PAU_DESCRICAO']);
                $pauta->setStatus($row['PAU_STATUS']);
                $pauta->setVoto($row['PAU_VOTOS']);
                $pauta->setFkPauAss($row['FK_PAU_ASS']);

                array_push($pautas, $pauta);
            }
            return $pautas;
        }

        public function findAllAssembleia($assembleia) {
            $sql = "SELECT * FROM TB_PAUTAS WHERE FK_PAU_ASS = $assembleia";
            $statement = Conexao::get()->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll();
            $pautas = array();
            foreach ($result as $row) {
                $pauta = new Pauta();
                $pauta->setId($row['PK_PAU']);
                $pauta->setNome($row['PAU_NOME']);
                $pauta->setDescricao($row['PAU_DESCRICAO']);
                $pauta->setFkPauAss($row['FK_PAU_ASS']);

                array_push($pautas, $pauta);
            }
            return $pautas;
        }

        public function findById($id) {
            $sql = "SELECT * FROM TB_PAUTAS WHERE PK_PAU = $id";
            $statement = Conexao::get()->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll();
            $pauta = new Pauta();
            foreach ($result as $row) {
                $pauta->setId($row['PK_PAU']);
                $pauta->setNome($row['PAU_NOME']);
                $pauta->setDescricao($row['PAU_DESCRICAO']);
                $pauta->setStatus($row['PAU_STATUS']);
                $pauta->setVoto($row['PAU_VOTOS']);
                $pauta->setFkPauAss($row['FK_PAU_ASS']);
            }
            return $pauta;
        }

        public function findByNome($nome) {
            $sql = "SELECT * FROM TB_PAUTAS WHERE PAU_NOME = '$nome'";
            $statement = Conexao::get()->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll();
            $pauta = new Pauta();
            foreach ($result as $row) {
                $pauta->setId($row['PK_PAU']);
                $pauta->setNome($row['PAU_NOME']);
                $pauta->setDescricao($row['PAU_DESCRICAO']);
                $pauta->setStatus($row['PAU_STATUS']);
                $pauta->setVoto($row['PAU_VOTOS']);
                $pauta->setFkPauAss($row['FK_PAU_ASS']);
            }
            return $pauta;
        }
        
        public function findPautaAssembleia($assembleiaId) {
            $sql = "SELECT * FROM TB_PAUTAS WHERE FK_PAU_ASS = '$assembleiaId'";
            $statement = Conexao::get()->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll();
            $pautas = array();
            foreach ($result as $row) {
                $pauta = new Pauta();
                $pauta->setId($row['PK_PAU']);
                $pauta->setNome($row['PAU_NOME']);
                $pauta->setDescricao($row['PAU_DESCRICAO']);
                $pauta->setFkPauAss($row['FK_PAU_ASS']);
                array_push($pautas, $pauta);
            }
            return $pautas;
        }

        public function save(Pauta $pauta) {
            if ($pauta->getId() == null) {
                $this->insert($pauta);
            } else {
                $this->update($pauta);
            }
        }

        private function insert(Pauta $pauta) {
            $sql = "INSERT INTO TB_PAUTAS (PAU_NOME, PAU_DESCRICAO, FK_PAU_ASS) VALUES ('{$pauta->getNome()}', '{$pauta->getDescricao()}', '{$pauta->getFkPauAss()}')";
            try {
                Conexao::get()->exec($sql);
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }

        private function update(Pauta $pauta) {
            $sql = "UPDATE TB_PAUTAS SET PAU_NOME ='{$pauta->getNome()}', PAU_DESCRICAO ='{$pauta->getDescricao()}' WHERE PK_PAU ='{$pauta->getId()}'";
            try {
                Conexao::get()->exec($sql);
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }

        public function remove($id) {
            $sql = "DELETE FROM TB_PAUTAS WHERE PK_PAU=$id";
            try {
                Conexao::get()->exec($sql);
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    }