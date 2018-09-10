<?php
    require_once(__DIR__ . "/./Conexao.class.php");
    require_once(__DIR__ . "/../modelo/Funcionario.class.php");
    require_once(__DIR__ . "/../modelo/Cliente.class.php");
    require_once(__DIR__ . "/../modelo/Produto.class.php");


    class VendaDAO {

        private $conexao;

        function __construct() {
            $this->conexao = Conexao::get();
        }

        public function findAll() {
            $sql = "SELECT * FROM TB_VENDAS";
            $statement = $this->conexao->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll();
            $vendas = array();
            foreach ($result as $row) {               
                $funcionario = new Funcionario();
                $funcionario->setMatricula($row['PK_MATRICULA']);
                $funcionario->setNome($row['FUN_NOME']);
                $cliente = new Cliente();
                $cliente->setId($row['PK_PFC']);
                $cliente->setNome($row['PFC_NOME']);
                $cliente->setCpf($row['PFC_CPF']);
                $produto = new Produto();
                $produto->setId($row['PK_PRO']);
                $produto->setNome($row['PRO_NOME']);
                $produto->setPreco($row['PRO_PRECO']);
                $venda = new Venda();
                $venda->setId($row['PK_VDS']);
                $venda->getFuncionario($funcionario);
                $venda->setCliente($cliente);
                $venda->setProdutos($produto);
                array_push($vendas, $venda);
            }
            return $vendas;
        }

        public function findById($id) {
            $sql = "SELECT * FROM TB_VENDAS LEFT JOIN TB_CLIENTES ON PK_CLI = FK_VDS_CLI LEFT JOIN TB_VENDEDORES ON PK_MATRICULA = FK_VDS_VEN WHERE PK_VDS = :ID";
            $statement = $this->conexao->prepare($sql);
            $statement->bindParam(':ID', $id); //Proteção contra sql injetct
            $statement->execute();
            $result = $statement->fetchAll();
            $cliente = new Cliente();
            $cliente->setId($row['PK_CLI']);
            $cliente->setNome($row['CLI_NOME']);
            $funcionario = new Funcionario();
            $funcionario->setMatricula($row['PK_MATRICULA']);
            $funcionario->setNome($row['FUN_NOME']);
            $produto = new Produto();
            $produto->setId($row['PK_PRO']);
            $produto->setNome($row['PRO_NOME']);
            $produto->setValor($row['PRO_VALOR']);
            $venda = new Venda();
            $venda->setId($row['PK_VDS']);
            $venda->setFuncionario($funcionario);
            $venda->setCliente($cliente);
            $venda->setProdutos($produto);

            return $venda;
        }
        
        public function save(Venda $venda) {
            if ($venda->getId() == null) {
                $this->insert($venda);
            } else {
                $this->update($venda);
            }
        }

        private function insert(Venda $venda) {
            $sql = "INSERT INTO TB_VENDAS (FK_VDS_VEN, FK_VDS_CLI, VDS_PRECO) VALUES (:FUNCIONARIO, :CLIENTE, :TOTAL)";
            try {
                $statement = $this->conexao->prepare($sql);
                $funcionario = $venda->getFuncionario()->getMatricula();
                $cliente = $venda->getCliente()->getId();
                $total = $venda->getValor();
                $statement->bindParam(':FUNCIONARIO', $funcionario);
                $statement->bindParam(':CLIENTE', $cliente);
                $statement->bindParam(':TOTAL', $total);
                $statement->execute();
                $venda->setId($this->conexao->lastInsertId());
                foreach($venda->getProdutos as $produto) {
                    $sql = "INSERT INTO TB_ITENS_VENDAS (FK_IDV_VDS, FK_IDV_PRO) VALUES (:VENDA, :PRODUTO)";
                    $venda_id = $venda->getId();
                    $produto_id = $produto->getId();
                    $statement->bindParam(':VENDA', $venda_id);
                    $statement->bindParam(':PRODUTO', $produto_id);
                    $statement->execute();
                }
                return $venda;
            } catch(PDOException $e) {
                echo $e->getMessage();
                return null;
            }
        }

        private function update(Venda $venda) {
            $sql = "UPDATE TB_VENDAS SET FK_VDS_VEN=:FUNCIONARIO, FK_VDS_CLI=:CLIENTE, VDS_PRECO=:VALOR WHERE PK_VDS = :ID";
            try {
                $statement = $this->conexao->prepare($sql);
                $funcionario = $venda->getFuncionario()->getMatricula();
                $cliente = $venda->getCliente()->getId();
                $preco = $venda->getProdutos()->getPreco();
                $id = $venda->getId();
                $statement->bindParam(':FUNCIONARIO', $funcionario);
                $statement->bindParam(':CLIENTE', $cliente);
                $statement->bindParam(':VALOR', $preco);
                $statement->bindParam(':ID', $id);
                $statement->execute();
                return $this->findById($venda->getId());
            } catch(PDOException $e) {
                echo $e->getMessage();
                return null;
            }
        }

        public function remove($id) {
            $sql = "DELETE FROM TB_VENDAS WHERE PK_VDS = :ID";
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