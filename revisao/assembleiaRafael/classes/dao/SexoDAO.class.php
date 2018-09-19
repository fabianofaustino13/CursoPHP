<?php
    require_once (__DIR__ . "/./Conexao.class.php");
    require_once (__DIR__ . "/../modelo/Sexo.class.php");

    class SexoDAO {

        private $conexao;

        function __construct() {
            $this->conexao = Conexao::get();
        }

        public function findAll() {
            $sql = "SELECT * FROM TB_SEXOS";
            $statement = $this->conexao->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll();
            $sexos = array();
            foreach ($result as $row) {
                $sexo = new Sexo();
                $sexo->setId($row['PK_SEX']);
                $sexo->setNome($row['SEX_NOME']);
                $sexo->setSigla($row['SEX_SIGLA']);
                array_push($sexos, $sexo);
            }
            return $sexos;
        }

        public function findById($id) {
            $sql = "SELECT * FROM TB_SEXOS WHERE PK_SEX = :ID";
            $statement = $this->conexao->prepare($sql);
            $statement->bindParam(':ID', $id);
            $statement->execute();
            $result = $statement->fetchAll();
            $sexo = new Sexo();
            foreach ($result as $row) {
                $sexo->setId($row['PK_SEX']);
                $sexo->setNome($row['SEX_NOME']);
                $sexo->setSigla($row['SEX_SIGLA']);
                //array_push($sexos, $sexo);
            }
            return $sexo;
        }

        public function findByNome($nome) {
            $sql = "SELECT * FROM TB_SEXOS WHERE SEX_NOME = :NOME";
            $statement = $this->conexao->prepare($sql);
            $statement->bindParam(':NOME', $nome);
            $statement->execute();
            $result = $statement->fetchAll();
            $sexo = new Sexo();
            foreach ($result as $row) {
                $sexo->setId($row['PK_SEX']);
                $sexo->setNome($row['SEX_NOME']);
                $sexo->setSigla($row['SEX_SIGLA']);
                //array_push($sexos, $sexo);
            }
            return $sexo;
        }

        public function save(Sexo $sexo) {
            if ($sexo->getId() == null) {
                $this->insert($sexo);
            } else {
                $this->update($sexo);
            }
        }

        private function insert(Sexo $sexo) {
            $sql = "INSERT INTO TB_SEXOS (SEX_NOME, SEX_SIGLA) VALUES (:NOME, :SIGLA)";
            try {
                $statement = $this->conexao->prepare($sql);
                $nome = $sexo->getNome();
                $sigla = $sexo->getSigla();
                $statement->bindParam(':NOME', $nome);
                $statement->bindParam(':SIGLA', $sigla);
                $statement->execute();
                return $this->findById($this->conexao->lastInsertId());
            } catch(PDOException $e) {
                echo $e->getMessage();
                return null;
            }
        }

        private function update(Sexo $sexo) {
            $sql = "UPDATE TB_SEXOS SET SEX_NOME = :NOME, SEX_SIGLA = :SIGLA WHERE PK_SEX = :ID";
            try {
                $statement = $this->conexao->prepare($sql);
                $nome = $sexo->getNome();
                $sigla = $sexo->getSigla();
                $statement->bindParam(':NOME', $nome);
                $statement->bindParam(':SIGLA', $sigla);
                $statement->bindParam(':ID', $id);
                $statement->execute();                
                return $this->findById($this->conexao->lastInsertId());
            } catch(PDOException $e) {
                echo $e->getMessage();
                return null;
            }
        }

        public function remove($id) {
            $sql = "DELETE FROM TB_SEXOS WHERE PK_SEX = :ID";
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
?>