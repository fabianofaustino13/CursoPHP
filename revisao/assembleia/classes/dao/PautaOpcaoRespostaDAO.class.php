<?php

require_once(__DIR__ . "/./Conexao.class.php");
require_once(__DIR__ . "/../modelo/PautaOpcaoResposta.class.php");
require_once(__DIR__ . "/../modelo/Morador.class.php");
require_once(__DIR__ . "/../modelo/Pauta.class.php");
require_once(__DIR__ . "/../modelo/OpcaoResposta.class.php");
//require_once(__DIR__ . "/../classes/dao/OpcaoRespostaDAO.class.php");

    class PautaOpcaoRespostaDAO {

        private $conexao;

        function __construct() {
            $this->conexao = Conexao::get();
        }

        public function findAll() {
            $sql = "SELECT * FROM TB_PAUTAS_OPCOES_RESPOSTAS JOIN TB_OPCOES_RESPOSTAS ON PK_ODR=FK_POR_ODR JOIN TB_MORADORES ON PK_MOR=FK_POR_MOR JOIN TB_PAUTAS ON PK_PAU=FK_POR_PAU ORDER BY FK_POR_PAU ASC";
            $statement = $this->conexao->prepare($sql);
            $statement->execute();
            $rows = $statement->fetchAll();
            $pautaOpcaoRespostas = array();
            foreach ($rows as $row) {
                $pautaOpcaoResposta = new PautaOpcaoResposta();

                $morador = new Morador();
                $morador->setId($row['PK_MOR']);
                $morador->setNome($row['MOR_NOME']);
                $morador->setCpf($row['MOR_CPF']);
                $pautaOpcaoResposta->setMorador($morador);
                
                $pauta = new Pauta();
                $pauta->setId($row['PK_PAU']);
                $pauta->setNome($row['PAU_NOME']);
                $pauta->setDescricao($row['PAU_DESCRICAO']);
                $pautaOpcaoResposta->setPauta($pauta);

                $opcaoResposta = new OpcaoResposta();
                $opcaoResposta->setId($row['PK_ODR']);
                $opcaoResposta->setNome($row['ODR_NOME']);
                $pautaOpcaoResposta->setOpcaoResposta($opcaoResposta);
              
                array_push($pautaOpcaoRespostas, $pautaOpcaoResposta);
            }
            return $pautaOpcaoRespostas;
        }

        public function findPorPauta() {
            $sql = "SELECT DISTINCT PK_PAU, PAU_NOME FROM TB_PAUTAS_OPCOES_RESPOSTAS JOIN TB_OPCOES_RESPOSTAS ON PK_ODR=FK_POR_ODR JOIN TB_MORADORES ON PK_MOR=FK_POR_MOR JOIN TB_PAUTAS ON PK_PAU=FK_POR_PAU ORDER BY FK_POR_PAU ASC";
            $statement = $this->conexao->prepare($sql);
            $statement->execute();
            $rows = $statement->fetchAll();
            $pautaOpcaoRespostas = array();
            foreach ($rows as $row) {
                $pautaOpcaoResposta = new PautaOpcaoResposta();
                
                $pauta = new Pauta();
                $pauta->setId($row['PK_PAU']);
                $pauta->setNome($row['PAU_NOME']);
                $pautaOpcaoResposta->setPauta($pauta);
              
                array_push($pautaOpcaoRespostas, $pautaOpcaoResposta);
            }
            return $pautaOpcaoRespostas;
        }

        public function somaSim($id) {
            $sql = "SELECT * FROM TB_PAUTAS_OPCOES_RESPOSTAS JOIN TB_OPCOES_RESPOSTAS ON PK_ODR=FK_POR_ODR JOIN TB_MORADORES ON PK_MOR=FK_POR_MOR JOIN TB_PAUTAS ON PK_PAU=FK_POR_PAU WHERE PK_PAU=:ID AND PK_ODR=1";
            $statement = $this->conexao->prepare($sql);
            $statement->bindParam(':ID', $id);
            $statement->execute();
            $resultado = $statement->fetchAll();
            $count = count($resultado); 
            
            return $count;
        }
        
        public function somaNao($id) {
            $sql = "SELECT * FROM TB_PAUTAS_OPCOES_RESPOSTAS JOIN TB_OPCOES_RESPOSTAS ON PK_ODR=FK_POR_ODR JOIN TB_MORADORES ON PK_MOR=FK_POR_MOR JOIN TB_PAUTAS ON PK_PAU=FK_POR_PAU WHERE PK_PAU=:ID AND PK_ODR=2";
            $statement = $this->conexao->prepare($sql);
            $statement->bindParam(':ID', $id);
            $statement->execute();
            $resultado = $statement->fetchAll();
            $count = count($resultado); 
            
            return $count;
        }
        
        public function somaAbstencao($id) {
            $sql = "SELECT * FROM TB_PAUTAS_OPCOES_RESPOSTAS JOIN TB_OPCOES_RESPOSTAS ON PK_ODR=FK_POR_ODR JOIN TB_MORADORES ON PK_MOR=FK_POR_MOR JOIN TB_PAUTAS ON PK_PAU=FK_POR_PAU WHERE PK_PAU=:ID AND PK_ODR=3";
            $statement = $this->conexao->prepare($sql);
            $statement->bindParam(':ID', $id);
            $statement->execute();
            $resultado = $statement->fetchAll();
            $count = count($resultado); 
            
            return $count;
        }

        public function findById($id) {
            $sql = "SELECT * FROM TB_OPCOES_RESPOSTAS WHERE PK_ODR=:ID";
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

        public function save(PautaOpcaoResposta $pautaOpcaoResposta) {
            if (!is_null($pautaOpcaoResposta->getPauta()->getId())) {
                return $this->insert($pautaOpcaoResposta);
            } else {
                return $this->update($pautaOpcaoResposta);
            }
        }

        private function insert(PautaOpcaoResposta $pautaOpcaoResposta) {
            $sql = "INSERT INTO TB_PAUTAS_OPCOES_RESPOSTAS (FK_POR_MOR, FK_POR_PAU, FK_POR_ODR) VALUES (:MORADOR, :PAUTA, :RESPOSTA)";
            try {
                $statement = $this->conexao->prepare($sql);
                $morador = $pautaOpcaoResposta->getMorador()->getId();
                $pauta = $pautaOpcaoResposta->getPauta()->getId();
                $resposta = $pautaOpcaoResposta->getOpcaoResposta()->getId();
                $statement->bindParam(':MORADOR', $morador);
                $statement->bindParam(':PAUTA', $pauta);
                $statement->bindParam(':RESPOSTA', $resposta);
                $statement->execute();                
                //return $this->findById($this->conexao->lastInsertId());
                return 1;
            } catch(PDOException $e) {
                echo $e->getMessage();
                //return null;
                return 5;
            }
        }

        private function update(PautaOpcaoResposta $pautaOpcaoResposta) {
            $sql = "UPDATE TB_PAUTAS_OPCOES_RESPOSTAS SET FK_POR_MOR=:MORADOR, FK_POR_PAU=:PAUTA, FK_POR_ODR=:RESPOSTA WHERE FK_POR_PAU=:ID";
            try {
                $statement = $this->conexao->prepare($sql);
                $morador = $pautaOpcaoResposta->getMorador()->getId();
                $pauta = $pautaOpcaoResposta->getPauta()->getId();
                $resposta = $pautaOpcaoResposta->getOpcaoResposta()->getId();
                $id = $pautaOpcaoResposta->getPauta()->getId();
                $statement->bindParam(':MORADOR', $morador);
                $statement->bindParam(':PAUTA', $pauta);
                $statement->bindParam(':RESPOSTA', $resposta);
                $statement->bindParam(':ID', $id);
                $statement->execute();
                //return $this->findById($this->conexao->lastInsertId());
                return 2;
            } catch(PDOException $e) {
                echo $e->getMessage();
                //return null;
                return 6;
            }
        }

        public function remove($id) {
            $sql = "DELETE FROM TB_PAUTA_OPCOES_RESPOSTAS WHERE FK_POR_PAU=:ID";
            try {
                $statement = $this->conexao->prepare($sql);
                $statement->bindParam(':ID', $id);
                $statement->execute();
                return $this->findById($this->conexao->lastInsertId());
            } catch(PDOException $e) {
                echo $e->getMessage();
                return null;
            }
        }
    }