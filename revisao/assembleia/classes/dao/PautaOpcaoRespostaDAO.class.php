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

        public function somaSim($id) {
            $sql = "SELECT COUNT(*) FROM TB_PAUTAS_OPCOES_RESPOSTAS JOIN TB_OPCOES_RESPOSTAS ON PK_ODR=FK_POR_ODR JOIN TB_MORADORES ON PK_MOR=FK_POR_MOR JOIN TB_PAUTAS ON PK_PAU=FK_POR_PAU WHERE PK_PAU=$id AND PK_ODR=1";
           
            return $sql;
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
                $statement->bindParam(':ID', $id);
                $statement->execute();
                return $this->findById($this->conexao->lastInsertId());
            } catch(PDOException $e) {
                echo $e->getMessage();
                return null;
            }
        }
    }