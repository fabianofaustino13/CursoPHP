<?php
    require_once (__DIR__ . "/./Conexao.class.php");
    require_once (__DIR__ . "/../modelo/Estado.class.php");

    class CidadeDAO {

        private $conexao;

        function __construct() {
            $this->conexao = Conexao::get();
        }
        
        public function findAll() {
            $sql = "SELECT * FROM TB_CIDADES LEFT JOIN TB_ESTADOS ON PK_EST = FK_EST_CID ORDER BY PK_CID ASC";
            $statement = $this->conexao->prepare($sql);
            $statement->execute();
            $rows = $statement->fetchAll();
            $cidades = array();
            foreach ($rows as $row) {
                $estado = new Estado();
                $estado->setId($row['PK_EST']);
                $estado->setNome($row['EST_NOME']);
                $estado->setSigla($row['EST_SIGLA']);
                $cidade = new Cidade();
                $cidade->setId($row['PK_CID']);
                $cidade->setNome($row['CID_NOME']);
                $cidade->setEstado($estado);
                array_push($cidades, $cidade);
            }
            return $cidades;
        }

        public function findById($id) {
            $sql = "SELECT * FROM TB_CIDADES LEFT JOIN TB_ESTADOS ON PK_EST = FK_EST_CID WHERE PK_CID = :ID";
            $statement = $this->conexao->prepare($sql);
            $statement->bindParam(':ID', $id); //Proteção contra sql injetct
            $statement->execute();
            $row = $statement->fetch();
            $estado = new Estado();
            $estado->setId($row['PK_EST']);
            $estado->setNome($row['EST_NOME']);
            $estado->setSigla($row['EST_SIGLA']);
            $cidade = new Cidade();
            $cidade->setId($row['PK_CID']);
            $cidade->setNome($row['CID_NOME']);
            $cidade->setEstado($estado);
            
            return $cidade;
        }

        public function findCidadeEstado($id) {
            $sql = "SELECT * FROM TB_CIDADES RIGHT JOIN TB_ESTADOS ON PK_EST = FK_EST_CID WHERE PK_EST = :ID";
            $statement = $this->conexao->prepare($sql);
            $statement->bindParam(':ID', $id); //Proteção contra sql injetct
            $statement->execute();
            $rows = $statement->fetchAll();
            $cidades = array();
            foreach ($rows as $row) {
                $estado = new Estado();
                $estado->setId($row['PK_EST']);
                $estado->setNome($row['EST_NOME']);
                $estado->setSigla($row['EST_SIGLA']);
                $cidade = new Cidade();
                $cidade->setId($row['PK_CID']);
                $cidade->setNome($row['CID_NOME']);
                $cidade->setEstado($estado);
                array_push($cidades, $cidade);
            }
            return $cidades;
        }

        public function findByNome($nome) {
            $sql = "SELECT * FROM TB_CIDADES LEFT JOIN TB_ESTADOS ON PK_EST=FK_EST_CID WHERE CID_NOME LIKE :NOME";
            $statement = $this->conexao->prepare($sql);
            $statement->bindParam(':NOME', $nome); //Proteção contra sql injetct
            $statement->execute();
            $rows = $statement->fetchAll();
            $cidade = new Cidade();
            $estado = new Estado();
            foreach ($rows as $row) {
                $cidade->setId($row['PK_CID']);
                $cidade->setNome($row['CID_NOME']);               
                $cidade->setEstado()->setId($row['PK_EST']);
                $cidade->setEstado()->setNome($row['EST_NOME']);
                $cidade->setEstado()->setSigla($row['EST_SIGLA']);
            }
            return $cidade;
        }

        public function save(Cidade $cidade) {
            if ($cidade->getId() == null) {
                $this->insert($cidade);
            } else {
                $this->update($cidade);
            }
        }

        private function insert(Cidade $cidade) {
            $sql = "INSERT INTO TB_CIDADES (CID_NOME, FK_EST_CID) VALUES (:NOME, :ESTADO)";
            try {
                $statement = $this->conexao->prepare($sql);
                $nome = $cidade->getNome();
                $estado = $cidade->getEstado()->getId();
                $statement->bindParam(':NOME', $nome);
                $statement->bindParam(':ESTADO', $estado);
                $statement->execute();
                return $this->findById($this->conexao->lastInsertId());
            } catch(PDOException $e) {
                echo $e->getMessage();
                return null;
            }
        }

        private function update(Cidade $cidade) {
            $sql = "UPDATE TB_CIDADES SET CID_NOME = :NOME, FK_EST_CID = :ESTADO WHERE PK_CID = :ID";
            try {
                $statement = $this->conexao->prepare($sql);
                $nome = $cidade->getNome();
                $estado = $cidade->getEstado()->getId();
                $id = $cidade->getId();
                $statement->bindParam(':NOME', $nome);
                $statement->bindParam(':ESTADO', $estado);
                $statement->bindParam(':ID', $id);
                $statement->execute();
                return $this->findById($cidade->getId());
                } catch(PDOException $e) {
                echo $e->getMessage();
                return null;
            }
        }

        public function remove($id) {
            $sql = "DELETE FROM TB_CIDADES WHERE PK_CID = :ID";
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