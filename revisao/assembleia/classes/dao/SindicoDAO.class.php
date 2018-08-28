<?php

require_once (__DIR__ . "/./Conexao.class.php");
require_once (__DIR__ . "/../modelo/Morador.class.php");
require_once (__DIR__ . "/../modelo/Sindico.class.php");

    class SindicoDAO {

        private $conexao;

        function __construct() {
            $this->conexao = Conexao::get();
        }

        public function findAll() {
            $sql = "SELECT * FROM TB_MORADORES ORDER BY PK_MOR ASC";
            $statement = $this->conexao->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll();
            $moradores = array();
            foreach ($result as $row) {
                $morador = new Morador();
                $morador->setId($row['PK_MOR']);
                $morador->setNome($row['MOR_NOME']);
                $morador->setFkMorSin($row['FK_MOR_SIN']);
              
                array_push($moradores, $morador);
            }
            return $moradores;
        }

        public function findById($id) {
            $sql = "SELECT * FROM TB_MORADORES WHERE PK_MOR = :ID";
            $statement = $this->conexao->prepare($sql);
            $statement->bindParam(':ID', $id);
            $statement->execute();
            $result = $statement->fetchAll();
            $morador = new Morador();
            foreach ($result as $row) {
                $morador->setId($row['PK_MOR']);
                $morador->setNome($row['MOR_NOME']);
                $morador->setFkMorSin($row['FK_MOR_SIN']);
            }
            return $morador;
        }

        public function findByNome($nome) {
            $sql = "SELECT * FROM TB_MORADORES WHERE MOR_NOME LIKE %:NOME%";
            $statement = $this->conexao->prepare($sql);
            $statement->bindParam(':NOME', $nome);
            $statement->execute();
            $result = $statement->fetchAll();
            $moradores = array();
            foreach ($result as $row) {
                $morador = new Morador();
                $morador->setId($row['PK_MOR']);
                $morador->setNome($row['MOR_NOME']);
                $morador->setFkMorSin($row['FK_MOR_SIN']);
                array_push($moradores, $morador);
            }
            return $moradores;
        }

        public function save(Morador $morador) {
            if ($morador->getId() == null) {
                // $this->insert($morador);
            } else {
                $this->update2($morador);
            }
        }

        private function insert(Morador $morador) {
            $sql = "INSERT INTO TB_MORADORES (MOR_NOME, MOR_LOGIN, MOR_SENHA, MOR_ULTIMO_ACESSO, MOR_FOTO, FK_MOR_SIN) VALUES (:NOME, :USERNAME, :SENHA, :ULTIMOACESSO, :FOTO, :SINDICO)";
            try {
                $statement = $this->conexao->prepare($sql);
                $nome = $morador->getNome();
                $username = $morador->getLogin();
                $senha = $morador->getSenha();
                $ultimoAcesso = $morador->getUltimoAcesso();
                $foto = $morador->getFoto();
                $statement->bindParam(':NOME', $nome);
                $statement->bindParam(':USERNAME', $username);
                $statement->bindParam(':SENHA', $senha);
                $statement->bindParam(':ULTIMOACESSO', $ultimoAcesso);
                $statement->bindParam(':FOTO', $foto);
                $statement->execute();
                return $this->findById($this->conexao->lastInsertId());
            } catch(PDOException $e) {
                echo $e->getMessage();
                return null;
            }
        }

        private function update(Morador $morador) {
            $sql = "UPDATE TB_MORADORES SET MOR_NOME = :NOME, MOR_LOGIN = :USERNAME, MOR_SENHA = :SENHA, MOR_ULTIMO_ACESSO = :ULTIMOACESSO, MOR_FOTO = :FOTO, MOR_MOR_SIN = :SINDICO WHERE PK_MOR = :ID";
            try {
                $statement = $this->conexao->prepare($sql);
                $nome = $morador->getNome();
                $username = $morador->getLogin();
                $senha = $morador->getSenha();
                $ultimoAcesso = $morador->getUltimoAcesso();
                $foto = $morador->getFoto();
                $sindico = $morador->getFkMorSin();
                $statement->bindParam(':NOME', $nome);
                $statement->bindParam(':USERNAME', $username);
                $statement->bindParam(':SENHA', $senha);
                $statement->bindParam(':ULTIMOACESSO', $ultimoAcesso);
                $statement->bindParam(':FOTO', $foto);
                $statement->bindParam(':SINDICO', $sindico);
                $statement->execute();
                return $this->findById($this->conexao->lastInsertId());
            } catch(PDOException $e) {
                echo $e->getMessage();
                return null;
            }
        }

        private function update2(Morador $morador) {
            $sql = "UPDATE TB_MORADORES SET FK_MOR_SIN = :SINDICO";
            try {
                $statement = $this->conexao->prepare($sql);
                $sindico = $morador->getFkMorSin();
                $statement->bindParam(':SINDICO', $sindico);
                $statement->execute();
            } catch(PDOException $e) {
                echo $e->getMessage();
                return null;
            }
        }

        public function remove($id) {
            $sql = "DELETE FROM TB_MORADORES WHERE PK_MOR = :ID";
            try {
                $statement = $this->conexao->prepare($sql);
                $statement->bindParam(':ID', $id);
                $statement->execute();
            } catch(PDOException $e) {
                echo $e->getMessage();
                return null;
            }
        }
    }