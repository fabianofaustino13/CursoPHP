<?php
    require_once (__DIR__ . "/./Conexao.class.php");
    require_once (__DIR__ . "/../modelo/Cidade.class.php");
    require_once (__DIR__ . "/../modelo/UnidadeFederativa.class.php");

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
                $uf = new UnidadeFederativa();
                $uf->setId($row['PK_EST']);
                $uf->setNome($row['EST_NOME']);
                $uf->setSigla($row['EST_SIGLA']);
                $cidade = new Cidade();
                $cidade->setId($row['PK_CID']);
                $cidade->setNome($row['CID_NOME']);
                $cidade->setUnidadeFederativa($uf);
                array_push($cidades, $cidade);
            }
            return $cidades;
        }

        public function findByUnidadeFederativa(UnidadeFederativa $uf) {
            $sql = "SELECT * FROM TB_CIDADES LEFT JOIN TB_ESTADOS ON PK_EST = FK_EST_CID WHERE PK_EST = :ID_EST";
            $statement = $this->conexao->prepare($sql);
            $id_uf = $uf->getId();
            $statement->bindParam(':ID_EST', $id_uf);
            $statement->execute();
            $rows = $statement->fetchAll();
            $cidades = array();
            foreach ($rows as $row) {
                $uf = new UnidadeFederativa();
                $uf->setId($row['PK_EST']);
                $uf->setNome($row['EST_NOME']);
                $uf->setSigla($row['EST_SIGLA']);
                $cidade = new Cidade();
                $cidade->setId($row['PK_CID']);
                $cidade->setNome($row['CID_NOME']);
                $cidade->setUnidadeFederativa($uf);
                array_push($cidades, $cidade);
            }
            return $cidades;
        }
        
        public function findById($id) {
            $sql = "SELECT * FROM TB_CIDADES LEFT JOIN TB_ESTADOS ON PK_EST = FK_EST_CID WHERE PK_EST = :ID_EST";
            $statement = $this->conexao->prepare($sql);
            $statement->bindParam(':ID_EST', $id);
            $statement->execute();
            $rows = $statement->fetchAll();
            $uf = new UnidadeFederativa();
            $uf->setId($row['PK_EST']);
            $uf->setNome($row['EST_NOME']);
            $uf->setSigla($row['EST_SIGLA']);
            $cidade = new Cidade();
            $cidade->setId($row['PK_CID']);
            $cidade->setNome($row['CID_NOME']);
            $cidade->setUnidadeFederativa($uf);
            
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