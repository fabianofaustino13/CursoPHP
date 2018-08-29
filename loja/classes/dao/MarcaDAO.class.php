<?php
    require_once (__DIR__ . "/./Conexao.class.php");
    require_once (__DIR__ . "/../modelo/Marca.class.php");

    class MarcaDAO {

        private $conexao;

        function __construct() {
            $this->conexao = Conexao::get();
        }

        public function findAll() {
            $sql = "SELECT * FROM TB_MARCAS";
            $statement = $this->conexao->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll();
            $marcas = array();
            foreach ($result as $row) {
                $marca = new Marca();
                $marca->setId($row['PK_MAR']);
                $marca->setNome($row['MAR_NOME']);
                array_push($marcas, $marca);
            }
            return $marcas;
        }

        public function findById($id) {
            $sql = "SELECT * FROM TB_MARCAS WHERE PK_MAR = :ID";
            $statement = $this->conexao->prepare($sql);
            $statement->bindParam(':ID', $id); //Proteção contra sql injetct
            $statement->execute();
            $rows = $statement->fetchAll();
            $marca = new Marca();
            foreach ($rows as $row) {
                $marca->setId($row['PK_MAR']);
                $marca->setNome($row['MAR_NOME']);
            }
            return $marca;
        }

        public function findByNome($nome) {
            $sql = "SELECT * FROM TB_MARCAS WHERE MAR_NOME LIKE :NOME";
            $statement = $this->conexao->prepare($sql);
            $statement->bindParam(':NOME', $nome); //Proteção contra sql injetct
            $rows->execute();
            $result = $statement->fetchAll();
            $marca = new Marca();
            foreach ($rows as $row) {
                $marca->setId($row['PK_MAR']);
                $marca->setNome($row['MAR_NOME']);
            }
            return $marca;
        }

        public function save(Marca $marca) {
            if (is_null($marca->getId())) {
                return $this->insert($marca);
            } else {
                return $this->update($marca);
            }
        }

        private function insert(Marca $marca) {
            $sql = "INSERT INTO TB_MARCAS (MAR_NOME) VALUES (:NOME)";
            try {                
                $statement = $this->conexao->prepare($sql);
                $nome = $marca->getNome();
                $statement->bindParam(':NOME', $nome);
                $statement->execute();
                return $this->findById($this->conexao->lastInsertId());
            } catch(PDOException $e) {
                echo $e->getMessage();
                return null;
            }
        }

        private function update(Marca $marca) {
            $sql = "UPDATE TB_MARCAS SET MAR_NOME = :NOME WHERE PK_MAR = :ID";
            try {
                $statement = $this->conexao->prepare($sql);
                $nome = $marca->getNome();
                $id = $marca->getId();
                $statement->bindParam(':NOME', $nome);
                $statement->bindParam(':ID', $id);
                $statement->execute();
                return $this->findById($id);
            } catch(PDOException $e) {
                echo $e->getMessage();
                return null;
            }
        }

        public function remove($id) {
            $sql = "DELETE FROM TB_MARCAS WHERE PK_MAR = :ID";
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