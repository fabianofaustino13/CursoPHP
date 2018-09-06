<?php

require_once (__DIR__ . "/./Conexao.class.php");
require_once (__DIR__ . "/../modelo/Bloco.class.php");
require_once (__DIR__ . "/../modelo/Adimplente.class.php");
require_once (__DIR__ . "/../modelo/Morador.class.php");

    class ApartamentoDAO {

        private $conexao;

        function __construct() {
            $this->conexao = Conexao::get();
        }

        public function findAll() {
            $sql = "SELECT * FROM TB_APARTAMENTOS LEFT JOIN TB_BLOCOS ON PK_BLO = FK_APA_BLO JOIN TB_ADIMPLENTES ON PK_ADI = FK_APA_ADI LEFT JOIN TB_APARTAMENTOS_MORADORES ON FK_ADM_APA = PK_APA LEFT JOIN TB_MORADORES ON PK_MOR = FK_ADM_MOR ORDER BY APA_NOME ASC";
            $statement = $this->conexao->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll();
            $apartamentos = array();
            foreach ($result as $row) {
                $morador = new Morador();
                $morador->getId($row['PK_MOR']);
                $morador->getNome($row['MOR_NOME']);
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
                $apartamento->setMorador($morador);

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
            return $apartamento;
        }

        public function findByMorador() {
            $sql = "SELECT * FROM TB_APARTAMENTOS LEFT JOIN TB_APARTAMENTOS_MORADORES ON FK_ADM_APA = PK_APA LEFT JOIN TB_MORADORES ON PK_MOR = FK_ADM_MOR JOIN TB_BLOCOS ON PK_BLO = FK_APA_BLO WHERE PK_MOR = FK_ADM_MOR AND PK_APA = FK_ADM_APA";
            $statement = $this->conexao->prepare($sql);
            // $id_morador = $morador->getId();
            // $statement->bindParam(':ID_MOR', $id_morador); //Proteção contra sql injetct
            $statement->execute();
            $result = $statement->fetchAll();
            $apartamentos = array();
            foreach ($result as $row) {
                $morador = new Morador();
                $morador->setId($row['PK_MOR']);
                $morador->setNome($row['MOR_NOME']);
                $morador->setLogin($row['MOR_LOGIN']);
                $morador->setSenha($row['MOR_SENHA']);
                // $morador->setSindico($row['FK_MOR_SIN']);
                $bloco = new Bloco();
                $bloco->setId($row['PK_BLO']);
                $bloco->setNome($row['BLO_NOME']);
                $bloco->setApelido($row['BLO_APELIDO']);
                $apartamento = new Apartamento();
                $apartamento->setId($row['PK_APA']);
                $apartamento->setNome($row['APA_NOME']);
                $apartamento->setBloco($bloco);
                $apartamento->setMorador($morador);
                array_push($apartamentos, $apartamento);
            }
            return $apartamentos;
        }

        public function findApartamentoBloco(Bloco $bloco) {
            $sql = "SELECT * FROM TB_APARTAMENTOS LEFT JOIN TB_BLOCOS ON PK_BLO = FK_APA_BLO WHERE PK_BLO = :ID_BLOCO";
            $statement = $this->conexao->prepare($sql);
            $id_bloco = $bloco->getId();
            $statement->bindParam(':ID_BLOCO', $id_bloco); //Proteção contra sql injetct
            $statement->execute();
            $result = $statement->fetchAll();
            $apartamentos = array();
            foreach ($result as $row) {
                $bloco = new Bloco();
                $bloco->setId($row['PK_BLO']);
                $bloco->setNome($row['BLO_NOME']);
                $apartamento = new Apartamento();
                $apartamento->setId($row['PK_APA']);
                $apartamento->setNome($row['APA_NOME']);
                $apartamento->setBloco($bloco);
                array_push($apartamentos, $apartamento);
            }
            return $apartamentos;
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

        private function updateApaMor(Apartamento $apartamento) {
            $sql = "UPDATE TB_APARTAMENTOS LETFT JOIN TB_APARTAMENTOS_MORADORES ON FK_ADM_APA = PK_APA JOIN TB_MORADORES ON PK_MOR = FK_ADI_MOR SET APA_NOME=:NOME, FK_APA_BLO=:BLOCO, FK_APA_ADI=:ADIMPLENTE, FK_ADI_MOR=:ID_MORADOR, FK_ADI_APA=:ID_APA WHERE PK_APA = :ID";
            $login_morador = $apartamento->getMorador()->getLogin();
            $sqlMorador = "SELECT PK_MOR FROM TB_MORADORES WHERE MOR_LOGIN='$login_morador'";
            $nome_apa = $apartamento->getNome();
            $apelido_bloco = $apartamento->getBloco()->getApelido();
            $sqlApartamento = "SELECT PK_APA FROM TB_APARTAMENTOS JOIN TB_BLOCOS ON PK_BLO=FK_APA_BLO WHERE APA_NOME='$nome_apa' AND BLO_APELIDO='$apelido_bloco'";
            $resultado = "SELECT COUNT(*) FROM TB_APARTAMENTOS_MORADORES WHERE FK_ADM_APA='$sqlApartamento' and FK_ADM_MOR='$sqlMorador'";

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