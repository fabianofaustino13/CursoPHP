<?php

require_once (__DIR__ . "/./Conexao.class.php");
require_once (__DIR__ . "/../modelo/Adimplente.class.php");

    class AdimplenteDAO {

        public function findAll() {
            $sql = "SELECT * FROM TB_ADIMPLENTES ORDER BY PK_ADI ASC";
            $statement = Conexao::get()->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll();
            $adimplentes = array();
            foreach ($result as $row) {
                $adimplente = new Adimplente();
                $adimplente->setId($row['PK_ADI']);
                $adimplente->setNome($row['ADI_NOME']);
                $adimplente->setImagem($row['ADI_IMAGEM']);
                
                array_push($adimplentes, $adimplente);
            }
            return $adimplentes;
        }

        public function findById($id) {
            $sql = "SELECT * FROM TB_ADIMPLENTES WHERE PK_ADI = $id";
            $statement = Conexao::get()->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll();
            $adimplente = new Adimplente();
            foreach ($result as $row) {
                $adimplente->setId($row['PK_ADI']);
                $adimplente->setNome($row['ADI_NOME']);
                $adimplente->setImagem($row['ADI_IMAGEM']);
            }
            return $adimplente;
        }

        public function findByNome($nome) {
            $sql = "SELECT * FROM TB_ADIMPLENTES WHERE ADI_NOME = '$nome'";
            $statement = Conexao::get()->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll();
            $adimplente = new Adimplente();
            foreach ($result as $row) {
                $adimplente->setId($row['PK_ADI']);
                $adimplente->setNome($row['ADI_NOME']);
                $adimplente->setImagem($row['ADI_IMAGEM']);
            }
            return $adimplente;
        }

        public function save(Adimplente $adimplente) {
            if ($adimplente->getId() == null) {
                $this->insert($adimplente);
            } else {
                $this->update($adimplente);
            }
        }

        private function insert(Adimplente $adimplente) {
            $sql = "INSERT INTO TB_ADIMPLENTES (ADI_NOME, ADI_IMAGEM) VALUES ('{$adimplente->getNome()}', '{$adimplente->getImagem()}')";
            try {
                Conexao::get()->exec($sql);
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }

        private function update(Adimplente $adimplente) {
            $sql = "UPDATE TB_ADIMPLENTES SET ADI_NOME ='{$adimplente->getNome()}', ADI_IMAGEM ='{$adimplente->getImagem()}' WHERE PK_ADI ='{$adimplente->getId()}'";
            try {
                Conexao::get()->exec($sql);
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }

        public function remove($id) {
            $sql = "DELETE FROM TB_ADIMPLENTES WHERE PK_ADI=$id";
            try {
                Conexao::get()->exec($sql);
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    }