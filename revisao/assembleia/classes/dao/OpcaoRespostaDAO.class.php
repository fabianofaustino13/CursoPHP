<?php

require_once (__DIR__ . "/./Conexao.class.php");
require_once (__DIR__ . "/../modelo/OpcaoResposta.class.php");

    class OpcaoRespostaDAO {

        private $conexao;

        function __construct() {
            $this->conexao = Conexao::get();
        }

        public function findAll() {
            $sql = "SELECT * FROM TB_OPCOES_RESPOSTAS ORDER BY PK_ODR ASC";
            $statement = $this->conexao->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll();
            $opcaoRespostas = array();
            foreach ($result as $row) {
                $opcaoResposta = new OpcaoResposta();
                $opcaoResposta->setId($row['PK_ODR']);
                $opcaoResposta->setNome($row['ODR_NOME']);
                $opcaoResposta->setImagem($row['ODR_IMAGEM']);
              
                array_push($opcaoRespostas, $opcaoResposta);
            }
            return $opcaoRespostas;
        }

        public function findById($id) {
            $sql = "SELECT * FROM TB_OPCOES_RESPOSTAS WHERE PK_ODR = :ID";
            $statement = $this->conexao->prepare($sql);
            $statement->bindParam(':ID', $id);
            $statement->execute();
            $result = $statement->fetchAll();
            $opcaoResposta = new OpcaoResposta();
            foreach ($result as $row) {
                $opcaoResposta->setId($row['PK_ODR']);
                $opcaoResposta->setNome($row['ODR_NOME']);
                $opcaoResposta->setImagem($row['ODR_IMAGEM']);
            }
            return $opcaoResposta;
        }

        public function findByNome($nome) {
            $sql = "SELECT * FROM TB_OPCOES_RESPOSTAS WHERE ODR_NOME = :NOME";
            $statement = $this->conexao->prepare($sql);
            $statement->bindParam(':NOME', $nome);
            $statement->execute();
            $result = $statement->fetchAll();
            $opcaoResposta = new OpcaoResposta();
            foreach ($result as $row) {
                $opcaoResposta->setId($row['PK_ODR']);
                $opcaoResposta->setNome($row['ODR_NOME']);
                $opcaoResposta->setImagem($row['ODR_IMAGEM']);
            }
            return $opcaoResposta;
        }

        public function save(OpcaoResposta $opcaoResposta) {
            if ($opcaoResposta->getId() == null) {
                $this->insert($opcaoResposta);
            } else {
                $this->update($opcaoResposta);
            }
        }

        private function insert(OpcaoResposta $opcaoResposta) {
            $sql = "INSERT INTO TB_OPCOES_RESPOSTAS (ODR_NOME, ODR_IMAGEM) VALUES (:NOME, :IMAGEM)";
            try {
                $statement = $this->conexao->prepare($sql);
                $nome = $opcaoResposta->getNome();
                $imagem = $opcaoResposta->getImagem();
                $statement->bindParam(':NOME', $nome);
                $statement->bindParam(':IMAGEM', $imagem);
                $statement->execute();
                return $this->findById($this->conexao->lastInsertId());
            } catch(PDOException $e) {
                echo $e->getMessage();
                return null;
            }
        }

        private function update(OpcaoResposta $opcaoResposta) {
            $sql = "UPDATE TB_OPCOES_RESPOSTAS SET ODR_NOME = :NOME, ODR_IMAGEM = :IMAGEM WHERE PK_ODR = :ID";
            try {
                $statement = $this->conexao->prepare($sql);
                $nome = $opcaoResposta->getNome();
                $imagem = $opcaoResposta->getImagem();
                $id = $opcaoResposta->getId();
                $statement->bindParam(':NOME', $nome);
                $statement->bindParam(':IMAGEM', $imagem);
                $statement->bindParam(':ID', $id);
                $statement->execute();
                return $this->findById($this->conexao->lastInsertId());
            } catch(PDOException $e) {
                echo $e->getMessage();
                return null;
            }
        }

        public function remove($id) {
            $sql = "DELETE FROM TB_OPCOES_RESPOSTAS WHERE PK_ODR = :ID";
            try {
                $statement = $this->conexao->prepare($sql);
                $id = $opcaoResposta->getId();
                $statement->bindParam(':ID', $id);
                $statement->execute();
                return $this->findById($this->conexao->lastInsertId());
            } catch(PDOException $e) {
                echo $e->getMessage();
                return null;
            }
        }
    }