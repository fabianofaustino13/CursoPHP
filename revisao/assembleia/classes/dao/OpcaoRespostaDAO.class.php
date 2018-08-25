<?php

require_once (__DIR__ . "/./Conexao.class.php");
require_once (__DIR__ . "/../modelo/OpcaoResposta.class.php");

    class OpcaoRespostaDAO {

        public function findAll() {
            $sql = "SELECT * FROM TB_OPCOES_RESPOSTAS ORDER BY PK_ODR ASC";
            $statement = Conexao::get()->prepare($sql);
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
            $sql = "SELECT * FROM TB_OPCOES_RESPOSTAS WHERE PK_ODR = $id";
            $statement = Conexao::get()->prepare($sql);
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
            $sql = "SELECT * FROM TB_OPCOES_RESPOSTAS WHERE ODR_NOME = '$nome'";
            $statement = Conexao::get()->prepare($sql);
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
            $sql = "INSERT INTO TB_OPCOES_RESPOSTAS (ODR_NOME, ODR_IMAGEM) VALUES ('{$opcaoResposta->getNome()}', '{$opcaoResposta->getImagem()}')";
            try {
                Conexao::get()->exec($sql);
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }

        private function update(OpcaoResposta $opcaoResposta) {
            $sql = "UPDATE TB_OPCOES_RESPOSTAS SET ODR_NOME ='{$opcaoResposta->getNome()}', ODR_IMAGEM ='{$opcaoResposta->getImagem()}' WHERE PK_ODR ='{$opcaoResposta->getId()}'";
            try {
                Conexao::get()->exec($sql);
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }

        public function remove($id) {
            $sql = "DELETE FROM TB_OPCOES_RESPOSTAS WHERE PK_ODR=$id";
            try {
                Conexao::get()->exec($sql);
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    }