<?php
    require_once (__DIR__ . "/./Conexao.class.php");
    require_once (__DIR__ . "/../modelo/UnidadeFederativa.class.php");

    class UnidadeFederativaDAO {

        private $conexao;

        function __construct() {
            $this->conexao = Conexao::get();
        }

        public function findAll() {
            $sql = "SELECT * FROM TB_ESTADOS";
            $statement = $this->conexao->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll();
            $ufs = array();
            foreach ($result as $row) {
                $uf = new UnidadeFederativa();
                $uf->setId($row['PK_EST']);
                $uf->setNome($row['EST_NOME']);
                $uf->setSigla($row['EST_SIGLA']);
                array_push($ufs, $uf);
            }
            return $ufs;
        }

        public function findById($id) {
            $sql = "SELECT * FROM TB_ESTADOS WHERE PK_EST = :ID";
            $statement = $this->conexao->prepare($sql);
            $statement->bindParam(':ID', $id); //Proteção contra sql injetct
            $statement->execute();
            $result = $statement->fetchAll();
            $uf = new UnidadeFederativa();
            foreach ($result as $row) {
                $uf->setId($row['PK_EST']);
                $uf->setNome($row['EST_NOME']);
                $uf->setSigla($row['EST_SIGLA']);
            }
            return $uf;
        }

        public function findByNome($nome) {
            $sql = "SELECT * FROM TB_ESTADOS WHERE EST_NOME LIKE :NOME";
            $statement = $this->conexao->prepare($sql);
            $statement->bindParam(':NOME', $nome); //Proteção contra sql injetct
            $statement->execute();
            $result = $statement->fetchAll();
            $uf = new UnidadeFederativa();
            foreach ($result as $row) {
                $uf->setId($row['PK_EST']);
                $uf->setNome($row['EST_NOME']);
                $uf->setSigla($row['EST_SIGLA']);
            }
            return $uf;
        }
    }
?>