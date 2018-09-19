<?php

require_once (__DIR__ . "/./Conexao.class.php");
require_once __DIR__ . "/../modelo/Pauta.class.php";
require_once (__DIR__ . "/../modelo/Assembleia.class.php");
require_once (__DIR__ . "/../modelo/TipoAssembleia.class.php");

    class PautaDAO {

        private $conexao;

        function __construct() {
            $this->conexao = Conexao::get();
        }

        public function findAll() {
            $sql = "SELECT * FROM TB_PAUTAS JOIN TB_ASSEMBLEIAS ON PK_ASS = FK_PAU_ASS ORDER BY PK_PAU DESC";
            $statement = $this->conexao->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll();
            $pautas = array();
            foreach ($result as $row) {
                $assembleia = new Assembleia();
                $assembleia->setId($row['PK_ASS']);
                $assembleia->setNome($row['ASS_NOME']);
                $assembleia->setData($row['ASS_DATA']);
                $pauta = new Pauta();
                $pauta->setId($row['PK_PAU']);
                $pauta->setNome($row['PAU_NOME']);
                $pauta->setDescricao($row['PAU_DESCRICAO']);
                $pauta->setStatus($row['PAU_STATUS']);
                $pauta->setVoto($row['PAU_VOTOS']);
                $pauta->setAssembleia($assembleia);

                array_push($pautas, $pauta);
            }
            return $pautas;
        }

        public function findAllAssembleia($assembleia) {
            $sql = "SELECT * FROM TB_PAUTAS JOIN TB_ASSEMBLEIAS ON PK_ASS = FK_PAU_ASS WHERE FK_PAU_ASS = :ASSEMBLEIA";
            $statement = $this->conexao->prepare($sql);
            $statement->bindParam(':ASSEMBLEIA', $assembleia);
            $statement->execute();
            $result = $statement->fetchAll();
            $pautas = array();
            foreach ($result as $row) {
                $assembleia = new Assembleia();
                $assembleia->setId($row['PK_ASS']);
                $assembleia->setNome($row['ASS_NOME']);
                $assembleia->setData($row['ASS_DATA']);
                $pauta = new Pauta();
                $pauta->setId($row['PK_PAU']);
                $pauta->setNome($row['PAU_NOME']);
                $pauta->setDescricao($row['PAU_DESCRICAO']);
                $pauta->setStatus($row['PAU_STATUS']);
                $pauta->setVoto($row['PAU_VOTOS']);
                $pauta->setAssembleia($assembleia);

                array_push($pautas, $pauta);
            }
            return $pautas;
        }

        public function findById($id) {
            $sql = "SELECT * FROM TB_PAUTAS JOIN TB_ASSEMBLEIAS ON PK_ASS = FK_PAU_ASS WHERE PK_PAU = :ID";
            $statement = $this->conexao->prepare($sql);
            $statement->bindParam(':ID', $id);
            $statement->execute();
            $result = $statement->fetchAll();
            $assembleia = new Assembleia();
            $pauta = new Pauta();
            foreach ($result as $row) {
                $assembleia->setId($row['PK_ASS']);
                $assembleia->setNome($row['ASS_NOME']);
                $assembleia->setData($row['ASS_DATA']);
                $pauta->setId($row['PK_PAU']);
                $pauta->setNome($row['PAU_NOME']);
                $pauta->setDescricao($row['PAU_DESCRICAO']);
                $pauta->setStatus($row['PAU_STATUS']);
                $pauta->setVoto($row['PAU_VOTOS']);
                $pauta->setAssembleia($assembleia);
            }
            return $pauta;
        }

        public function findByNome($nome) {
            $sql = "SELECT * FROM TB_PAUTAS JOIN TB_ASSEMBLEIAS ON PK_ASS = FK_PAU_ASS WHERE PAU_NOME = :NOME";
            $statement = $this->conexao->prepare($sql);
            $statement->bindParam(':NOME', $nome);
            $statement->execute();
            $result = $statement->fetchAll();
            $assembleia = new Assembleia();
            $pauta = new Pauta();
            foreach ($result as $row) {
                $assembleia->setId($row['PK_ASS']);
                $assembleia->setNome($row['ASS_NOME']);
                $assembleia->setData($row['ASS_DATA']);
                $pauta->setId($row['PK_PAU']);
                $pauta->setNome($row['PAU_NOME']);
                $pauta->setDescricao($row['PAU_DESCRICAO']);
                $pauta->setStatus($row['PAU_STATUS']);
                $pauta->setVoto($row['PAU_VOTOS']);
                $pauta->setAssembleia($assembleia);
            }
            return $pauta;
        }
        
        public function findPautaAssembleia(Assembleia $assembleia) {
            $sql = "SELECT * FROM TB_PAUTAS JOIN TB_ASSEMBLEIAS ON PK_ASS = FK_PAU_ASS WHERE PK_ASS = :ASSEMBLEIA";
            $statement = $this->conexao->prepare($sql);
            $id_assembleia = $assembleia->getId();
            $statement->bindParam(':ASSEMBLEIA', $id_assembleia);
            $statement->execute();
            $result = $statement->fetchAll();
            $pautas = array();
            foreach ($result as $row) {
                $assembleia = new Assembleia();
                $assembleia->setId($row['PK_ASS']);
                $assembleia->setNome($row['ASS_NOME']);
                $assembleia->setData($row['ASS_DATA']);
                $pauta = new Pauta();
                $pauta->setId($row['PK_PAU']);
                $pauta->setNome($row['PAU_NOME']);
                $pauta->setDescricao($row['PAU_DESCRICAO']);
                $pauta->setStatus($row['PAU_STATUS']);
                $pauta->setVoto($row['PAU_VOTOS']);
                $pauta->setAssembleia($assembleia);

                array_push($pautas, $pauta);
            }
            return $pautas;
        }

        public function save(Pauta $pauta) {
            if ($pauta->getId() == null) {
                $this->insert($pauta);
            } else {
                $this->update($pauta);
            }
        }

        private function insert(Pauta $pauta) {
            $sql = "INSERT INTO TB_PAUTAS (PAU_NOME, PAU_DESCRICAO, FK_PAU_ASS) VALUES (:NOME, :DESCRICAO, :ASSEMBLEIA)";
            try {
                $statement = $this->conexao->prepare($sql);
                $nome = $pauta->getNome();
                $descricao = $pauta->getDescricao();
                $assembleia = $pauta->getAssembleia()->getId();
                $statement->bindParam(':NOME', $nome);
                $statement->bindParam(':DESCRICAO', $descricao);
                $statement->bindParam(':ASSEMBLEIA', $assembleia);
                $statement->execute();
                return $this->findById($this->conexao->lastInsertId());
            } catch(PDOException $e) {
                echo $e->getMessage();
                return null;
            }
        }
        
        

        private function update(Pauta $pauta) {
            $sql = "UPDATE TB_PAUTAS SET PAU_NOME=:NOME, PAU_DESCRICAO=:DESCRICAO, FK_PAU_ASS=:ASSEMBLEIA WHERE PK_PAU=:ID";
            try {
                $statement = $this->conexao->prepare($sql);
                $nome = $pauta->getNome();
                $descricao = $pauta->getDescricao();
                $assembleia = $pauta->getAssembleia()->getId();
                $id = $pauta->getId();
                $statement->bindParam(':NOME', $nome);
                $statement->bindParam(':DESCRICAO', $descricao);
                $statement->bindParam(':ASSEMBLEIA', $assembleia);
                $statement->bindParam(':ID', $id);
                $statement->execute();
                return $this->findById($this->conexao->lastInsertId());
            } catch(PDOException $e) {
                echo $e->getMessage();
                return null;
            }
        }

        public function remove($id) {
            $sql = "DELETE FROM TB_PAUTAS WHERE PK_PAU = :ID";
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