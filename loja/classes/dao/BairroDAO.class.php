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
            $sql = "SELECT * FROM TB_BAIRROS JOIN TB_CIDADES ON PK_CID = FK_BAI_CID ORDER BY PK_BAI ASC";
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
        
        public function findByCidade(Cidade $cidade) {
            $sql = "SELECT * FROM TB_BAIRROS JOIN TB_CIDADES ON PK_CID = FK_BAI_CID WHERE PK_CID = :ID_CID";
            $statement = $this->conexao->prepare($sql);
            $id_cidade = $cidade->getId();
            $statement->bindParam(':ID_CID', $id_cidade);
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
            $sql = "SELECT * FROM TB_BAIRROS LEFT JOIN TB_CIDADES ON PK_CID = FK_BAI_CID WHERE PK_CID = :ID";
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

       
    }
?>