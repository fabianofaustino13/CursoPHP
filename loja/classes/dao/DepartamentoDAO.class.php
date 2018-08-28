<?php
    require_once (__DIR__ . "/./Conexao.class.php");
    require_once (__DIR__ . "/../modelo/Departamento.class.php");

    class DepartamentoDAO {

        public function findAll() {
            $sql = "SELECT * FROM TB_DEPARTAMENTOS";
            $statement = Conexao::get()->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll();
            $departamentos = array();
            foreach ($result as $row) {
                $departamento = new Departamento();
                $departamento->setId($row['PK_MAR']);
                $departamento->setNome($row['MAR_NOME']);
                array_push($departamentos, $departamento);
            }
            return $departamentos;
        }

        public function findById($id) {
            $sql = "SELECT * FROM TB_DEPARTAMENTOS WHERE PK_MAR = :ID";
            $statement = Conexao::get()->prepare($sql);
            $statement->bindParam(':ID', $id); //Proteção contra sql injetct
            $statement->execute();
            $result = $statement->fetchAll();
            $departamento = new Departamento();
            foreach ($result as $row) {
                $departamento->setId($row['PK_MAR']);
                $departamento->setNome($row['MAR_NOME']);
            }
            return $departamento;
        }

        public function findByNome($nome) {
            $sql = "SELECT * FROM TB_DEPARTAMENTOS WHERE MAR_NOME = ':NOME'";
            $statement = Conexao::get()->prepare($sql);
            $statement->bindParam(':NOME', $nome); //Proteção contra sql injetct
            $statement->execute();
            $result = $statement->fetchAll();
            $departamento = new Departamento();
            foreach ($result as $row) {
                $departamento->setId($row['PK_MAR']);
                $departamento->setNome($row['MAR_NOME']);
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
            $sql = "INSERT INTO TB_DEPARTAMENTOS (MAR_NOME) VALUES (':NOME')";
            try {                
                $statement = Conexao::get()->prepare($sql);
                $statement->bindParam(':NOME', $departamento->getNome());                
                $statement->execute();
                $id = Conexao::get()->lastInsertId();
                return $this->findById($id);
            } catch(PDOException $e) {
                echo $e->getMessage();
                return null;
            }
        }

        private function update(Departamento $departamento) {
            $sql = "UPDATE TB_DEPARTAMENTOS SET MAR_NOME = :NOME WHERE PK_MAR = :ID";
            try {
                $statement = Conexao::get()->prepare($sql);
                $statement->bindParam(':NOME', $departamento->getNome());                
                $statement->execute();
                $id = Conexao::get()->lastInsertId();
                return $this->findById($id);
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }

        public function remove($id) {
            $sql = "DELETE FROM TB_DEPARTAMENTOS WHERE PK_MAR = :ID";
            try {
                $statement = Conexao::get()->prepare($sql);
                $statement->bindParam(':ID', $id); //Proteção contra sql injetct
                $statement->execute();
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    }
?>