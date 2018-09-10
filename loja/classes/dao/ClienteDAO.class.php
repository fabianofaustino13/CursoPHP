<?php
    require_once (__DIR__ . "/./Conexao.class.php");
    require_once (__DIR__ . "/../modelo/Sexo.class.php");

    class ClienteDAO {

        private $conexao;

        function __construct() {
            $this->conexao = Conexao::get();
        }

        public function findAll() {
            $sql = "SELECT * FROM TB_CLIENTES_PESSOAS_FISICAS";
            $statement = $this->conexao->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll();
            $pf_clientes = array();
            foreach ($result as $row) {
                $sexo = new Sexo();
                $sexo->setId($row['PK_SEX']);
                $sexo->setNome($row['SEX_NOME']);
                $sexo->setSigla($row['SEX_SIGLA']);
                $pf_cliente = new Cliente();
                $pf_cliente->setId($row['PK_PFC']);
                $pf_cliente->setNome($row['PFC_NOME']);
                $pf_cliente->setCpf($row['PFC_CPF']);
                $pf_cliente->setSexo($sexo);
                array_push($pf_clientes, $pf_cliente);
            }
            return $pf_clientes;
        }

        public function findById($id) {
            $sql = "SELECT * FROM TB_CLIENTES_PESSOAS_FISICAS WHERE PK_PFC = :ID";
            $statement = $this->conexao->prepare($sql);
            $statement->bindParam(':ID', $id); //Proteção contra sql injetct
            $statement->execute();
            $sexo = new Sexo();
            $sexo->setId($row['PK_SEX']);
            $sexo->setNome($row['SEX_NOME']);
            $sexo->setSigla($row['SEX_SIGLA']);
            $pf_cliente = new Cliente();
            $pf_cliente->setId($row['PK_PFC']);
            $pf_cliente->setNome($row['PFC_NOME']);
            $pf_cliente->setCpf($row['PFC_CPF']);
            $pf_cliente->setSexo($sexo);
            
            return $pf_cliente;
        }

        public function findByNome($nome) {
            $sql = "SELECT * FROM TB_CLIENTES_PESSOAS_FISICAS WHERE PFC_NOME LIKE :NOME";
            $statement = $this->conexao->prepare($sql);
            $statement->bindParam(':NOME', $nome); //Proteção contra sql injetct
            $statement->execute();
            $result = $statement->fetchAll();
            $sexo = new Sexo();
            $sexo->setId($row['PK_SEX']);
            $sexo->setNome($row['SEX_NOME']);
            $sexo->setSigla($row['SEX_SIGLA']);
            $pf_cliente = new Cliente();
            $pf_cliente->setId($row['PK_PFC']);
            $pf_cliente->setNome($row['PFC_NOME']);
            $pf_cliente->setCpf($row['PFC_CPF']);
            $pf_cliente->setSexo($sexo);
            
            return $pf_cliente;
        }

        public function save(Cliente $pf_cliente) {
            if ($pf_cliente->getId() == null) {
                $this->insert($pf_cliente);
            } else {
                $this->update($pf_cliente);
            }
        }

        private function insert(Cliente $pf_cliente) {
            $sql = "INSERT INTO TB_CLIENTES_PESSOAS_FISICAS (PFC_NOME, PFC_CPF, FK_PFC_SEXO) VALUES (:NOME, :CPF, :SEXO)";
            try {
                $statement = $this->conexao->prepare($sql);
                $nome = $pf_cliente->getNome();
                $cpf = $pf_cliente->getCpf();
                $sexo = $pf_cliente->getSexo()->getId();
                $statement->bindParam(':NOME', $nome);
                $statement->bindParam(':CPF', $cpf);
                $statement->bindParam(':SEXO', $sexo);
                $statement->execute();
                return $this->findById($this->conexao->lastInsertId());
            } catch(PDOException $e) {
                echo $e->getMessage();
                return null;
            }
        }

        private function update(Cliente $pf_cliente) {
            $sql = "UPDATE TB_CLIENTES_PESSOAS_FISICAS SET PFC_NOME=:NOME, PFC_CPF=:CPF, FK_PFC_SEXO=:SEXO WHERE PK_PFC = :ID";
            try {
                $statement = $this->conexao->prepare($sql);
                $nome = $pf_cliente->getNome();
                $cpf = $pf_cliente->getCpf();
                $sexo = $pf_cliente->getSexo()->getId();
                $statement->bindParam(':NOME', $nome);
                $statement->bindParam(':CPF', $cpf);
                $statement->bindParam(':SEXO', $sexo);
                $statement->bindParam(':ID', $id);
                $statement->execute();
                return $this->findById($pf_cliente->getId());
            } catch(PDOException $e) {
                echo $e->getMessage();
                return null;
            }
        }

        public function remove($id) {
            $sql = "DELETE FROM TB_CLIENTES_PESSOAS_FISICAS WHERE PK_PFC = :ID";
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