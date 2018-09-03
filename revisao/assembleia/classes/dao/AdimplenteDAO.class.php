<?php

require_once (__DIR__ . "/./Conexao.class.php");
require_once (__DIR__ . "/../modelo/Adimplente.class.php");

    class AdimplenteDAO {

        private $conexao;

        function __construct() {
            $this->conexao = Conexao::get();
        }

        public function findAll() {
            $sql = "SELECT * FROM TB_ADIMPLENTES ORDER BY PK_ADI ASC";
            $statement = $this->conexao->prepare($sql);
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
            $sql = "SELECT * FROM TB_ADIMPLENTES WHERE PK_ADI = :ID";
            $statement = $this->conexao->prepare($sql);
            $statement->bindParam(':ID', $id); //Proteção contra sql injetct
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
            $sql = "SELECT * FROM TB_ADIMPLENTES WHERE ADI_NOME = :NOME";
            $statement = $this->conexao->prepare($sql);
            $statement->bindParam(':NOME', $nome); //Proteção contra sql injetct
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
            $sql = "INSERT INTO TB_ADIMPLENTES (ADI_NOME, ADI_IMAGEM) VALUES (:NOME, :IMAGEM)";             
            try {
                $statement = $this->conexao->prepare($sql);
                $nome = $adimplente->getNome();
                $imagem = $adimplente->getImagem();
                $statement->bindParam(':NOME', $nome);
                $statement->bindParam(':IMAGEM', $imagem);
                $statement->execute();
                return $this->findById($this->conexao->lastInsertId());
            } catch(PDOException $e) {
                echo $e->getMessage();
                return null;
            }
        }

        private function update(Adimplente $adimplente) {
            $sql = "UPDATE TB_ADIMPLENTES SET ADI_NOME=:NOME, ADI_IMAGEM=:IMAGEM WHERE PK_ADI=:ID";
            try {
                $statement = $this->conexao->prepare($sql);
                $nome = $adimplente->getNome();
                $imagem = $adimplente->getImagem();
                $id = $adimplente->getId();
                $statement->bindParam(':NOME', $nome);
                $statement->bindParam(':IMAGEM', $imagem);
                $statement->bindParam(':ID', $id);
                $statement->execute();
                return $this->findById($adimplente->getId());
            } catch(PDOException $e) {
                echo $e->getMessage();
                return null;
            }
        }

        public function remove($id) {
            $sql = "DELETE FROM TB_ADIMPLENTES WHERE PK_ADI = :ID";
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