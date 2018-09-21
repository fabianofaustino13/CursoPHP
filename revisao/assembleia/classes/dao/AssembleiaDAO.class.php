<?php

require_once (__DIR__ . "/./Conexao.class.php");
require_once (__DIR__ . "/../modelo/Assembleia.class.php");
require_once (__DIR__ . "/../modelo/TipoAssembleia.class.php");

    class AssembleiaDAO {
        
        private $conexao;

        function __construct() {
            $this->conexao = Conexao::get();
        }

        public function findAll() {
            $sql = "SELECT * FROM TB_ASSEMBLEIAS JOIN TB_TIPOS_ASSEMBLEIAS ON PK_TDA = FK_ASS_TDA ORDER BY ASS_DATA DESC";
            $statement = $this->conexao->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll();
            $assembleias = array();
            foreach ($result as $row) {
                $tipo = new TipoAssembleia();
                $tipo->setId($row['PK_TDA']);
                $tipo->setNome($row['TDA_NOME']);
                $assembleia = new Assembleia();
                $assembleia->setId($row['PK_ASS']);
                $assembleia->setNome($row['ASS_NOME']);
                $assembleia->setData($row['ASS_DATA']);
                $assembleia->setTipoAssembleia($tipo);
                array_push($assembleias, $assembleia);
            }
            return $assembleias;
        }

        public function findById($id) {
            $sql = "SELECT * FROM TB_ASSEMBLEIAS JOIN TB_TIPOS_ASSEMBLEIAS ON PK_TDA = FK_ASS_TDA WHERE PK_ASS = :ID";
            $statement = $this->conexao->prepare($sql);
            $statement->bindParam(':ID', $id); //Proteção contra sql injetct
            $statement->execute();
            $row = $statement->fetch();
            $tipo = new TipoAssembleia();
            $tipo->setId($row['PK_TDA']);
            $tipo->setNome($row['TDA_NOME']);

            $assembleia = new Assembleia();
            $assembleia->setId($row['PK_ASS']);
            $assembleia->setNome($row['ASS_NOME']);
            $assembleia->setData($row['ASS_DATA']);
            $assembleia->setTipoAssembleia($tipo);
                        
            return $assembleia;
        }

        public function findByNome($nome) {
            $sql = "SELECT * FROM TB_ASSEMBLEIAS WHERE ASS_NOME = :NOME";
            $statement = $this->conexao->prepare($sql);
            $statement->bindParam(':NOME', $nome); //Proteção contra sql injetct
            $statement->execute();
            $result = $statement->fetchAll();
            $assembleia = new Assembleia();
            foreach ($result as $row) {
                $assembleia->setId($row['PK_ASS']);
                $assembleia->setNome($row['ASS_NOME']);
                $assembleia->setData($row['ASS_DATA']);
                $assembleia->setTipoAssembleia($row['FK_ASS_TDA']);
            }
            return $assembleia;
        }

        public function save(Assembleia $assembleia) {
            if (is_null($assembleia->getId())) {
                return $this->insert($assembleia);
            } else {
                return $this->update($assembleia);
            }
        }

        private function insert(Assembleia $assembleia) {
            $sql = "INSERT INTO TB_ASSEMBLEIAS (ASS_NOME, ASS_DATA, FK_ASS_TDA) VALUES (:NOME, :DATA_ASSEMBLEIA, :TIPO_ASSEMBLEIA)";
            try {
                $statement = $this->conexao->prepare($sql);
                $nome = $assembleia->getNome();
                $data = $assembleia->getData();
                $tipo = $assembleia->getTipoAssembleia()->getId();
                $statement->bindParam(':NOME', $nome);
                $statement->bindParam(':DATA_ASSEMBLEIA', $data);
                $statement->bindParam(':TIPO_ASSEMBLEIA', $tipo);
                $statement->execute();
                //return $this->findById($this->conexao->lastInsertId());
                return 0;
            } catch(PDOException $e) {
                //echo $e->getMessage();
                $codigoErro = $e->errorInfo[1]; //Pega o código de entrada duplicada
                $mensagemErro = $e->errorInfo[2]; //Pega a mensagem do erro
                $code = $e->getCode();
                //print_r(explode(" ",$mensagemErro));
                //$erro1048 = explode(" ",$mensagemErro);
                
                if ($codigoErro == 1062) { //1062 - Entrada duplicada
                    //$mensagem = strstr($e->getMessage(),'UK');
                    $erro1062 = explode(" ",$mensagemErro);
                    //echo $erro1062[5];
                    if ($erro1062[5] == "'UK_ASS_DATA'") {
                        return 1; //Data duplicado
                    }
                }
                if ($codigoErro == 1048) { //1048 - Entrada null
                    $erro1048 = explode(" ",$mensagemErro);
                    //echo $erro1048[1];
                    if ($erro1048[1] == "'FK_ASS_TDA'") { //Tipo de Assembléia null
                        return 2;
                    }
                }
            }         
        }

        private function update(Assembleia $assembleia) {
            $sql = "UPDATE TB_ASSEMBLEIAS SET ASS_NOME = :NOME, ASS_DATA = :DATAASSEMBLEIA, FK_ASS_TDA = :TIPOASSEMBLEIA WHERE PK_ASS = :ID";
            try {
                $statement = $this->conexao->prepare($sql);
                $nome = $assembleia->getNome();
                $data = $assembleia->getData();
                $tipo = $assembleia->getTipoAssembleia()->getId();
                $id = $assembleia->getId();
                $statement->bindParam(':NOME', $nome);
                $statement->bindParam(':DATAASSEMBLEIA', $data);
                $statement->bindParam(':TIPOASSEMBLEIA', $tipo);
                $statement->bindParam(':ID', $id);
                $statement->execute();
                //return $this->findById($this->conexao->lastInsertId());
            // } catch(PDOException $e) {
            //     echo $e->getMessage();
            //     //return null;
            // }
                return 0;
            } catch(PDOException $e) {
                //echo $e->getMessage();
                $codigoErro = $e->errorInfo[1]; //Pega o código de entrada duplicada
                $mensagemErro = $e->errorInfo[2]; //Pega a mensagem do erro
                $code = $e->getCode();
                //print_r(explode(" ",$mensagemErro));
                //$erro1048 = explode(" ",$mensagemErro);
                
                if ($codigoErro == 1062) { //1062 - Entrada duplicada
                    //$mensagem = strstr($e->getMessage(),'UK');
                    $erro1062 = explode(" ",$mensagemErro);
                    //echo $erro1062[5];
                    if ($erro1062[5] == "'UK_ASS_DATA'") {
                        return 1; //Data duplicado
                    }
                }
                if ($codigoErro == 1048) { //1048 - Entrada null
                    $erro1048 = explode(" ",$mensagemErro);
                    //echo $erro1048[1];
                    if ($erro1048[1] == "'FK_ASS_TDA'") { //Tipo de Assembléia null
                        return 2;
                    }
                }
                   
            }         
        }

        public function remove($id) {
            $sql = "DELETE FROM TB_ASSEMBLEIAS WHERE PK_ASS = :ID";
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