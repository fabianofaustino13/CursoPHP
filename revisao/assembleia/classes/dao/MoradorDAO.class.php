<?php

require_once (__DIR__ . "/./Conexao.class.php");
require_once (__DIR__ . "/../modelo/Morador.class.php");
require_once (__DIR__ . "/../modelo/Apartamento.class.php");
require_once (__DIR__ . "/../modelo/Sindico.class.php");

    class MoradorDAO {

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
                $morador->setLogin($row['MOR_LOGIN']);
                $morador->setSenha($row['MOR_SENHA']);
                $morador->setUltimoAcesso($row['MOR_ULTIMO_ACESSO']);
                $morador->setFoto($row['MOR_FOTO']);
                // $morador->setSindico($row['FK_MOR_SIN']);
              
                array_push($moradores, $morador);
            }
            return $moradores;
        }

        public function findById($id) {
            $sql = "SELECT * FROM TB_MORADORES WHERE PK_MOR = :ID";
            $statement = $this->conexao->prepare($sql);
            $statement->bindParam(':ID', $id); //Proteção contra sql injetct
            $statement->execute();
            $result = $statement->fetchAll();
            $morador = new Morador();
            foreach ($result as $row) {
                $morador->setId($row['PK_MOR']);
                $morador->setNome($row['MOR_NOME']);
                $morador->setLogin($row['MOR_LOGIN']);
                $morador->setSenha($row['MOR_SENHA']);
                $morador->setUltimoAcesso($row['MOR_ULTIMO_ACESSO']);
                $morador->setFoto($row['MOR_FOTO']);
                // $morador->setSindico($row['FK_MOR_SIN']);
            }
            return $morador;
        }

        public function findByApartamento($id) {
            $sql = "SELECT * FROM TB_MORADORES LEFT JOIN TB_APARTAMENTOS_MORADORES ON FK_ADM_MOR = PK_MOR LEFT JOIN TB_APARTAMENTOS ON PK_APA = FK_ADM_APA WHERE PK_APA = :ID";
            $statement = $this->conexao->prepare($sql);
            $statement->bindParam(':ID', $id); //Proteção contra sql injetct
            $statement->execute();
            $result = $statement->fetchAll();
            $apartamento = new Apartamento();
            $morador = new Morador();
            foreach ($result as $row) {
                $apartamento->setId($row['PK_APA']);
                $apartamento->setNome($row['APA_NOME']);
                $morador->setId($row['PK_MOR']);
                $morador->setNome($row['MOR_NOME']);
                $morador->setLogin($row['MOR_LOGIN']);
                $morador->setSenha($row['MOR_SENHA']);
            }
            return $morador;
        }

        public function findByNome($nome) {
            $sql = "SELECT * FROM TB_MORADORES WHERE MOR_NOME LIKE :NOME";
            $statement = $this->conexao->prepare($sql);
            $statement->bindParam(':NOME', $nome); //Proteção contra sql injetct
            $statement->execute();
            $result = $statement->fetchAll();
            $morador = new Morador();
            foreach ($result as $row) {
                $morador->setId($row['PK_MOR']);
                $morador->setNome($row['MOR_NOME']);
                $morador->setLogin($row['MOR_LOGIN']);
                $morador->setSenha($row['MOR_SENHA']);
                $morador->setUltimoAcesso($row['MOR_ULTIMO_ACESSO']);
                $morador->setFoto($row['MOR_FOTO']);
                // $morador->setSindico($row['FK_MOR_SIN']);
            }
            return $morador;
        }

        public function findByLogin($login) {
            $sql = "SELECT * FROM TB_MORADORES WHERE MOR_LOGIN = :USERNAME";
            $statement = $this->conexao->prepare($sql);
            $statement->bindParam(':USERNAME', $login); //Proteção contra sql injetct
            $statement->execute();
            $result = $statement->fetchAll();
            $morador = new Morador();
            foreach ($result as $row) {
                $morador->setId($row['PK_MOR']);
                $morador->setNome($row['MOR_NOME']);
                $morador->setLogin($row['MOR_LOGIN']);
                $morador->setSenha($row['MOR_SENHA']);
                $morador->setUltimoAcesso($row['MOR_ULTIMO_ACESSO']);
                $morador->setFoto($row['MOR_FOTO']);
                // $morador->setSindico($row['FK_MOR_SIN']);
            }
            return $morador;
        }
        public function findSindico() {
            $sql = "SELECT * FROM TB_MORADORES LEFT JOIN TB_SINDICOS ON FK_SIN_MOR = PK_MOR ORDER BY PK_SIN DESC";
            $statement = $this->conexao->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll();
            $sindicos = array();
            foreach ($result as $row) {
                $morador = new Morador();
                $morador->setId($row['PK_MOR']);
                $morador->setNome($row['MOR_NOME']);
                $morador->setLogin($row['MOR_LOGIN']);
                $morador->setSenha($row['MOR_SENHA']);
                $morador->setUltimoAcesso($row['MOR_ULTIMO_ACESSO']);
                $morador->setFoto($row['MOR_FOTO']);
                $sindico = new Sindico();
                $sindico->setId($row['PK_SIN']);
                $sindico->setSindico($morador);
              
                array_push($sindicos, $morador);
            }
            return $sindicos;
        }

        public function save(Morador $morador, Apartamento $apartamento) {
            if ($morador->getId() == null) {
                $this->insert($morador, $apartamento);
            } else {
                $this->update($morador, $apartamento);
            }
        }

        private function insert(Morador $morador, Apartamento $apartamento) {
            $sql = "INSERT INTO TB_MORADORES (MOR_NOME, MOR_LOGIN, MOR_SENHA) VALUES (:NOME, :USERNAME, :SENHA)";
            try {
                $statement = $this->conexao->prepare($sql);
                $nome = $morador->getNome();
                $username = $morador->getLogin();
                $senha = $morador->getSenha();
                $statement->bindParam(':NOME', $nome);
                $statement->bindParam(':USERNAME', $username);
                $statement->bindParam(':SENHA', $senha);
                $statement->execute();
                $morador->setId($this->conexao->lastInsertId());

                $sql = "INSERT INTO TB_APARTAMENTOS_MORADORES (FK_ADM_APA, FK_ADM_MOR) VALUES (:APARTAMENTO, :MORADOR)";
                $statement = $this->conexao->prepare($sql);
                $apartamento_id = $apartamento->getId();
                $morador_id = $morador->getId();
                $statement->bindParam(':APARTAMENTO', $apartamento_id);
                $statement->bindParam(':MORADOR', $morador_id);
                $statement->execute();

                return $morador;
            } catch(PDOException $e) {
                echo $e->getMessage();
                return null;
            }
        }

        private function update(Morador $morador, Apartamento $apartamento) {
            $sql = "UPDATE TB_MORADORES SET MOR_NOME=:NOME, MOR_LOGIN=:USERNAME, MOR_SENHA=:SENHA WHERE PK_MOR = :ID";
            try {
                $statement = $this->conexao->prepare($sql);
                $nome = $morador->getNome();
                $username = $morador->getLogin();
                $senha = $morador->getSenha();
                $ultimoAcesso = $morador->getUltimoAcesso();
                $foto = $morador->getFoto();
                $id = $morador->getId();
                $statement->bindParam(':NOME', $nome);
                $statement->bindParam(':USERNAME', $username);
                $statement->bindParam(':SENHA', $senha);
                $statement->bindParam(':ID', $id);
                $statement->execute();
                $morador->getId($this->conexao->lastInsertId());
                
                $sql = "INSERT INTO TB_APARTAMENTOS_MORADORES (FK_ADM_APA, FK_ADM_MOR) VALUES (:APARTAMENTO, :MORADOR)";
                $statement = $this->conexao->prepare($sql);
                $apartamento_id = $apartamento->getId();
                $morador_id = $morador->getId();
                $statement->bindParam(':APARTAMENTO', $apartamento_id);
                $statement->bindParam(':MORADOR', $morador_id);
                $statement->execute();

            } catch(PDOException $e) {
                echo $e->getMessage();
                return null;
            }
        }

        public function remove($id) {
            $sql = "DELETE FROM TB_MORADORES LEFT JOIN TB_APARTAMENTOS_MORADORES ON FK_ADM_MOR = PK_MOR LEFT JOIN TB_APARTAMENTOS ON PK_APA = FK_ADM_APA WHERE PK_APA = :ID";
            try {
                $statement = $this->conexao->prepare($sql);
                $statement->bindParam(':ID', $id); //Proteção contra sql injetct
                $statement->execute();
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    }