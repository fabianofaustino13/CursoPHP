<?php
    require_once (__DIR__ . "/./Conexao.class.php");
    // require_once (__DIR__ . "/../modelo/Sexo.class.php");

    class EstadoDAO {

        private $conexao;

        function __construct() {
            $this->conexao = Conexao::get();
        }

        public function findAll() {
            $sql = "SELECT * FROM TB_ESTADOS";
            $statement = $this->conexao->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll();
            $estados = array();
            foreach ($result as $row) {
                $estado = new Estado();
                $estado->setId($row['PK_EST']);
                $estado->setNome($row['EST_NOME']);
                $estado->setSigla($row['EST_SIGLA']);
                array_push($estados, $estado);
            }
            return $estados;
        }

        public function findById($id) {
            $sql = "SELECT * FROM TB_ESTADOS WHERE PK_EST = :ID";
            $statement = $this->conexao->prepare($sql);
            $statement->bindParam(':ID', $id); //Proteção contra sql injetct
            $statement->execute();
            $result = $statement->fetchAll();
            $estado = new Estado();
            foreach ($result as $row) {
                $estado->setId($row['PK_EST']);
                $estado->setNome($row['EST_NOME']);
                $estado->setSigla($row['EST_SIGLA']);
            }
            return $estado;
        }

        public function findByNome($nome) {
            $sql = "SELECT * FROM TB_ESTADOS WHERE EST_NOME LIKE :NOME";
            $statement = $this->conexao->prepare($sql);
            $statement->bindParam(':NOME', $nome); //Proteção contra sql injetct
            $statement->execute();
            $result = $statement->fetchAll();
            $estado = new Estado();
            foreach ($result as $row) {
                $estado->setId($row['PK_EST']);
                $estado->setNome($row['EST_NOME']);
                $estado->setSigla($row['EST_SIGLA']);
            }
            return $estado;
        }

        public function save(Estado $estado) {
            if ($estado->getId() == null) {
                $this->insert($estado);
            } else {
                $this->update($estado);
            }
        }

        private function insert(Estado $estado) {
            $sql = "INSERT INTO TB_ESTADOS (EST_NOME, EST_SIGLA) VALUES (:NOME, :SIGLA)";
            try {
                $statement = $this->conexao->prepare($sql);
                $nome = $estado->getNome();
                $sigla = $estado->getSigla();
                $statement->bindParam(':NOME', $nome);
                $statement->bindParam(':SIGLA', $sigla);
                $statement->execute();
                return $this->findById($this->conexao->lastInsertId());
            } catch(PDOException $e) {
                echo $e->getMessage();
                return null;
            }
        }

        private function update(Estado $estado) {
            $sql = "UPDATE TB_ESTADOS SET EST_NOME = :NOME, EST_SIGLA = :SIGLA WHERE PK_EST = :ID";
            try {
                $statement = $this->conexao->prepare($sql);
                $nome = $estado->getNome();
                $sigla = $estado->getSigla();
                $id = $estado->getId();
                $statement->bindParam(':NOME', $nome);
                $statement->bindParam(':SIGLA', $sigla);
                $statement->bindParam(':ID', $id);
                $statement->execute();
                return $this->findById($estado->getId());
            } catch(PDOException $e) {
                echo $e->getMessage();
                return null;
            }
        }

        public function remove($id) {
            $sql = "DELETE FROM TB_ESTADOS WHERE PK_EST = :ID";
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