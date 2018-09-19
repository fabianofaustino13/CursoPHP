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
            $sql = "SELECT * FROM TB_SINDICOS JOIN TB_MORADORES ON PK_MOR = FK_SIN_MOR  ORDER BY SIN_DATA_FIM DESC";
            $statement = $this->conexao->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll();
            $sindicos = array();
            foreach ($result as $row) {
                $morador = new Morador();
                $morador->setId($row['PK_MOR']);
                $morador->setNome($row['MOR_NOME']);
                $morador->setCpf($row['MOR_CPF']);
                $morador->setLogin($row['MOR_LOGIN']);
                $morador->setStatus($row['MOR_STATUS']);
                $sindico = new sindico();
                $sindico->setId($row['PK_SIN']);
                $sindico->setDataInicio($row['SIN_DATA_INICIO']);
                $sindico->setDataFim($row['SIN_DATA_FIM']);
                $sindico->setMorador($morador);
              
                array_push($sindicos, $sindico);
            }
            return $sindicos;
        }

        public function findMoradorAll() {
            $sql = "SELECT DISTINCT PK_MOR, MOR_NOME, MOR_CPF FROM TB_SINDICOS RIGHT JOIN TB_MORADORES ON PK_MOR = FK_SIN_MOR ORDER BY MOR_NOME ASC";
            $statement = $this->conexao->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll();
            $sindicos = array();
            foreach ($result as $row) {
                $morador = new Morador();
                $morador->setId($row['PK_MOR']);
                $morador->setNome($row['MOR_NOME']);
                $morador->setCpf($row['MOR_CPF']);
                //$morador->setLogin($row['MOR_LOGIN']);
                //$morador->setStatus($row['MOR_STATUS']);
                $sindico = new sindico();
                //$sindico->setId($row['PK_SIN']);
                //$sindico->setDataInicio($row['SIN_DATA_INICIO']);
                //$sindico->setDataFim($row['SIN_DATA_FIM']);
                $sindico->setMorador($morador);
              
                array_push($sindicos, $sindico);
            }
            return $sindicos;
        }
    
        public function findById($id) {
            $sql = "SELECT * FROM TB_SINDICOS RIGHT JOIN TB_MORADORES ON PK_MOR = FK_SIN_MOR WHERE PK_SIN = :ID";
            $statement = $this->conexao->prepare($sql);
            $statement->bindParam(':ID', $id);
            $statement->execute();
            $row = $statement->fetch();
            $morador = new Morador();
            $morador->setId($row['PK_MOR']);
            $morador->setNome($row['MOR_NOME']);
            $morador->setCpf($row['MOR_CPF']);
            $morador->setLogin($row['MOR_LOGIN']);
            $morador->setStatus($row['MOR_STATUS']);
            
            $sindico = new Sindico();
            $sindico->setId($row['PK_SIN']);
            $sindico->setDataInicio($row['SIN_DATA_INICIO']);
            $sindico->setDataFim($row['SIN_DATA_FIM']);
            $sindico->setMorador($morador);
            
            return $sindico;
        }

        public function findMoradorId(Morador $morador) {
            $sql = "SELECT * FROM TB_SINDICOS RIGHT JOIN TB_MORADORES ON PK_MOR = FK_SIN_MOR WHERE PK_MOR = :ID";
            $statement = $this->conexao->prepare($sql);
            $id_sindico = $morador->getId();
            $statement->bindParam(':ID', $id_sindico);
            $statement->execute();
            $row = $statement->fetch();
            $morador = new Morador();
            $morador->setId($row['PK_MOR']);
            $morador->setNome($row['MOR_NOME']);
            $morador->setCpf($row['MOR_CPF']);
            $morador->setLogin($row['MOR_LOGIN']);
            $morador->setStatus($row['MOR_STATUS']);
            
            $sindico = new Sindico();
            $sindico->setId($row['PK_SIN']);
            $sindico->setDataInicio($row['SIN_DATA_INICIO']);
            $sindico->setDataFim($row['SIN_DATA_FIM']);
            $sindico->setMorador($morador);
            
            return $sindico;
        }

        public function findByNome($nome) {
            $sql = "SELECT * FROM TB_MORADORES WHERE MOR_NOME LIKE '%$nome%'";
            $statement = $this->conexao->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll();
            $moradores = array();
            foreach ($result as $row) {
                $morador = new Morador();
                $morador->setId($row['PK_MOR']);
                $morador->setNome($row['MOR_NOME']);
                $morador->setMorador($row['FK_MOR_SIN']);
                array_push($moradores, $morador);
            }
            return $moradores;
        }

        public function save(Sindico $sindico) {
            if (is_null($sindico->getId())) {
                $this->insert($sindico);
            } else {
                $this->update($sindico);
            }
        }

        private function insert(Sindico $sindico) {
            // $sql = "INSERT INTO TB_MORADORES (MOR_NOME, MOR_LOGIN, MOR_SENHA) VALUES (:NOME, :USERNAME, :SENHA)";
            $sql = "INSERT INTO TB_SINDICOS (SIN_DATA_INICIO, SIN_DATA_FIM, FK_SIN_MOR) VALUES (:DATA_INICIO, :DATA_FIM, :SINDICO)";
            try {
                // $statement = $this->conexao->prepare($sql);
                // $nome = $morador->getNome();
                // $username = $morador->getLogin();
                // $senha = $morador->getSenha();
                // $statement->bindParam(':NOME', $nome);
                // $statement->bindParam(':USERNAME', $username);
                // $statement->bindParam(':SENHA', $senha);
                // $statement->execute();
                // $sindico_id = $morador->setId($this->conexao->lastInsertId());
                // return $this->findById($this->conexao->lastInsertId());

                $statement = $this->conexao->prepare($sql);
                $data_inicio = $sindico->getDataInicio();
                $data_fim = $sindico->getDataFim();
                $id_morador = $sindico->getMorador()->getId();
                $statement->bindParam(':DATA_INICIO', $data_inicio);
                $statement->bindParam(':DATA_FIM', $data_fim);
                $statement->bindParam(':SINDICO', $id_morador);
                $statement->execute();
                return $this->findById($this->conexao->lastInsertId());

            } catch(PDOException $e) {
                echo $e->getMessage();
                return null;
            }
        }

        private function update(Sindico $sindico) {
            $sql = "UPDATE TB_SINDICOS SET SIN_DATA_INICIO=:DATA_INICIO, SIN_DATA_FIM=:DATA_FIM WHERE PK_SIN=:ID";
            try {
                $statement = $this->conexao->prepare($sql);
                $data_inicio = $sindico->getDataInicio();
                $data_fim = $sindico->getDataFim();
                // $sindico = $sindico->getMorador()->getId();
                $id = $sindico->getId();
                $statement->bindParam(':DATA_INICIO', $data_inicio);
                $statement->bindParam(':DATA_FIM', $data_fim);
                // $statement->bindParam(':SINDICO', $sindico);
                $statement->bindParam(':ID', $id);
                $statement->execute();
                return $this->findById($sindico->getId());
            } catch(PDOException $e) {
                echo $e->getMessage();
                return null;
            }
        }

        private function update2(Morador $morador) {
            $sql = "UPDATE TB_MORADORES SET FK_MOR_SIN = :SINDICO";
            try {
                $statement = $this->conexao->prepare($sql);
                $sindico = $morador->getMorador();
                $statement->bindParam(':SINDICO', $sindico);
                $statement->execute();
            } catch(PDOException $e) {
                echo $e->getMessage();
                return null;
            }
        }

        public function remove($id) {
            $sql = "DELETE FROM TB_SINDICOS WHERE PK_SIN = :ID";
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