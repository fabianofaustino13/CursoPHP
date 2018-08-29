<?php
    require_once (__DIR__ . "/./Conexao.class.php");
    require_once (__DIR__ . "/../modelo/Departamento.class.php");

    class DepartamentoDAO {

        private $conexao;

        function __construct() {
            $this->conexao = Conexao::get();
        }

        public function findAll() {
            $sql = "SELECT * FROM TB_DEPARTAMENTOS";
            $statement = $this->conexao->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll();
            $departamentos = array();
            foreach ($result as $row) {
                $departamento = new Departamento();
                $departamento->setId($row['PK_DEP']);
                $departamento->setNome($row['DEP_NOME']);
                array_push($departamentos, $departamento);
            }
            return $departamentos;
        }

        public function findById($id) {
            $sql = "SELECT * FROM TB_DEPARTAMENTOS WHERE PK_DEP = :ID";
            $statement = $this->conexao->prepare($sql);
            $statement->bindParam(':ID', $id); //Proteção contra sql injetct
            $statement->execute();
            $result = $statement->fetchAll();
            $departamento = new Departamento();
            foreach ($result as $row) {
                $departamento->setId($row['PK_DEP']);
                $departamento->setNome($row['DEP_NOME']);
            }
            return $departamento;
        }

        public function findByNome($nome) {
            $sql = "SELECT * FROM TB_DEPARTAMENTOS WHERE DEP_NOME = :NOME";
            $statement = $this->conexao->prepare($sql);
            $statement->bindParam(':NOME', $nome); //Proteção contra sql injetct
            $statement->execute();
            $result = $statement->fetchAll();
            $departamento = new Departamento();
            foreach ($result as $row) {
                $departamento->setId($row['PK_DEP']);
                $departamento->setNome($row['DEP_NOME']);
            }
            return $departamento;
        }

        public function save(Departamento $departamento) {
            if ($departamento->getId() == null) {
                $this->insert($departamento);
            } else {
                $this->update($departamento);
            }
        }

        private function insert(Departamento $departamento) {
            $sql = "INSERT INTO TB_DEPARTAMENTOS (DEP_NOME) VALUES (:NOME)";
            try {                
                $statement = $this->conexao->prepare($sql);
                $statement->bindParam(':NOME', $departamento->getNome());                
                $statement->execute();
                return $this->findById($this->conexao->lastInsertId());
            } catch(PDOException $e) {
                echo $e->getMessage();
                return null;
            }
        }

        private function update(Departamento $departamento) {
            $sql = "UPDATE TB_DEPARTAMENTOS SET DEP_NOME = :NOME WHERE PK_DEP = :ID";
            try {
                $statement = $this->conexao->prepare($sql);
                $statement->bindParam(':NOME', $departamento->getNome());                
                $statement->execute();
                return $this->findById($this->conexao->lastInsertId());
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }

        public function remove($id) {
            $sql = "DELETE FROM TB_DEPARTAMENTOS WHERE PK_DEP = :ID";
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