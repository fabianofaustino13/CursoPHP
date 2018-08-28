<?php
    require_once (__DIR__ . "/./Conexao.class.php");
    require_once (__DIR__ . "/../modelo/Produto.class.php");
    require_once (__DIR__ . "/../modelo/Marca.class.php");

    class ProdutoDAO {

        public function findAll() {
            $sql = "SELECT PK_PRO, PRO_NOME, PRO_PRECO, PRO_DESCRICAO, PRO_QUANTIDADE_MINIMA, PRO_QUANTIDADE_ESTOQUE, PK_MAR, MAR_NOME, PK_DEP, DEP_NOME FROM TB_PRODUTOS JOIN TB_MARCAS ON PK_MAR=FK_PRO_MAR JOIN TB_DEPARTAMENTOS ON PK_DEP=FK_PRO_DEP";
            $statement = Conexao::get()->prepare($sql);
            $statement->execute();
            $rows = $statement->fetchAll();
            $produtos = array();
            foreach ($rows as $row) {
                $marca = new Marca();
                $marca->getId($row['PK_MAR']);
                $marca->getNome($row['MAR_NOME']);
                $departamento = new Departamento();
                $departamento->getId($row['PK_DEP']);
                $departamento->getNome($row['DEP_NOME']);
                $produto = new Produto();
                $produto->setId($row['PK_PRO']);
                $produto->setNome($row['PRO_NOME']);
                $produto->setPreco($row['PRO_PRECO']);
                $produto->setDescricao($row['PRO_DESCRICAO']);
                $produto->setQntMinima($row['PRO_QUANTIDADE_MINIMA']);
                $produto->setQntEstoque($row['PRO_QUANTIDADE_ESTOQUE']);
                $produto->setMarca($marca);
                $produto->setDepartamento($departamento);
                array_push($produtos, $produto);
            }
            return $produtos;
        }

        public function findById($id) {
            $sql = "SELECT PK_PRO, PRO_NOME, PRO_PRECO, PRO_DESCRICAO, PRO_QUANTIDADE_MINIMA, PRO_QUANTIDADE_ESTOQUE, PK_MAR, MAR_NOME, PK_DEP, DEP_NOME FROM TB_PRODUTOS JOIN TB_MARCAS ON PK_MAR=FK_PRO_MAR JOIN TB_DEPARTAMENTOS ON PK_DEP=FK_PRO_DEP WHERE PK_PRO = :ID";
            $statement = Conexao::get()->prepare($sql);
            $statement->bindParam(':ID', $id); //Proteção contra sql injetct
            $statement->execute();
            $row = $statement->fetch();
            $produto = new produto();
            $marca = new Marca();
            $departamento = new Departamento();
            $produto->setId($row['PK_PRO']);
            $produto->setNome($row['PRO_NOME']);
            $produto->setPreco($row['PRO_PRECO']);
            $produto->setDescricao($row['PRO_DESCRICAO']);
            $produto->setQntMinima($row['PRO_QUANTIDADE_MINIMA']);
            $produto->setQntEstoque($row['PRO_QUANTIDADE_ESTOQUE']);
            $produto->setMarca()->setId($row['PK_MAR']);
            $produto->setMarca()->setNome($row['MAR_NOME']);
            $produto->setDepartamento()->setId($row['PK_DEP']);
            $produto->setDepartamento()->setNome($row['DEP_NOME']);
            return $produto;
        }

        public function findByNome($nome) {
            $sql = "SELECT PK_PRO, PRO_NOME, PRO_PRECO, PRO_DESCRICAO, PRO_QUANTIDADE_MINIMA, PRO_QUANTIDADE_ESTOQUE, PK_MAR, MAR_NOME, PK_DEP, DEP_NOME FROM TB_PRODUTOS JOIN TB_MARCAS ON PK_MAR=FK_PRO_MAR JOIN TB_DEPARTAMENTOS ON PK_DEP=FK_PRO_DEP WHERE PRO_NOME LIKE ':NOME'";
            $statement = Conexao::get()->prepare($sql);
            $statement->bindParam(':NOME', $nome); //Proteção contra sql injetct
            $statement->execute();
            $rows = $statement->fetchAll();
            $produto = new produto();
            $marca = new Marca();
            $departamento = new Departamento();
            foreach ($rows as $row) {
                $produto->setId($row['PK_PRO']);
                $produto->setNome($row['PRO_NOME']);
                $produto->setPreco($row['PRO_PRECO']);
                $produto->setDescricao($row['PRO_DESCRICAO']);
                $produto->setQntMinima($row['PRO_QUANTIDADE_MINIMA']);
                $produto->setQntEstoque($row['PRO_QUANTIDADE_ESTOQUE']);
                $produto->setMarca()->setId($row['PK_MAR']);
                $produto->setMarca()->setNome($row['MAR_NOME']);
                $produto->setDepartamento()->setId($row['PK_DEP']);
                $produto->setDepartamento()->setNome($row['DEP_NOME']);
            }
            return $produto;
        }

        public function save(produto $produto) {
            if ($produto->getId() == null) {
                $this->insert($produto);
            } else {
                $this->update($produto);
            }
        }

        private function insert(produto $produto) {
            $sql = "INSERT INTO TB_PRODUTOS (PRO_NOME, PRO_PRECO, PRO_DESCRICAO, PRO_QUANTIDADE_MINIMA, PRO_QUANTIDADE_ESTOQUE, FK_PRO_MAR, FK_PRO_DEP) VALUES (:NOME, :PRECO, :DESCRICAO, :QNT_MINIMA, :QNT_ESTOQUE, :MARCA, :DEPARTAMENTO)";
            try {
                $statement = Conexao::get()->prepare($sql);
                $statement->bindParam(':NOME', $produto->getNome());
                $statement->bindParam(':PRECO', $produto->getPreco());
                $statement->bindParam(':DESCRICAO', $produto->getDescricao());
                $statement->bindParam(':QNT_MINIMA', $produto->getQntMinima());
                $statement->bindParam(':QNT_ESTOQUE', $produto->getQntEstoque());
                $statement->bindParam(':MARCA', $produto->getMarca()->getId());
                $statement->bindParam(':DEPARTAMENTO', $produto->getDepartamento()->getId());
                $statement->execute();
                $id = Conexao::get()->lastInsertId();
                return $this->findById($id);
            } catch(PDOException $e) {
                echo $e->getMessage();
                return null;
            }
        }

        private function update(produto $produto) {
            $sql = "UPDATE TB_PRODUTOS SET (PRO_NOME = :NOME, PRO_PRECO, PRO_DESCRICAO = :DESCRICAO, PRO_QUANTIDADE_MINIMA = :QNT_MINIMA, PRO_QUANTIDADE_ESTOQUE = :QNT_ESTOQUE, FK_PRO_MAR = :MARCA, FK_PRO_DEP = :DEPARTAMENTO) WHERE PK_PRO = :ID";
            try {
                $statement = Conexao::get()->prepare($sql);
                $statement->bindParam(':NOME', $produto->getNome());
                $statement->bindParam(':PRECO', $produto->getPreco());
                $statement->bindParam(':DESCRICAO', $produto->getDescricao());
                $statement->bindParam(':QNT_MINIMA', $produto->getQntMinima());
                $statement->bindParam(':QNT_ESTOQUE', $produto->getQntEstoque());
                $statement->bindParam(':MARCA', $produto->getMarca()->getId());
                $statement->bindParam(':DEPARTAMENTO', $produto->getDepartamento()->getId());
                $statement->bindParam(':ID', $produto->getId());
                $statement->execute();
                return $this->findById($produto->getId());
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }

        public function remove($id) {
            $sql = "DELETE FROM TB_PRODUTOS WHERE PK_PRO=:ID";
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