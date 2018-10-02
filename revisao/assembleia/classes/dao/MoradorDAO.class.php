<?php

require_once(__DIR__ . "/./Conexao.class.php");
require_once(__DIR__ . "/../modelo/Morador.class.php");
require_once(__DIR__ . "/../modelo/Apartamento.class.php");
require_once(__DIR__ . "/../modelo/Bloco.class.php");
require_once(__DIR__ . "/../modelo/Situacao.class.php");

    class MoradorDAO {

        private $conexao;

        function __construct() {
            $this->conexao = Conexao::get();
        }

        public function findAll() {
            // $sql = "SELECT * FROM TB_MORADORES JOIN TB_PERFIS ON PK_PER = FK_MOR_PER JOIN TB_APARTAMENTOS ON PK_APA = FK_MOR_APA JOIN TB_BLOCOS ON PK_BLO = FK_APA_BLO ORDER BY PK_MOR DESC";
            $sql = "SELECT * FROM TB_MORADORES JOIN TB_PERFIS ON PK_PER = FK_MOR_PER JOIN TB_SITUACAO ON PK_SIT=FK_MOR_SIT ORDER BY PK_MOR DESC";
            $statement = $this->conexao->prepare($sql);
            $statement->execute();
            $rows = $statement->fetchAll();
            $moradores = array();
            foreach ($rows as $row) {
                $perfil = new Perfil();
                $perfil->setId($row['PK_PER']);
                $perfil->setNome($row['PER_NOME']);
                // $bloco = new bloco();
                // $bloco->setId($row['PK_BLO']);
                // $bloco->setNome($row['BLO_NOME']);
                // $bloco->setApelido($row['BLO_APELIDO']);
                // $apartamento = new Apartamento();
                // $apartamento->setId($row['PK_APA']);
                // $apartamento->setNome($row['APA_NOME']);
                // $apartamento->setBloco($bloco);
                $situacao = new Situacao();
                $situacao->setId($row['PK_SIT']);
                $situacao->setNome($row['SIT_NOME']);
                $morador = new Morador();
                $morador->setId($row['PK_MOR']);
                $morador->setNome($row['MOR_NOME']);
                $morador->setCpf($row['MOR_CPF']);
                $morador->setLogin($row['MOR_LOGIN']);
                $morador->setSenha($row['MOR_SENHA']);
                $morador->setSituacao($situacao);
                // $morador->setApartamento($apartamento);
                $morador->setPerfil($perfil);

                array_push($moradores, $morador);
            }
            return $moradores;
        }

        public function findById($id) {
            $sql = "SELECT * FROM TB_MORADORES LEFT JOIN TB_PERFIS ON PK_PER=FK_MOR_PER JOIN TB_SITUACAO ON PK_SIT=FK_MOR_SIT WHERE PK_MOR = :ID";
            $statement = $this->conexao->prepare($sql);
            $statement->bindParam(':ID', $id); //Proteção contra sql injetct
            $statement->execute();
            $row = $statement->fetch();
            $perfil = new Perfil();
            $perfil->setId($row['PK_PER']);
            $perfil->setNome($row['PER_NOME']);
            $situacao = new Situacao();
            $situacao->setId($row['PK_SIT']);
            $situacao->setNome($row['SIT_NOME']);
            $morador = new Morador();
            $morador->setId($row['PK_MOR']);
            $morador->setNome($row['MOR_NOME']);
            $morador->setCpf($row['MOR_CPF']);
            $morador->setLogin($row['MOR_LOGIN']);
            $morador->setSenha($row['MOR_SENHA']);
            $morador->setSituacao($situacao);
            $morador->setPerfil($perfil);

            return $morador;
        }

        public function findByApartamento($id) {
            // $sql = "SELECT * FROM TB_MORADORES LEFT JOIN TB_APARTAMENTOS_MORADORES ON FK_ADM_MOR = PK_MOR LEFT JOIN TB_APARTAMENTOS ON PK_APA = FK_ADM_APA LEFT JOIN TB_BLOCOS ON PK_BLO = FK_APA_BLO WHERE PK_MOR = :ID";
            $sql = "SELECT * FROM TB_MORADORES WHERE PK_MOR = :ID";
            $statement = $this->conexao->prepare($sql);
            $statement->bindParam(':ID', $id); //Proteção contra sql injetct
            $statement->execute();
            $row = $statement->fetch();
            // $bloco = new Bloco();
            // $bloco->setId($row['PK_BLO']);
            // $bloco->setNome($row['BLO_NOME']);
            // $bloco->setApelido($row['BLO_APELIDO']);
            // $apartamento = new Apartamento();
            // $apartamento->setId($row['PK_APA']);
            // $apartamento->setNome($row['APA_NOME']);
            // $apartamento->setBloco($bloco);
            $morador->setId($row['PK_MOR']);
            $morador->setNome($row['MOR_NOME']);
            $morador->setCpf($row['MOR_CPF']);
            $morador->setLogin($row['MOR_LOGIN']);
            $morador->setSenha($row['MOR_SENHA']);
            
            return $morador;
        }

        public function findMoradoresApartamentosAll() {
            $sql = "SELECT DISTINCT PK_MOR, MOR_NOME, MOR_CPF, MOR_LOGIN, MOR_SENHA, MOR_STATUS, PK_APA, APA_NOME, PK_BLO, BLO_NOME, BLO_APELIDO FROM TB_MORADORES LEFT JOIN TB_APARTAMENTOS_MORADORES ON FK_ADM_MOR = PK_MOR LEFT JOIN TB_APARTAMENTOS ON PK_APA = FK_ADM_APA LEFT JOIN TB_BLOCOS ON PK_BLO = FK_APA_BLO";
            $statement = $this->conexao->prepare($sql);
            $statement->execute();
            $rows = $statement->fetchAll();
            $moradores = array();
            foreach ($rows as $row) {
                $bloco = new Bloco();
                $bloco->setId($row['PK_BLO']);
                $bloco->setNome($row['BLO_NOME']);
                $bloco->setApelido($row['BLO_APELIDO']);
                $apartamento = new Apartamento();
                $apartamento->setId($row['PK_APA']);
                $apartamento->setNome($row['APA_NOME']);
                $apartamento->setBloco($bloco);
                $morador = new Morador();
                $morador->setId($row['PK_MOR']);
                $morador->setNome($row['MOR_NOME']);
                $morador->setCpf($row['MOR_CPF']);
                $morador->setLogin($row['MOR_LOGIN']);
                $morador->setSenha($row['MOR_SENHA']);
                array_push($moradores, $morador);
            }
            return $moradores;
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
            }
            return $morador;
        }

        public function findByLogin($login) {
            $sql = "SELECT * FROM TB_MORADORES JOIN TB_PERFIS ON PK_PER=FK_MOR_PER JOIN TB_SITUACAO ON PK_SIT=FK_MOR_SIT WHERE MOR_LOGIN = :USERNAME";
            $statement = $this->conexao->prepare($sql);
            $statement->bindParam(':USERNAME', $login); //Proteção contra sql injetct
            $statement->execute();
            $result = $statement->fetchAll();
            $perfil = new Perfil();
            $situacao = new Situacao();
            $morador = new Morador();
            foreach ($result as $row) {
                $perfil->setId($row['PK_PER']);
                $perfil->setNome($row['PER_NOME']);

                $situacao->setId($row['PK_SIT']);
                $situacao->setNome($row['SIT_NOME']);

                $morador->setId($row['PK_MOR']);
                $morador->setNome($row['MOR_NOME']);
                $morador->setCpf($row['MOR_CPF']);
                $morador->setLogin($row['MOR_LOGIN']);
                $morador->setSenha($row['MOR_SENHA']);
                $morador->setSituacao($situacao);
                $morador->setPerfil($perfil);
            }
            return $morador;
        }

        public function findCpf($cpf) {
            try {
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
                      
                return $morador;

            }catch(PDOException $e) {
                echo $e->getMessage();
                return null;
            }
        }          

        public function save(Morador $morador) {
            if (is_null($morador->getId())) {
                return $this->insert($morador);
            } else {
                return $this->update($morador);
            }          
        }

        private function insert(Morador $morador) {
            $sql = "INSERT INTO TB_MORADORES (MOR_NOME, MOR_CPF, MOR_LOGIN, MOR_SENHA, FK_MOR_SITUACAO, FK_MOR_PER) VALUES (:NOME, :CPF, :USERNAME, :SENHA, :SITUACAO, :PERFIL)";
            try {
                $statement = $this->conexao->prepare($sql);
                $nome = $morador->getNome();
                $cpf = $morador->getCpf();
                $username = $morador->getLogin();
                $senha = $morador->getSenha();
                $situacao = $morador->getSituacao()->getId();
                $perfil = $morador->getPerfil()->getId();
                $statement->bindParam(':NOME', $nome);
                $statement->bindParam(':USERNAME', $username);
                $statement->bindParam(':CPF', $cpf);
                $statement->bindParam(':SENHA', $senha);
                $statement->bindParam(':SITUACAO', $situacao);
                $statement->bindParam(':PERFIL', $perfil);
                // $statement->bindParam(':APARTAMENTO', $apartamento);
                $statement->execute();
                return $this->findById($this->conexao->lastInsertId());
                
                // $sql = "INSERT INTO TB_APARTAMENTOS_MORADORES (FK_ADM_APA, FK_ADM_MOR) VALUES (:APARTAMENTO, :MORADOR)";
                // $statement = $this->conexao->prepare($sql);
                // $apartamento_id = $apartamento->getId();
                // $morador_id = $morador->getId();
                // $statement->bindParam(':APARTAMENTO', $apartamento_id);
                // $statement->bindParam(':MORADOR', $morador_id);
                // $statement->execute();

                // if($sindico == 1) {
                //     $sql = "INSERT INTO TB_SINDICOS (FK_SIN_MOR) VALUES (:SINDICO)";
                //     $statement = $this->conexao->prepare($sql);
                //     $sindico = $morador->getId();
                //     $statement->bindParam(':SINDICO', $sindico);
                //     $statement->execute();
                // }
                
                // return $this->findById($this->conexao->lastInsertId());
                // return $this->findById($morador->getId());
                //return $this->findById($this->conexao->lastInsertId());
                //return 0;
            } catch(PDOException $e) {
               // echo $e->getMessage();
                $codigoErro = $e->errorInfo[1]; //Pega o código de entrada duplicada
                $mensagemErro = $e->errorInfo[2]; //Pega a mensagem do erro
                $code = $e->getCode();
                // print_r(explode(" ",$mensagemErro));
                // $erro1048 = explode(" ",$mensagemErro);
                // echo $erro1048[1];
                //print_r(explode(" ",$mensagemErro));
                //return $mensagem;
                if ($codigoErro == 1062) {
                    $erro1062 = explode(" ",$mensagemErro);
                    //echo $erro1062[5];
                    if ($erro1062[5] == "'UK_MOR_CPF'") {
                        return 2; //Cpf duplicado
                    }else if ($erro1062[5] == "'UK_MOR_LOGIN'") {
                        return 3; //Login duplicado
                    }
                } else if ($codigoErro == 1048) {
                    $erro1048 = explode(" ",$mensagemErro);
                    if ($erro1048[1] == "'MOR_SENHA'") {
                        return 4; //Senha NULL
                    }
                }
            }
        }
        private function update(Morador $morador) {
            $sql = "UPDATE TB_MORADORES SET MOR_NOME=:NOME, MOR_CPF=:CPF, MOR_LOGIN=:USERNAME, MOR_SENHA=:SENHA, FK_MOR_SIT=:SITUACAO, FK_MOR_PER=:PERFIL WHERE PK_MOR = :ID";
            try {
                // echo "<pre>";                
                //     var_dump($morador);
                // //    var_dump($apartamento);                
                // echo "</pre>";
                $statement = $this->conexao->prepare($sql);
                $nome = $morador->getNome();
                $cpf = $morador->getCpf();
                $username = $morador->getLogin();
                $senha = $morador->getSenha();
                $situacao = $morador->getSituacao()->getId();
                $perfil = $morador->getPerfil()->getId();
                //$apartamento = $morador->getApartamento()->getId();
                $id = $morador->getId();
                $statement->bindParam(':NOME', $nome);
                $statement->bindParam(':CPF', $cpf);
                $statement->bindParam(':USERNAME', $username);
                $statement->bindParam(':SENHA', $senha);
                $statement->bindParam(':SITUACAO', $situacao);
                $statement->bindParam(':PERFIL', $perfil);
                //$statement->bindParam(':APARTAMENTO', $apartamento);
                $statement->bindParam(':ID', $id);
                $statement->execute();
                //$morador->getId($this->conexao->lastInsertId());
                                
                // $sql = "INSERT INTO TB_APARTAMENTOS_MORADORES (FK_ADM_APA, FK_ADM_MOR) VALUES (:APARTAMENTO, :MORADOR)";
                // $statement = $this->conexao->prepare($sql);
                // $apartamento_id = $apartamento->getId();
                // //$morador_id = $morador->getId();
                // $morador_id = $id;
                // $statement->bindParam(':APARTAMENTO', $apartamento_id);
                // $statement->bindParam(':MORADOR', $morador_id);
                // $statement->execute();

                // if($status_sindico == 1) {
                //     $sql = "INSERT INTO TB_SINDICOS (FK_SIN_MOR) VALUES (:SINDICO)";
                //     $statement = $this->conexao->prepare($sql);
                //     $sindico = $morador->getId();
                //     $statement->bindParam(':SINDICO', $sindico);
                //     $statement->execute();
                // }

                //return $this->findById($morador->getId());
                return 0;
            } catch(PDOException $e) {
                echo $e->getMessage();
                $codigoErro = $e->errorInfo[1]; //Pega o código de entrada duplicada
                $mensagemErro = $e->errorInfo[2]; //Pega a mensagem do erro
                $code = $e->getCode();
                echo $codigoErro;
                //$mensagem = strstr($e->getMessage(),'UK');
                //print_r(explode(" ",$mensagemErro));
                //return $mensagem;
                if ($codigoErro == 1062) {
                    $erro1062 = explode(" ",$mensagemErro);
                    //echo $erro1062[5];
                    if ($erro1062[5] == "'UK_MOR_CPF'") {
                        return 1; //Cpf duplicado
                    }else if ($erro1062[5] == "'UK_MOR_LOGIN'") {
                        return 2; //Login duplicado
                    }
                }
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