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
            $sql = "SELECT * FROM TB_MORADORES JOIN TB_PERFIS ON PK_PER = FK_MOR_PER ORDER BY PK_MOR DESC";
            $statement = $this->conexao->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll();
            $moradores = array();
            foreach ($result as $row) {
                $perfil = new Perfil();
                $perfil->setId($row['PK_PER']);
                $perfil->setNome($row['PER_NOME']);
                $morador = new Morador();
                $morador->setId($row['PK_MOR']);
                $morador->setNome($row['MOR_NOME']);
                $morador->setCpf($row['MOR_CPF']);
                $morador->setLogin($row['MOR_LOGIN']);
                $morador->setSenha($row['MOR_SENHA']);
                $morador->setStatus($row['MOR_STATUS']);
                $morador->setPerfil($perfil);

                array_push($moradores, $morador);
            }
            return $moradores;
        }

        public function findById(Morador $id) {
            $sql = "SELECT * FROM TB_MORADORES LEFT JOIN TB_PERFIS ON PK_PER = FK_MOR_PER WHERE PK_MOR = :id";
            $statement = $this->conexao->prepare($sql);
            $mor_id = $id->getId();
            $statement->bindParam(":id", $mor_id);
            $statement->execute();
            $row = $statement->fetch();
            $perfil = new Perfil();
            $perfil->setId($row['PK_PER']);
            $perfil->setNome($row['PER_NOME']);
            $morador = new Morador();
            $morador->setId($row['PK_MOR']);
            $morador->setNome($row['MOR_NOME']);
            $morador->setCpf($row['MOR_CPF']);
            $morador->setLogin($row['MOR_LOGIN']);
            $morador->setSenha($row['MOR_SENHA']);
            $morador->setStatus($row['MOR_STATUS']);
            $morador->setPerfil($perfil);

            return $morador;
        }

        public function findByApartamento($id) {
            $sql = "SELECT * FROM TB_MORADORES LEFT JOIN TB_APARTAMENTOS_MORADORES ON FK_ADM_MOR = PK_MOR LEFT JOIN TB_APARTAMENTOS ON PK_APA = FK_ADM_APA WHERE PK_APA = :ID";
            $statement = $this->conexao->prepare($sql);
            $statement->bindParam(':ID', $id); //Proteção contra sql injetct
            $statement->execute();
            $row = $statement->fetch();
            $apartamento = new Apartamento();
            $apartamento->setId($row['PK_APA']);
            $apartamento->setNome($row['APA_NOME']);
            $morador = new Morador();
            $morador->setId($row['PK_MOR']);
            $morador->setNome($row['MOR_NOME']);
            $morador->setCpf($row['MOR_CPF']);
            $morador->setLogin($row['MOR_LOGIN']);
            $morador->setSenha($row['MOR_SENHA']);
            $morador->setStatus($row['MOR_STATUS']);
            
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
                $morador->setCpf($row['MOR_CPF']);
                $morador->setLogin($row['MOR_LOGIN']);
                $morador->setSenha($row['MOR_SENHA']);
                $morador->setStatus($row['MOR_STATUS']);
            }
            return $morador;
        }

        public function findByLogin($login) {
            $sql = "SELECT * FROM TB_MORADORES JOIN TB_PERFIS ON PK_PER = FK_MOR_PER WHERE MOR_LOGIN = :USERNAME";
            $statement = $this->conexao->prepare($sql);
            $statement->bindParam(':USERNAME', $login); //Proteção contra sql injetct
            $statement->execute();
            $result = $statement->fetchAll();
            $perfil = new Perfil();
            $morador = new Morador();
            foreach ($result as $row) {
                $perfil->setId($row['PK_PER']);
                $perfil->setNome($row['PER_NOME']);

                $morador->setId($row['PK_MOR']);
                $morador->setNome($row['MOR_NOME']);
                $morador->setCpf($row['MOR_CPF']);
                $morador->setLogin($row['MOR_LOGIN']);
                $morador->setSenha($row['MOR_SENHA']);
                $morador->setStatus($row['MOR_STATUS']);
                $morador->setPerfil($perfil);
            }
            return $morador;
        }

        public function findCpf($cpf) {
            $sql = "SELECT * FROM TB_MORADORES WHERE MOR_CPF = :CPF";
            $statement = $this->conexao->prepare($sql);
           // $cpf = $morador->getCpf();
            $statement->bindParam(':CPF', $cpf); //Proteção contra sql injetct
            $statement->execute();
            $row = $statement->fetch();;
            
            $morador = new Morador();
            $morador->setId($row['PK_MOR']);
            $morador->setNome($row['MOR_NOME']);
            $morador->setCpf($row['MOR_CPF']);
            $morador->setLogin($row['MOR_LOGIN']);
            $morador->setSenha($row['MOR_SENHA']);
            $morador->setStatus($row['MOR_STATUS']);
                  
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
                $morador->setCpf($row['MOR_CPF']);
                $morador->setLogin($row['MOR_LOGIN']);
                $morador->setSenha($row['MOR_SENHA']);
                $morador->setStatus($row['MOR_STATUS']);
                $sindico = new Sindico();
                $sindico->setId($row['PK_SIN']);
                $sindico->setMorador($morador);
              
                array_push($sindicos, $morador);
            }
            return $sindicos;
        }

        public function save(Morador $morador, Apartamento $apartamento) {
            if (is_null($morador->getId())) {
                return $this->insert($morador, $apartamento);
            } else {
                return $this->update($morador, $apartamento);
            }
            // if ($morador->getId() == null) {
            //     $this->insert($morador);
            // } else {
            //     $this->update($morador);
            // }
        }

        public function insert(Morador $morador, Apartamento $apartamento) {
            $sql = "INSERT INTO TB_MORADORES (MOR_NOME, MOR_CPF, MOR_LOGIN, MOR_SENHA, MOR_STATUS, FK_MOR_PER) VALUES (:NOME, :CPF, :USERNAME, :SENHA, :STATUS_SINDICO, :PERFIL)";
            try {
                $statement = $this->conexao->prepare($sql);
                $nome = $morador->getNome();
                $cpf = $morador->getCpf();
                $username = $morador->getLogin();
                $senha = $morador->getSenha();
                $status_sindico = $morador->getStatus();
                $perfil = $morador->getPerfil()->getId();
                $statement->bindParam(':NOME', $nome);
                $statement->bindParam(':USERNAME', $username);
                $statement->bindParam(':CPF', $cpf);
                $statement->bindParam(':SENHA', $senha);
                $statement->bindParam(':STATUS_SINDICO', $status_sindico);
                $statement->bindParam(':PERFIL', $perfil);
                $statement->execute();
                $morador->setId($this->conexao->lastInsertId());
                
                $sql = "INSERT INTO TB_APARTAMENTOS_MORADORES (FK_ADM_APA, FK_ADM_MOR) VALUES (:APARTAMENTO, :MORADOR)";
                $statement = $this->conexao->prepare($sql);
                $apartamento_id = $apartamento->getId();
                $morador_id = $morador->getId();
                $statement->bindParam(':APARTAMENTO', $apartamento_id);
                $statement->bindParam(':MORADOR', $morador_id);
                $statement->execute();

                if($status_sindico == 1) {
                    $sql = "INSERT INTO TB_SINDICOS (FK_SIN_MOR) VALUES (:SINDICO)";
                    $statement = $this->conexao->prepare($sql);
                    $sindico = $morador->getId();
                    $statement->bindParam(':SINDICO', $sindico);
                    $statement->execute();
                }
                
                // return $this->findById($this->conexao->lastInsertId());
                // return $this->findById($morador->getId());
                return $this->findById($this->conexao->lastInsertId());
            } catch(PDOException $e) {
                echo $e->getMessage();
                return null;
            }
        }

        private function update(Morador $morador, Apartamento $apartamento) {
            $sql = "UPDATE TB_MORADORES SET MOR_NOME=:NOME, MOR_CPF=:CPF, MOR_LOGIN=:USERNAME, MOR_SENHA=:SENHA, MOR_STATUS=:STATUS_SINDICO, FK_MOR_PER=:PERFIL WHERE PK_MOR = :ID";
            try {
                $statement = $this->conexao->prepare($sql);
                $nome = $morador->getNome();
                $cpf = $morador->getCpf();
                $username = $morador->getLogin();
                $senha = $morador->getSenha();
                $status_sindico = $morador->getStatus();
                $perfil = $morador->getPerfil()->getId();
                $id = $morador->getId();
                $statement->bindParam(':NOME', $nome);
                $statement->bindParam(':CPF', $cpf);
                $statement->bindParam(':USERNAME', $username);
                $statement->bindParam(':SENHA', $senha);
                $statement->bindParam(':STATUS_SINDICO', $status_sindico);
                $statement->bindParam(':PERFIL', $perfil);
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

                if($status_sindico == 1) {
                    $sql = "INSERT INTO TB_SINDICOS (FK_SIN_MOR) VALUES (:SINDICO)";
                    $statement = $this->conexao->prepare($sql);
                    $sindico = $morador->getId();
                    $statement->bindParam(':SINDICO', $sindico);
                    $statement->execute();
                }

                return $this->findById($morador->getId());

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