<?php
    require_once(__DIR__ . "/./Conexao.class.php");
    require_once(__DIR__ . "/../modelo/Funcionario.class.php");
    require_once(__DIR__ . "/../modelo/Sexo.class.php");
    require_once(__DIR__ . "/../modelo/Cep.class.php");
    require_once(__DIR__ . "/../modelo/Bairro.class.php");
    require_once(__DIR__ . "/../modelo/Cidade.class.php");
    require_once(__DIR__ . "/../modelo/Estado.class.php");

    class FuncionarioDAO {

        private $conexao;

        function __construct() {
            $this->conexao = Conexao::get();
        }
        
        public function findAll() {
            $sql = "SELECT * FROM TB_FUNCIONARIOS LEFT JOIN TB_SEXOS ON PK_SEX = FK_FUN_SEX LEFT JOIN TB_CEPS ON PK_CEP = FK_FUN_CEP LEFT JOIN TB_BAIRROS ON PK_BAI = FK_BAI_CEP LEFT JOIN TB_CIDADES ON PK_CID = FK_BAI_CID LEFT JOIN TB_ESTADOS ON PK_EST = FK_EST_CID ORDER BY PK_MATRICULA ASC";
            $statement = $this->conexao->prepare($sql);
            $statement->execute();
            $rows = $statement->fetchAll();
            $funcionarios = array();
            foreach ($rows as $row) {
                $sexo = new Sexo();
                $sexo->setId($row['PK_SEX']);
                $sexo->setNome($row['SEX_NOME']);
                $sexo->setSigla($row['SEX_SIGLA']);           
                
                $estado = new Estado();
                $estado->setId($row['PK_EST']);
                $estado->setNome($row['EST_NOME']);
                $estado->setSigla($row['EST_SIGLA']);
                
                $cidade = new Cidade();
                $cidade->setId($row['PK_CID']);
                $cidade->setNome($row['CID_NOME']);
                $cidade->setEstado($estado);
                
                $bairro = new Bairro();
                $bairro->setId($row['PK_BAI']);
                $bairro->setNome($row['BAI_NOME']);
                $bairro->setCidade($cidade);

                $cep = new Cep();
                $cep->setId($row['PK_CEP']);
                $cep->setLogradouro($row['CEP_LOGRADOURO']);
                $cep->setBairro($bairro);
                
                $funcionario = new Funcionario();
                $funcionario->setMatricula($row['PK_MATRICULA']);
                $funcionario->setNome($row['FUN_NOME']);
                $funcionario->setCpf($row['FUN_CPF']);
                $funcionario->setSexo($sexo);
                $funcionario->setCep($cep);
                array_push($funcionarios, $funcionario);
            }
            return $funcionarios;
        }

        public function findById($id) {
            $sql = "SELECT * FROM TB_FUNCIONARIOS LEFT JOIN TB_SEXOS ON PK_SEX = FK_FUN_SEX LEFT JOIN TB_CEPS ON PK_CEP = FK_FUN_CEP LEFT JOIN TB_BAIRROS ON PK_BAI = FK_BAI_CEP LEFT JOIN TB_CIDADES ON PK_CID = FK_BAI_CID LEFT JOIN TB_ESTADOS ON PK_EST = FK_EST_CID WHERE PK_MATRICULA = :ID";
            $statement = $this->conexao->prepare($sql);
            $matricula = $funcionario->getMatricula();
            $statement->bindParam(':ID', $matricula); //Proteção contra sql injetct
            $statement->execute();
            $row = $statement->fetch();
            $sexo = new Sexo();
            $sexo->setId($row['PK_SEX']);
            $sexo->setNome($row['SEX_NOME']);
            $sexo->setSigla($row['SEX_SIGLA']);
            $funcionario = new Funcionario();
            $funcionario->setMatricula($row['PK_MATRICULA']);
            $funcionario->setNome($row['FUN_NOME']);
            $funcionario->setCpf($row['FUN_CPF']);
            $funcionario->setSexo($sexo);
            
            return $funcionario;
        }
    
        public function findByFuncionario(Funcionario $funcionario) {
            $sql = "SELECT * FROM TB_FUNCIONARIOS WHERE PK_MATRICULA = :MATRICULA";
            $statement = $this->conexao->prepare($sql);
            $matricula = $funcionario->getMatricula();
            $statement->bindParam(':MATRICULA', $matricula); //Proteção contra sql injetct
            $statement->execute(); 
            $result = $statement->fetchAll();
            $funcionarios = array();
            foreach ($result as $row) {
                $funcionario = new Funcionario();
                $funcionario->setMatricula($row['PK_MATRICULA']);
                $funcionario->setNome($row['FUN_NOME']);
                $funcionario->setCpf($row['FUN_CPF']);
                array_push($funcionarios, $funcionario);
            }
            
            return $funcionarios;
        }

        public function findByNome($nome) {
            $sql = "SELECT * FROM TB_FUNCIONARIOS LEFT JOIN TB_SEXOS ON PK_SEX = FK_FUN_SEX LEFT JOIN TB_CEPS ON PK_CEP = FK_FUN_CEP LEFT JOIN TB_BAIRROS ON PK_BAI = FK_BAI_CEP LEFT JOIN TB_CIDADES ON PK_CID = FK_BAI_CID LEFT JOIN TB_ESTADOS ON PK_EST = FK_EST_CID WHERE FUN_NOME LIKE :NOME";
            $statement = $this->conexao->prepare($sql);
            $statement->bindParam(':NOME', $nome); //Proteção contra sql injetct
            $statement->execute();
            $rows = $statement->fetchAll();
            $sexo = new Sexo();
            $funcionario = new Funcionario();
            foreach ($rows as $row) {
                $funcionario->setMatricula($row['PK_MATRICULA']);
                $funcionario->setNome($row['FUN_NOME']);
                $funcionario->setCpf($row['FUN_CPF']);
                $funcionario->setSexo()->setId($row['PK_SEX']);
                $funcionario->setSexo()->setNome($row['SEX_NOME']);
                $funcionario->setSexo()->setSigla($row['SEX_SIGLA']);
            }
            return $funcionario;
        }

        public function save(Funcionario $funcionario) {
            if ($funcionario->getMatricula() == null) {
                $this->insert($funcionario);
            } else {
                $this->update($funcionario);
            }
        }

        private function insert(Funcionario $funcionario) {
            $sql = "INSERT INTO TB_FUNCIONARIOS (PK_MATRICULA, FUN_NOME, FUN_CPF, FK_FUN_SEX) VALUES (:MATRICULA, :NOME, :CPF, :SEXO)";
            try {
                $statement = $this->conexao->prepare($sql);
                $matricula = $funcionario->getMatricula();
                $nome = $funcionario->getNome();
                $cpf = $funcionario->getCpf();
                $sexoId = $funcionario->getSexo()->getId();                
                $statement->bindParam(':MATRICULA', $matricula);
                $statement->bindParam(':NOME', $nome);
                $statement->bindParam(':CPF', $cpf);
                $statement->bindParam(':SEXO', $sexoId);
                $statement->execute();
                return $this->findById($this->conexao->lastInsertId());
            } catch(PDOException $e) {
                echo $e->getMessage();
                return null;
            }
        }

        private function update(Funcionario $funcionario) {
            $sql = "UPDATE TB_funcionarioES SET FUN_NOME=:NOME, FUN_CPF=:CPF, FK_FUN_SEX=:SEXO WHERE PK_MATRICULA = :ID";
            try {
                $statement = $this->conexao->prepare($sql);
                $nome = $funcionario->getNome();
                $cpf = $funcionario->getCpf();
                $sexo = $funcionario->getSexo()->getId();
                $matricula = $funcionario->getMatricula();
                // $id = $funcionario->get();
                $statement->bindParam(':NOME', $nome);
                $statement->bindParam(':CPF', $cpf);
                $statement->bindParam(':MATRICULA', $matricula);
                $statement->bindParam(':SEXO', $sexo);
                $statement->bindParam(':ID', $matricula);
                $statement->execute();
                return $this->findById($funcionario->getMatricula());
                } catch(PDOException $e) {
                echo $e->getMessage();
                return null;
            }
        }

        public function remove($id) {
            $sql = "DELETE FROM TB_funcionarioES WHERE PK_MATRICULA = :ID";
            try {
                $statement = $this->conexao->prepare($sql);
                $statement->bindParam(':ID', $id); //Proteção contra sql injetct
                $statement->execute();
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    }
?>