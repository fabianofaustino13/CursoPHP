<?php

require_once (__DIR__ . "/./Conexao.class.php");
require_once (__DIR__ . "/../modelo/Bloco.class.php");
require_once (__DIR__ . "/../modelo/Adimplente.class.php");

    class ApartamentoDAO {

        private $conexao;

        function __construct() {
            $this->conexao = Conexao::get();
        }

        public function findAll() {
            $sql = "SELECT * FROM TB_APARTAMENTOS LEFT JOIN TB_BLOCOS ON PK_BLO = FK_APA_BLO JOIN TB_ADIMPLENTES ON PK_ADI = FK_APA_ADI ORDER BY BLO_NOME ASC";
            $statement = $this->conexao->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll();
            $apartamentos = array();
            foreach ($result as $row) {
                $adimplente = new Adimplente();
                $adimplente->setId($row['PK_ADI']);
                $adimplente->setNome($row['ADI_NOME']);
                $bloco = new Bloco();
                $bloco->setId($row['PK_BLO']);
                $bloco->setNome($row['BLO_NOME']);
                $bloco->setApelido($row['BLO_APELIDO']);
                $apartamento = new Apartamento();
                $apartamento->setId($row['PK_APA']);
                $apartamento->setNome($row['APA_NOME']);
                $apartamento->setBloco($bloco);
                $apartamento->setAdimplente($adimplente);

                array_push($apartamentos, $apartamento);
            }
            return $apartamentos;
        }

        public function findById($id) {
            $sql = "SELECT * FROM TB_APARTAMENTOS LEFT JOIN TB_BLOCOS ON PK_BLO = FK_APA_BLO LEFT JOIN TB_ADIMPLENTES ON PK_ADI = FK_APA_ADI WHERE PK_APA = :ID";
            $statement = $this->conexao->prepare($sql);
            $statement->bindParam(':ID', $id); //Proteção contra sql injetct
            $statement->execute();
            $result = $statement->fetchAll();
            $adimplente = new Adimplente();
            $bloco = new Bloco();
            $apartamento = new Apartamento();
            foreach ($result as $row) {
                $adimplente->setId($row['PK_ADI']);
                $adimplente->setNome($row['ADI_NOME']);
                $bloco->setId($row['PK_BLO']);
                $bloco->setNome($row['BLO_NOME']);
                $bloco->setApelido($row['BLO_APELIDO']);
                $apartamento->setId($row['PK_APA']);
                $apartamento->setNome($row['APA_NOME']);
                $apartamento->setBloco($bloco);
                $apartamento->setAdimplente($adimplente);

            }
            return $adimplente;
        }

        public function findByNome($nome) {
            $sql = "SELECT * FROM TB_APARTAMENTOS LEFT JOIN TB_BLOCOS ON PK_BLO = FK_APA_BLO LEFT JOIN TB_ADIMPLENTES ON PK_ADI = FK_APA_ADI WHERE APA_NOME = :NOME";
            $statement = $this->conexao->prepare($sql);
            $statement->bindParam(':NOME', $nome); //Proteção contra sql injetct
            $statement->execute();
            $result = $statement->fetchAll();
            $adimplente = new Adimplente();
            $bloco = new Bloco();
            $apartamento = new Apartamento();
            foreach ($result as $row) {
                $adimplente->setId($row['PK_ADI']);
                $adimplente->setNome($row['ADI_NOME']);
                $bloco->setId($row['PK_BLO']);
                $bloco->setNome($row['BLO_NOME']);
                $bloco->setApelido($row['BLO_APELIDO']);
                $apartamento->setId($row['PK_APA']);
                $apartamento->setNome($row['APA_NOME']);
                $apartamento->setBloco($bloco);
                $apartamento->setAdimplente($adimplente);

            }
            return $adimplente;
        }

        public function save(Apartamento $apartamento) {
            if ($apartamento->getId() == null) {
                $this->insert($apartamento);
            } else {
                $this->update($apartamento);
            }
        }

        private function insert(Apartamento $apartamento) {
            $sql = "INSERT INTO TB_APARTAMENTOS (APA_NOME, FK_APA_BLO, FK_APA_ADI) VALUES (:NOME, :BLOCO, :ADIMPLENTE)";             
            try {
                $statement = $this->conexao->prepare($sql);
                $nome = $apartamento->getNome();
                $bloco = $apartamento->getBloco()->getId();
                $adimplente = $apartamento->getAdimplente()->getId();
                $statement->bindParam(':NOME', $nome);
                $statement->bindParam(':BLOCO', $bloco);
                $statement->bindParam(':ADIMPLENTE', $adimplente);
                $statement->execute();
                return $this->findById($this->conexao->lastInsertId());
            } catch(PDOException $e) {
                echo $e->getMessage();
                return null;
            }
        }

        private function update(Apartamento $apartamento) {
            $sql = "UPDATE TB_APARTAMENTOS SET APA_NOME=:NOME, FK_APA_BLO=:BLOCO, FK_APA_ADI=:ADIMPLENTE WHERE PK_APA = :ID";
            try {
                $statement = $this->conexao->prepare($sql);
                $nome = $apartamento->getNome();
                $bloco = $apartamento->getBloco()->getId();
                $adimplente = $apartamento->getAdimplente()->getId();
                $id = $apartamento->getId();
                $statement->bindParam(':NOME', $nome);
                $statement->bindParam(':BLOCO', $bloco);
                $statement->bindParam(':ADIMPLENTE', $adimplente);
                $statement->bindParam(':ID', $id);
                $statement->execute();
                return $this->findById($this->conexao->lastInsertId());
            } catch(PDOException $e) {
                echo $e->getMessage();
                return null;
            }
        }

        public function remove($id) {
            $sql = "DELETE FROM TB_APARTAMENTOS WHERE PK_APA = :ID";
            try {
                $statement = $this->conexao->prepare($sql);
                $statement->bindParam(':ID', $id);
                $statement->execute();
            } catch(PDOException $e) {
                echo $e->getMessage();
                return null;
            }
        }
    }