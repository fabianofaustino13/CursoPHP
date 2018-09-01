<?php
    require_once (__DIR__ . "/./Conexao.class.php");
    require_once (__DIR__ . "/../modelo/Bairro.class.php");

    class CepDAO {

        private $conexao;

        function __construct() {
            $this->conexao = Conexao::get();
        }
        
        public function findAll() {
            $sql = "SELECT * FROM TB_CEPS LEFT JOIN TB_BAIRROS ON PK_BAI = FK_BAI_CEP ORDER BY PK_CEP ASC";
            $statement = $this->conexao->prepare($sql);
            $statement->execute();
            $rows = $statement->fetchAll();
            $ceps = array();
            foreach ($rows as $row) {
                $bairro = new Bairro();
                $bairro->setId($row['PK_BAI']);
                $bairro->setNome($row['BAI_NOME']);
                $cep = new Cep();
                $cep->setId($row['PK_CEP']);
                $cep->setLogradouro($row['CEP_LOGRADOURO']);
                $cep->setBairro($bairro);
                array_push($ceps, $cep);
            }
            return $ceps;
        }

        public function findById($id) {
            $sql = "SELECT * FROM TB_CEPS LEFT JOIN TB_BAIRROS ON PK_BAI = FK_BAI_CEP WHERE PK_CEP = :ID";
            $statement = $this->conexao->prepare($sql);
            $statement->bindParam(':ID', $id); //Proteção contra sql injetct
            $statement->execute();
            $row = $statement->fetch();
            $bairro = new Bairro();
            $bairro->setId($row['PK_BAI']);
            $bairro->setNome($row['BAI_NOME']);
            $cep = new Cep();
            $cep->setId($row['PK_CEP']);
            $cep->setLogradouro($row['CEP_LOGRADOURO']);
            $cep->setBairro($bairro);
            
            return $cep;
        }

        public function findByNome($nome) {
            $sql = "SELECT * FROM TB_CEPS LEFT JOIN TB_CIDADES ON PK_CID = FK_BAI_CID WHERE BAI_NOME LIKE :NOME";
            $statement = $this->conexao->prepare($sql);
            $statement->bindParam(':NOME', $nome); //Proteção contra sql injetct
            $statement->execute();
            $rows = $statement->fetchAll();
            $bairro = new Bairro();
            $cep = new Cep();
            foreach ($rows as $row) {
                $bairro->setId($row['PK_BAI']);
                $bairro->setNome($row['BAI_NOME']);
                $cep->setId($row['PK_CEP']);
                $cep->setLogradouro($row['CEP_LOGRADOURO']);
                $cep->setBairro($bairro);
            }
            return $cep;
        }

        public function save(Cep $cep) {
            if ($cep->getId() == null) {
                $this->insert($cep);
            } else {
                $this->update($cep);
            }
        }

        private function insert(Cep $cep) {
            $sql = "INSERT INTO TB_CEPS (PK_CEP, CEP_LOGRADOURO, FK_BAI_CEP) VALUES (:CEP :LOGRADOURO, :BAIRRO)";
            try {
                $statement = $this->conexao->prepare($sql);
                $cepId = $cep->getLogradouro();
                $logradouro = $cep->getLogradouro();
                $bairro = $cep->getBairro()->getId();
                $statement->bindParam(':CEP', $cepId);
                $statement->bindParam(':LOGRADOURO', $logradouro);
                $statement->bindParam(':BAIRRO', $bairro);
                $statement->execute();
                return $this->findById($this->conexao->lastInsertId());
            } catch(PDOException $e) {
                echo $e->getMessage();
                return null;
            }
        }

        private function update(Cep $cep) {
            $sql = "UPDATE TB_CEPS SET BAI_NOME = :NOME, FK_BAI_CID = :CIDADE WHERE PK_CEP = :ID";
            try {
                $statement = $this->conexao->prepare($sql);
                $logradouro = $cep->getLogradouro();
                $bairro = $cep->getBairro()->getId();
                $id = $cep->getId();                
                $statement->bindParam(':LOGRADOURO', $logradouro);
                $statement->bindParam(':BAIRRO', $bairro);
                $statement->bindParam(':ID', $id);
                $statement->execute();
                return $this->findById($bairro->getId());
                } catch(PDOException $e) {
                echo $e->getMessage();
                return null;
            }
        }

        public function remove($id) {
            $sql = "DELETE FROM TB_CEPS WHERE PK_CEP = :ID";
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