<?php

require_once (__DIR__ . "/./Conexao.class.php");
require_once (__DIR__ . "/../modelo/Morador.class.php");

    class MoradorDAO {

        public function findAll() {
            $sql = "SELECT * FROM TB_MORADORES ORDER BY PK_MOR ASC";
            $statement = Conexao::get()->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll();
            $moradores = array();
            foreach ($result as $row) {
                $morador = new Morador();
                $morador->setId($row['PK_MOR']);
                $morador->setNome($row['MOR_NOME']);
                $morador->setLogin($row['MOR_LOGIN']);
                $morador->setSenha($row['MOR_SENHA']);
                $morador->setUltimoAcesso($row['MOR_ULTIMO_ACESSO']);
                $morador->setFoto($row['MOR_FOTO']);
                $morador->setFkMorSin($row['FK_MOR_SIN']);
              
                array_push($moradores, $morador);
            }
            return $moradores;
        }

        public function findById($id) {
            $sql = "SELECT * FROM TB_MORADORES WHERE PK_MOR = $id";
            $statement = Conexao::get()->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll();
            $morador = new Morador();
            foreach ($result as $row) {
                $morador->setId($row['PK_MOR']);
                $morador->setNome($row['MOR_NOME']);
                $morador->setLogin($row['MOR_LOGIN']);
                $morador->setSenha($row['MOR_SENHA']);
                $morador->setUltimoAcesso($row['MOR_ULTIMO_ACESSO']);
                $morador->setFoto($row['MOR_FOTO']);
                $morador->setFkMorSin($row['FK_MOR_SIN']);
            }
            return $morador;
        }

        public function findByNome($nome) {
            $sql = "SELECT * FROM TB_MORADORES WHERE MOR_NOME = '$nome'";
            $statement = Conexao::get()->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll();
            $morador = new Morador();
            foreach ($result as $row) {
                $morador->setId($row['PK_MOR']);
                $morador->setNome($row['MOR_NOME']);
                $morador->setLogin($row['MOR_LOGIN']);
                $morador->setSenha($row['MOR_SENHA']);
                $morador->setUltimoAcesso($row['MOR_ULTIMO_ACESSO']);
                $morador->setFoto($row['MOR_FOTO']);
                $morador->setFkMorSin($row['FK_MOR_SIN']);
            }
            return $morador;
        }
        
        public function findSindico() {
            $sql = "SELECT * FROM TB_MORADORES ORDER BY PK_MOR ASC LIMIT 1";
            $statement = Conexao::get()->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll();
            $sindicos = array();
            foreach ($result as $row) {
                $morador = new Morador();
                $morador->setId($row['PK_MOR']);
                $morador->setNome($row['MOR_NOME']);
                $morador->setLogin($row['MOR_LOGIN']);
                $morador->setSenha($row['MOR_SENHA']);
                $morador->setUltimoAcesso($row['MOR_ULTIMO_ACESSO']);
                $morador->setFoto($row['MOR_FOTO']);
                $morador->setFkMorSin($row['FK_MOR_SIN']);
              
                array_push($sindicos, $morador);
            }
            return $sindicos;
        }

        public function save(Morador $morador) {
            if ($morador->getId() == null) {
                $this->insert($morador);
            } else {
                $this->update($morador);
            }
        }

        private function insert(Morador $morador) {
            $sql = "INSERT INTO TB_MORADORES (MOR_NOME, MOR_LOGIN, MOR_SENHA, MOR_ULTIMO_ACESSO, MOR_FOTO, FK_MOR_SIN) VALUES ('{$morador->getNome()}', '{$morador->getLogin()}', '{$morador->getSenha()}', '{$morador->getUltimoAcesso()}', '{$morador->getFoto()}', '{$morador->getFkMorSin()}')";
            try {
                Conexao::get()->exec($sql);
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }

        private function update(Morador $morador) {
            $sql = "UPDATE TB_MORADORES SET MOR_NOME ='{$morador->getNome()}', MOR_LOGIN ='{$morador->getLogin()}', MOR_SENHA ='{$morador->getSenha()}', MOR_ULTIMO_ACESSO ='{$morador->getUltimoAcesso()}', MOR_FOTO ='{$morador->getFoto()}', FK_MOR_SIN ='{$morador->getFkMorSin()}' WHERE PK_MOR ='{$morador->getId()}'";
            try {
                Conexao::get()->exec($sql);
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }

        public function remove($id) {
            $sql = "DELETE FROM TB_MORADORES WHERE PK_MOR=$id";
            try {
                Conexao::get()->exec($sql);
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    }