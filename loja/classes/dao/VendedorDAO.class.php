<?php
    require_once (__DIR__ . "/./Conexao.class.php");
    require_once (__DIR__ . "/../modelo/Vendedor.class.php");
    require_once (__DIR__ . "/../modelo/Sexo.class.php");

    class VendedorDAO {

        private $conexao;

        function __construct() {
            $this->conexao = Conexao::get();
        }
        
        public function findAll() {
            $sql = "SELECT * FROM TB_VENDEDORES LEFT JOIN TB_SEXOS ON PK_SEX = FK_VEN_SEX ORDER BY PK_VEN ASC";
            $statement = $this->conexao->prepare($sql);
            $statement->execute();
            $rows = $statement->fetchAll();
            $vendedores = array();
            foreach ($rows as $row) {
                $sexo = new Sexo();
                $sexo->setId($row['PK_SEX']);
                $sexo->setNome($row['SEX_NOME']);
                $sexo->setSigla($row['SEX_SIGLA']);
                $vendedor = new Vendedor();
                $vendedor->setId($row['PK_VEN']);
                $vendedor->setNome($row['VEN_NOME']);
                $vendedor->setCpf($row['VEN_CPF']);
                $vendedor->setMatricula($row['VEN_MATRICULA']);
                $vendedor->setSexo($sexo);
                array_push($vendedores, $vendedor);
            }
            return $vendedores;
        }

        public function findById($id) {
            $sql = "SELECT * FROM TB_VENDEDORES LEFT JOIN TB_SEXOS ON PK_SEX = FK_VEN_SEX WHERE PK_VEN = :ID";
            $statement = $this->conexao->prepare($sql);
            $statement->bindParam(':ID', $id); //Proteção contra sql injetct
            $statement->execute();
            $row = $statement->fetch();
            $sexo = new Sexo();
            $sexo->setId($row['PK_SEX']);
            $sexo->setNome($row['SEX_NOME']);
            $sexo->setSigla($row['SEX_SIGLA']);
            $vendedor = new Vendedor();
            $vendedor->setId($row['PK_VEN']);
            $vendedor->setNome($row['VEN_NOME']);
            $vendedor->setCpf($row['VEN_CPF']);
            $vendedor->setMatricula($row['VEN_MATRICULA']);
            $vendedor->setSexo($sexo);
            
            return $vendedor;
        }

        public function findByNome($nome) {
            $sql = "SELECT * FROM TB_VENDEDORES LEFT JOIN TB_SEXOS ON PK_SEX = FK_VEN_SEX WHERE SEX_NOME LIKE :NOME";
            $statement = $this->conexao->prepare($sql);
            $statement->bindParam(':NOME', $nome); //Proteção contra sql injetct
            $statement->execute();
            $rows = $statement->fetchAll();
            $sexo = new Sexo();
            $vendedor = new Vendedor();
            foreach ($rows as $row) {
                $vendedor->setId($row['PK_VEN']);
                $vendedor->setNome($row['VEN_NOME']);
                $vendedor->setCpf($row['VEN_CPF']);
                $vendedor->setMatricula($row['VEN_MATRICULA']);
                $vendedor->setSexo()->setId($row['PK_SEX']);
                $vendedor->setSexo()->setNome($row['SEX_NOME']);
                $vendedor->setSexo()->setSigla($row['SEX_SIGLA']);
            }
            return $vendedor;
        }

        public function save(Vendedor $vendedor) {
            if ($vendedor->getId() == null) {
                $this->insert($vendedor);
            } else {
                $this->update($vendedor);
            }
        }

        private function insert(Vendedor $vendedor) {
            $sql = "INSERT INTO TB_VENDEDORES (VEN_NOME, VEN_CPF, VEN_MATRICULA, FK_VEN_SEX) VALUES (:NOME, :CPF, :MATRICULA, :SEXO)";
            try {
                $statement = $this->conexao->prepare($sql);
                $nome = $vendedor->getNome();
                $cpf = $vendedor->getCpf();
                $matricula = $vendedor->getMatricula();
                $sexoId = $vendedor->getSexo()->getId();                
                $statement->bindParam(':NOME', $nome);
                $statement->bindParam(':CPF', $cpf);
                $statement->bindParam(':MATRICULA', $matricula);
                $statement->bindParam(':SEXO', $sexoId);
                $statement->execute();
                return $this->findById($this->conexao->lastInsertId());
            } catch(PDOException $e) {
                echo $e->getMessage();
                return null;
            }
        }

        private function update(Vendedor $vendedor) {
            $sql = "UPDATE TB_VENDEDORES SET VEN_NOME=:NOME, VEN_CPF=:CPF, VEN_MATRICULA=:MATRICULA, FK_VEN_SEX=:SEXO WHERE PK_VEN = :ID";
            try {
                $statement = $this->conexao->prepare($sql);
                $nome = $vendedor->getNome();
                $cpf = $vendedor->getCpf();
                $matricula = $vendedor->getMatricula();
                $sexo = $vendedor->getSexo()->getId();
                $id = $vendedor->getId();
                $statement->bindParam(':NOME', $nome);
                $statement->bindParam(':CPF', $cpf);
                $statement->bindParam(':MATRICULA', $matricula);
                $statement->bindParam(':SEXO', $sexo);
                $statement->bindParam(':ID', $id);
                $statement->execute();
                return $this->findById($vendedor->getId());
                } catch(PDOException $e) {
                echo $e->getMessage();
                return null;
            }
        }

        public function remove($id) {
            $sql = "DELETE FROM TB_VENDEDORES WHERE PK_VEN = :ID";
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