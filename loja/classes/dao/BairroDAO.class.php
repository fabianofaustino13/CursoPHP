<?php
    require_once (__DIR__ . "/./Conexao.class.php");
    require_once (__DIR__ . "/../modelo/Bairro.class.php");
    require_once (__DIR__ . "/../modelo/Cidade.class.php");

    class BairroDAO {

        private $conexao;

        function __construct() {
            $this->conexao = Conexao::get();
        }
        
        public function findAll() {
            $sql = "SELECT * FROM TB_BAIRROS LEFT JOIN TB_CIDADES ON PK_BAI = FK_BAI_CID ORDER BY PK_BAI ASC";
            $statement = $this->conexao->prepare($sql);
            $statement->execute();
            $rows = $statement->fetchAll();
            $bairros = array();
            foreach ($rows as $row) {
                $cidade = new Cidade();
                $cidade->setId($row['PK_CID']);
                $cidade->setNome($row['CID_NOME']);
                $bairro = new Bairro();
                $bairro->setId($row['PK_BAI']);
                $bairro->setNome($row['BAI_NOME']);
                $bairro->setCidade($cidade);
                array_push($bairros, $bairro);
            }
            return $bairros;
        }

        public function findById($id) {
            $sql = "SELECT * FROM TB_BAIRROS LEFT JOIN TB_CIDADES ON PK_CID = FK_BAI_CID WHERE PK_BAI = :ID";
            $statement = $this->conexao->prepare($sql);
            $statement->bindParam(':ID', $id); //Proteção contra sql injetct
            $statement->execute();
            $row = $statement->fetch();
            $cidade = new Cidade();
            $cidade->setId($row['PK_CID']);
            $cidade->setNome($row['CID_NOME']);
            $bairro = new Bairro();
            $bairro->setId($row['PK_BAI']);
            $bairro->setNome($row['BAI_NOME']);
            $bairro->setCidade($cidade);
            
            return $bairro;
        }

        public function findByNome($nome) {
            $sql = "SELECT * FROM TB_BAIRROS LEFT JOIN TB_CIDADES ON PK_CID = FK_BAI_CID WHERE BAI_NOME LIKE :NOME";
            $statement = $this->conexao->prepare($sql);
            $statement->bindParam(':NOME', $nome); //Proteção contra sql injetct
            $statement->execute();
            $rows = $statement->fetchAll();
            $bairro = new Bairro();
            $cidade = new Cidade();
            foreach ($rows as $row) {
                $cidade->setId($row['PK_CID']);
                $cidade->setNome($row['CID_NOME']);
                $bairro->setId($row['PK_BAI']);
                $bairro->setNome($row['BAI_NOME']);
                $bairro->setCidade($cidade);
            }
            return $bairro;
        }

        public function save(Bairro $bairro) {
            if ($bairro->getId() == null) {
                $this->insert($bairro);
            } else {
                $this->update($bairro);
            }
        }

        private function insert(Bairro $bairro) {
            $sql = "INSERT INTO TB_BAIRROS (BAI_NOME, FK_BAI_CID) VALUES (:NOME, :CIDADE)";
            try {
                $statement = $this->conexao->prepare($sql);
                $nome = $bairro->getNome();
                $cidade = $bairro->getCidade()->getId();
                $statement->bindParam(':NOME', $nome);
                $statement->bindParam(':CIDADE', $cidade);
                $statement->execute();
                return $this->findById($this->conexao->lastInsertId());
            } catch(PDOException $e) {
                echo $e->getMessage();
                return null;
            }
        }

        private function update(Bairro $bairro) {
            $sql = "UPDATE TB_BAIRROS SET BAI_NOME = :NOME, FK_BAI_CID = :CIDADE WHERE PK_BAI = :ID";
            try {
                $statement = $this->conexao->prepare($sql);
                $nome = $bairro->getNome();
                $cidade = $bairro->getCidade()->getId();
                $id = $bairro->getId();
                $statement->bindParam(':NOME', $nome);
                $statement->bindParam(':CIDADE', $cidade);
                $statement->bindParam(':ID', $id);
                $statement->execute();
                return $this->findById($bairro->getId());
                } catch(PDOException $e) {
                echo $e->getMessage();
                return null;
            }
        }

        public function remove($id) {
            $sql = "DELETE FROM TB_BAIRROS WHERE PK_BAI = :ID";
            try {
                $statement = $this->conexao->prepare($sql);
                $statement->bindParam(':ID', $id); //Proteção contra sql injetct
                $statement->execute();
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    }
?>